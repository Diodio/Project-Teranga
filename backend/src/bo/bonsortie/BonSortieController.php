<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use BonSortie\BonSortie as BonSortie;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use BonSortie\LigneBonSortie as LigneBonSortie;
use BonSortie\BonSortieManager as BonSortieManager;
use Log\Loggers as Logger;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class BonSortieController extends BaseController implements BaseAction {
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
                        case \App::ACTION_LIST_VALID:
                                $this->doListValidBon($request);
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
                                $this->doGetBonSortieParUsine($request);
                                break;
                        case \App::ACTION_ACTIVER:
                                $this->doValidBonSortie($request);
                                break;
                        case \App::ACTION_DESACTIVER:
                                $this->doAnnuleBonSortie($request);
                                break;
                        case \App::ACTION_GET_LAST_NUMBER:
                                $this->doGetLastNumberBonSortie($request);
                                break;
                        case \App::ACTION_STAT:
                                $this->doStat($request);
                                break;
                    case \App::ACTION_VIEW_DETAILS:
                        $this->doViewDetails($request);
                        break;
                        case \App::ACTION_GET_LAST_NUMBER:
                            $this->doGetLastNumberMareyeur($request);
                        break;
                        case \App::ACTION_GET_COLISAGES:
                                $this->doGetInfoColisages($request);
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
                $bonSortieManager = new BonSortieManager();
                $bonSortie = new BonSortie();
                $bonSortie->setNumeroBonSortie($request['numeroBonSortie']);
                $bonSortie->setDateBonSortie(new \DateTime("now"));
                $bonSortie->setNumeroCamion($request['numeroCamion']);
                $bonSortie->setNomChauffeur($request['nomChauffeur']);
                $bonSortie->setOrigine($request['origine']);
                $bonSortie->setNumeroContainer($request['numContainer']);
                $bonSortie->setNumeroPlomb($request['numeroPlomb']);
                $bonSortie->setDestination($request['destination']);
                $bonSortie->setCodeUsine($request['codeUsine']);
                $bonSortie->setLogin($request['login']);
                $bonSortie->setStatus(1);
                $bonSortie->setPoidsTotal($request['poidsTotal']);
                $clientManager = new Client\ClientManager();
                $client = $clientManager->findById($request['client']);
                $bonSortie->setClient($client);
                $Added = $bonSortieManager->insert($bonSortie);
           //     var_dump("fgf");
                if ($Added->getId() != null) {
                    $jsonBonSortie = json_decode($_POST['jsonProduit'], true);
                         foreach ($jsonBonSortie as $key => $ligne) {
                            if(isset($ligne["Désignation"])) {
                                $ligneBonSortie = new LigneBonSortie();
                                $ligneBonSortie->setBonSortie($bonSortie);
                                $produitId = $ligne["Désignation"];
                                $produitManager = new Produit\ProduitManager();
                                $produit= $produitManager->findById($produitId);
                                $ligneBonSortie->setProduit($produit);
                                $ligneBonSortie->setQuantite($ligne['Quantité(kg)']);
                                $ligneBonSortieManager = new \BonSortie\LigneBonSortieManager();
                                $Inserted = $ligneBonSortieManager->insert($ligneBonSortie); 
                                if ($Inserted->getId() != null) {
                                       $stockManager = new \Stock\StockManager();
                                       if($ligne['Quantité(kg)'] !="")
                                           $nbStock = $ligne['Quantité(kg)'];
                                       $stockManager->destockage($produitId, $request['codeUsine'], $nbStock);
                                }
                            }
                         }
                    $this->doSuccess($Added->getId(), 'Bon de sortie enregistré avec succes');
                } else {
                    $this->doError('-1', 'Impossible d\'inserer cet achat');
                }
                
            
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR' . $e->getMessage());
        }
    }

    
    public function doList($request) {
        try {
            $achatManager = new BonSortieManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('dateBonSortie', 'numeroBonSortie', 'nom');
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
                        $sOrder .= " dateBonSortie desc";
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
                    $nbBonSorties = $achatManager->count($request['codeUsine'],$sWhere);
                    $this->doSuccessO($this->dataTableFormat($achats, $request['sEcho'], $nbBonSorties));
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
     public function doValidBonSortie($request) {
        try {
            if ($request['bonsortieId'] != null) {
                $sortieManager = new BonSortieManager();
                $sortieManager->validBonSortie($request['bonsortieId']);
//                if($valid==1)
//                    $sortieManager->dimunieStockParBonSortie($request['bonsortieId']);
                $this->doSuccess($request['bonsortieId'], 'Validation effectué avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doAnnuleBonSortie($request) {
        try {
            if ($request['bonsortieId'] != null) {
                $sortieManager = new BonSortieManager();
                $annul = $sortieManager->annulerBonSortie($request['bonsortieId']);
                if ($annul == 1) {
                    $sortieManager->ajourStockParBonSortie($request['bonsortieId']);
                    $this->doSuccess($request['bonsortieId'], 'Annulation effectuée avec succes');
                } else {
                    $this->doError('-1', 'Impossible d\'annuler ce bon de sortie');
                }
            } else {
                $this->doError('-1', 'Params not enough');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doGetLastNumberBonSortie($request) {
        try {
                $bonSortieManager = new BonSortieManager();
                $lastBonSortie = $bonSortieManager->getLastNumberBonSortie();
                $this->doSuccess($lastBonSortie,'Dernier numero bon de sortie');
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doStat($request) {
    	try {
    		if (isset($request['codeUsine'])) {
    			$BonSortieManager = new BonSortieManager();
    			$achat = $BonSortieManager->findStatisticByUsine($request['codeUsine']);
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
            if (isset($request['bonsortieId'])) {
                $sortieManager = new BonSortieManager();
                $sotieDetails = $sortieManager->findBonSortieDetails($request['bonsortieId']);
                if ($sotieDetails != null)
                    $this->doSuccessO($sotieDetails);
                else
                    echo json_encode(array());
            } else {
                $this -> doError('-1', 'Chargement detail achat impossible');
            }
        
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }
    
    
    public function doGetLastNumberSortie($request) {
        try {
            $sortieManager = new SortieManager();
            $lastNumero = $sortieManager->getLastNumberBonSortie();
            $this->doSuccess($lastNumero, 'Dernier bon de sortie');
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

     public function doListValidBon($request) {
            $sortieManager = new BonSortieManager();
            
        try {
            $colisages = $sortieManager->listbonValid();
            
            if ($colisages != null)
                $this->doSuccessO($colisages);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    
    public function doGetInfoColisages($request) {
            $sortieManager = new BonSortieManager();
        try {
            $colisages = $sortieManager->findInfoColisages($request['colisageId']);
            if ($colisages != null)
                $this->doSuccessO($colisages);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
}

        $oBonSortieController = new BonSortieController($_REQUEST);