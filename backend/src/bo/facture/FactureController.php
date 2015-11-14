<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Facture\Facture as Facture;
use Facture\FacturePaiement as FacturePaiement;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Facture\FactureManager as FactureManager;
use Log\Loggers as Logger;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class FactureController extends BaseController implements BaseAction {
private $logger;
    
    private $parameters;
            function __construct($request) {
       $this->logger = new Logger(__CLASS__);
       // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if(isset($request['ACTION'])) 
                {
                    switch ($request['ACTION']) {
                        case \App::ACTION_INSERT:
                                $this->doInsert($request);
                                break;
                        case \App::ACTION_UPDATE:
                                $this->doUpdate($request);
                                break;
                        case \App::ACTION_VIEW:
                                $this->doView($request);
                                break;
                        case \App::ACTION_LIST:
                                $this->doList($request);
                                break;
                        case \App::ACTION_REMOVE:
                                $this->doRemove($request);
                                break;
                        case \App::ACTION_GET_PRODUCT:
                                $this->doGetInfoProduct($request);
                                break;
                        case \App::ACTION_SEARCH:
                                $this->doSearch($request);
                                break;
                        case \App::ACTION_LIST_PAR_USINE:
                                $this->doGetFactureParUsine($request);
                                break;
                        case \App::ACTION_ACTIVER:
                                $this->doValidFacture($request);
                                break;
                        case \App::ACTION_DESACTIVER:
                                $this->doAnnuleFacture($request);
                                break;
                        case \App::ACTION_GET_LAST_NUMBER:
                                $this->doGetLastNumber($request);
                                break;
                        case \App::ACTION_STAT:
                                $this->doStat($request);
                                break;
                    case \App::ACTION_VIEW_DETAILS:
                        $this->doViewDetails($request);
                        break;
                        
                    }
            } else {
                throw new Exception('NO_ACTION');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        try {
            $this->logger->log->trace("tesst1");
            
                $factureManager = new FactureManager();
                
                $achat = new Facture();
                $achat->setNumero($request['numFacture']);
                $achat->setHeureReception(new \DateTime($request['heureReception']));
                $achat->setDateFacture(new \DateTime("now"));
                $achat->setPoidsTotal($request['poidsTotal']);
                $achat->setMontantTotal($request['montantTotal']);
                $achat->setModePaiement($request['modePaiement']);
                $achat->setNumCheque($request['numCheque']);
                $achat->setCodeUsine($request['codeUsine']);
                $achat->setLogin($request['login']);
                $mareyeurManager = new \Mareyeur\MareyeurManager();
                $mareyeur = $mareyeurManager->findById($request['mareyeur']);
                
               // var_dump($request['mareyeur']);
               $achat->setMareyeur($mareyeur);
                
                $achatAdded = $factureManager->insert($achat);
           //     var_dump("fgf");
                if ($achatAdded->getId() != null) {
                    $jsonFacture = json_decode($_POST['jsonProduit'], true);
                         foreach ($jsonFacture as $key => $ligneachat) {
                            if(isset($ligneachat["Designation"])) {
                                $ligneFacture = new \Facture\LigneFacture();
                                $ligneFacture->setFacture($achat);
                                $produitId = $ligneachat["Designation"];
                                $produitManager = new Produit\ProduitManager();
                                $produit= $produitManager->findById($produitId);
                                $ligneFacture->setProduit($produit);
                                if($ligneachat['Poids Net(kg)']!=="")
                                    $ligneFacture->setQuantite($ligneachat['Poids Net(kg)']);
                                else
                                    $ligneFacture->setQuantite($ligneachat['Quantite(kg)']);
                                $ligneFacture->setMontant($ligneachat['Montant']);
                               // $ligneFacture->setPoids($ligneachat['Poids Net(kg)']);
                                $ligneFactureManager = new \Facture\LigneFactureManager();
                                $ligneFactureManager->insert($ligneFacture); 
//                                if ($achatInserted->getId() != null) {
//                                       $stockManager = new \Produit\StockManager();
//                                       if($ligneachat['Quantite(kg)'] !="")
//                                           $nbStock = $ligneachat['Quantite(kg)'];
//                                       if($ligneachat['Poids Net(kg)'] !="")
//                                           $nbStock = $ligneachat['Poids Net(kg)'];
//                                       $stockManager->updateNbStock($produitId, $request['codeUsine'], $nbStock);
//                                }
//                                $achatPaiement = new FacturePaiement();
//                                $achatPaiement->setFacture($achat);
//                                $achatPaiement->setMontant($request['avance']);
//                                $achatPaiement->setDatePaiement(new \DateTime("now"));
                            }
                         }
                    $this->doSuccess($achatAdded->getId(), 'Facture enregistré avec succes');
                } else {
                    $this->doError('-1', 'Impossible d\'inserer cet achat');
                }
                
            
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }

    
    public function doList($request) {
        try {
            $factureManager = new FactureManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('dateFacture', 'numero', 'nom');
                if (isset($request['iSortCol_0'])) {
                    $sOrder = "ORDER BY  ";
                    for ($i = 0; $i < intval($request['iSortingCols']); $i++) {
                        if ($request['bSortable_' . intval($request['iSortCol_' . $i])] == "true") {
                            $sOrder .= "" . $aColumns[intval($request['iSortCol_' . $i])] . " " .
                                    ($request['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                        }
                    }

                    $sOrder = substr_replace($sOrder, "", -2);
                    if ($sOrder == "ORDER BY") {
                        $sOrder .= " dateFacture desc";
                    }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
                if (isset($request['sSearch']) && $request['sSearch'] != "") {
                    $sSearchs = explode(" ", $request['sSearch']);
                    for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= " ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                       // $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $achats = $factureManager->retrieveAll($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($achats != null) {
                    $nbFactures = $factureManager->count($request['codeUsine'],$sWhere);
                    $this->doSuccessO($this->dataTableFormat($achats, $request['sEcho'], $nbFactures));
                } else {
                    $this->doSuccessO($this->dataTableFormat(array(), $request['sEcho'], 0));
                }
            } else {
                 throw new Exception('list failed');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doRemove($request) {
        
    }

    public function doUpdate($request) {
        
    }

    public function doView($request) {
        
    }
     public function doValidFacture($request) {
        try {
            if ($request['achatId'] != null) {
                $factureManager = new FactureManager();
                $valid = $factureManager->validFacture($request['achatId']);
                if($valid==1)
                    $factureManager->ajoutStockParAchact ($request['achatId']);
                $this->doSuccess($request['achatId'], 'Validation effectué avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doAnnuleFacture($request) {
        try {
            if ($request['achatId'] != null) {
                $factureManager = new FactureManager();
                $factureManager->annulerFacture($request['achatId']);
                $this->doSuccess($request['achatId'], 'Annulation effectuée avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    public function doGetLastNumber($request) {
        try {
                $factureManager = new FactureManager();
                $lastFacture = $factureManager->getLastNumberFacture();
                $this->doSuccess($lastFacture,'Dernier bon de sortie');
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doStat($request) {
    	try {
    		if (isset($request['codeUsine'])) {
    			$FactureManager = new FactureManager();
    			$achat = $FactureManager->findStatisticByUsine($request['codeUsine']);
    			if($achat != null)
    				$this->doSuccessO($achat);
    			else
    				echo json_encode(array());
    		} else {
    			$this->doError('-1', $this->parameters['PARAM_NOT_ENOUGH']);
    			$this->logger->log->error('View : Params not enough');
    		}
    	} catch (Exception $e) {
    		$this -> doError('-1', $this->parameters['CANNOT_GET_MSG']);
    		$this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
    	}
    }
    
    public function doViewDetails($request) {
        try {
            if (isset($request['achatId'])) {
                $factureManager = new FactureManager();
                $achatDetails = $factureManager->findFactureDetails($request['achatId']);
                if ($achatDetails != null)
                    $this->doSuccessO($achatDetails);
                else
                    echo json_encode(array());
            } else {
                $this -> doError('-1', 'Chargement detail impossible');
            }
        
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }
}

        $oFactureController = new FactureController($_REQUEST);