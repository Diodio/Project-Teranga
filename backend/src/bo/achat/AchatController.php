<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Achat\Achat as Achat;
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
//                            /$ligne = json_decode($ligneachat, TRUE);
                            if(isset($ligneachat["Désignation"])) {
                                $ligneAchat = new \Achat\LigneAchat();
                                $ligneAchat->setAchat($achat);
                                $produitId = $ligneachat["Désignation"];
                                $produitManager = new Produit\ProduitManager();
                                $produit= $produitManager->findById($produitId);
                                $ligneAchat->setProduit($produit);
                                $ligneAchat->setQuantite($ligneachat['Quantite (kg)']);
                                $ligneAchat->setMontant($ligneachat['Montant']);
                                $ligneAchat->setPoids($ligneachat['Poids Net (kg)']);
                                $ligneAchatManager = new \Achat\LigneAchatManager();
                                
                
                                $achatInserted = $ligneAchatManager->insert($ligneAchat); 
                                
                                if ($achatInserted->getId() != null) {
                                       $stockManager = new \Produit\StockManager();
                                       if($ligneachat['Quantite (kg)'] !="")
                                           $nbStock = $ligneachat['Quantite (kg)'];
                                       if($ligneachat['Poids Net (kg)'] !="")
                                           $nbStock = $ligneachat['Poids Net (kg)'];
                                       $stockManager->updateNbStock($produitId, $request['codeUsine'], $nbStock);
                                }
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
                $aColumns = array('dateAchat', 'numero');
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
                        $sOrder = "";
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
                $achatManager->validAchat($request['achatId']);
                $this->doSuccess($request['messageId'], 'Validation effectué avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
                throw new ConstraintException('');
            }
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

}

        $oAchatController = new AchatController($_REQUEST);