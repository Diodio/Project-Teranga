<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Achat\Achat as Achat;
use Achat\AchatPaiement as AchatPaiement;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Achat\AchatManager as AchatManager;
use Log\Loggers as Logger;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class AchatController extends BaseController implements BaseAction {
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
                                $this->doGetAchatParUsine($request);
                                break;
                        case \App::ACTION_ACTIVER:
                                $this->doValidAchat($request);
                                break;
                        case \App::ACTION_DESACTIVER:
                                $this->doAnnuleAchat($request);
                                break;
                        case \App::ACTION_GET_LAST_NUMBER:
                                $this->doGetLastNumberAchat($request);
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
            
                $achatManager = new AchatManager();
                
                $achat = new Achat();
                $achat->setNumero($request['numAchat']);
                $achat->setHeureReception(new \DateTime($request['heureReception']));
                $achat->setDateAchat(new \DateTime("now"));
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
                
                $achatAdded = $achatManager->insert($achat);
           //     var_dump("fgf");
                if ($achatAdded->getId() != null) {
                    $jsonAchat = json_decode($_POST['jsonProduit'], true);
                         foreach ($jsonAchat as $key => $ligneachat) {
                            if(isset($ligneachat["Designation"])) {
                                $ligneAchat = new \Achat\LigneAchat();
                                $ligneAchat->setAchat($achat);
                                $produitId = $ligneachat["Designation"];
                                $produitManager = new Produit\ProduitManager();
                                $produit= $produitManager->findById($produitId);
                                $ligneAchat->setProduit($produit);
                                if($ligneachat['Poids Net(kg)']!=="")
                                    $ligneAchat->setQuantite($ligneachat['Poids Net(kg)']);
                                else
                                    $ligneAchat->setQuantite($ligneachat['Quantite(kg)']);
                                $ligneAchat->setMontant($ligneachat['Montant']);
                               // $ligneAchat->setPoids($ligneachat['Poids Net(kg)']);
                                $ligneAchatManager = new \Achat\LigneAchatManager();
                                $ligneAchatManager->insert($ligneAchat); 
//                                if ($achatInserted->getId() != null) {
//                                       $stockManager = new \Produit\StockManager();
//                                       if($ligneachat['Quantite(kg)'] !="")
//                                           $nbStock = $ligneachat['Quantite(kg)'];
//                                       if($ligneachat['Poids Net(kg)'] !="")
//                                           $nbStock = $ligneachat['Poids Net(kg)'];
//                                       $stockManager->updateNbStock($produitId, $request['codeUsine'], $nbStock);
//                                }
//                                $achatPaiement = new AchatPaiement();
//                                $achatPaiement->setAchat($achat);
//                                $achatPaiement->setMontant($request['avance']);
//                                $achatPaiement->setDatePaiement(new \DateTime("now"));
                            }
                         }
                    $this->doSuccess($achatAdded->getId(), 'Achat enregistré avec succes');
                } else {
                    $this->doError('-1', 'Impossible d\'inserer cet achat');
                }
                
            
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }

    
    public function doList($request) {
        try {
            $achatManager = new AchatManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('dateAchat', 'numero', 'nom');
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
                        $sOrder .= " dateAchat desc";
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
                $achats = $achatManager->retrieveAll($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($achats != null) {
                    $nbAchats = $achatManager->count($request['codeUsine'],$sWhere);
                    $this->doSuccessO($this->dataTableFormat($achats, $request['sEcho'], $nbAchats));
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
     public function doValidAchat($request) {
        try {
            if ($request['achatId'] != null) {
                $achatManager = new AchatManager();
                $valid = $achatManager->validAchat($request['achatId']);
                if($valid==1)
                    $achatManager->ajoutStockParAchact ($request['achatId']);
                $this->doSuccess($request['achatId'], 'Validation effectué avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doAnnuleAchat($request) {
        try {
            if ($request['achatId'] != null) {
                $achatManager = new AchatManager();
                $achatManager->annulerAchat($request['achatId']);
                $this->doSuccess($request['achatId'], 'Annulation effectuée avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    public function doGetLastNumberAchat($request) {
        try {
                $achatManager = new AchatManager();
                $lastAchat = $achatManager->getLastNumberAchat();
                $this->doSuccess($lastAchat,'Dernier bon d\'achat');
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doStat($request) {
    	try {
    		if (isset($request['codeUsine'])) {
    			$AchatManager = new AchatManager();
    			$achat = $AchatManager->findStatisticByUsine($request['codeUsine']);
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
                $achatManager = new AchatManager();
                $achatDetails = $achatManager->findAchatDetails($request['achatId']);
                if ($achatDetails != null)
                    $this->doSuccessO($achatDetails);
                else
                    echo json_encode(array());
            } else {
                $this -> doError('-1', 'Chargement detail achat impossible');
            }
        
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }
}

        $oFactureController = new FactureController($_REQUEST);