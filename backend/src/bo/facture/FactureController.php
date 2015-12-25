<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Facture\Facture as Facture;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Facture\FactureManager as FactureManager;
use BonSortie\BonSortieManager as BonSortieManager;
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
                        case \App::ACTION_LIST_REGLEMENTS:
                                $this->doListReglements($request);
                                break;
                        case \App::ACTION_STAT_REGLEMENTS:
                                $this->doStatReglements($request);
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
            $factureManager = new FactureManager();
            $facture = new Facture();
            $facture->setNumero($request['numFacture']);
            $facture->setDateFacture(new \DateTime("now"));
            $facture->setHeureFacture(new \DateTime($request['heureFacture']));
            $facture->setDevise($request['devise']);
            $facture->setPortDechargement($request['portDechargement']);
            $facture->setMontantHt($request['montantHt']);
            $facture->setMontantTtc($request['montantTtc']);
            $facture->setModePaiement($request['modePaiement']);
            $facture->setNumCheque($request['numCheque']);
            $facture->setAvance($request['avance']);
            $facture->setReliquat($request['reliquat']);
            $facture->setNbTotalColis($request['nbTotalColis']);
            $facture->setNbTotalPoids($request['nbTotalPoids']);
            $facture->setStatus(1);
             if($request['regle']=="true")
                    $facture->setRegle(2);
            else {
                if($request['avance']!="") {
                    $facture->setRegle(1);
                    $reliquat =  $request['montantTtc'] - $request['avance'];
                    if($reliquat==0)
                        $facture->setRegle(2);
                    $facture->setReliquat($reliquat);
                    $reglement=new Reglement\ReglementFacture();
                    $reglement->setFacture($facture);
                    $reglement->setDatePaiement(new \DateTime("now"));
                    $reglement->setAvance($request['avance']);
                    
                }
                else {
                    $facture->setRegle(0);
                }
            }
            $facture->setCodeUsine($request['codeUsine']);
            $facture->setLogin($request['login']);
            $clientManager = new \Client\ClientManager();
            $client = $clientManager->findById($request['clientId']);
            $facture->setClient($client);
            $factureAdded = $factureManager->insert($facture);
            if ($factureAdded->getId() != null) {
                if($request['avance']!="") {
                    $reglementManager =new Reglement\ReglementManager();
                    $reglementManager->insert($reglement);
                }
                $jsonConteneur = json_decode($_POST['jsonConteneur'], true);
                foreach ($jsonConteneur as $key => $ligneConteneur) {
                    if (isset($ligneConteneur["nConteneur"])) {
                        if ($ligneConteneur["nConteneur"] !== "" && $ligneConteneur["nPlomb"] !== "") {
                            $conteneur = new \Facture\Conteneur();
                            $conteneur->setFacture($facture);
                            $conteneur->setNumConteneur($ligneConteneur["nConteneur"]);
                            $conteneur->setNumPlomb($ligneConteneur["nPlomb"]);
                            $conteneurManager = new \Facture\ConteneurManager();
                            $conteneurManager->insert($conteneur);
                        }
                    }
                }
                $jsonProduit = json_decode($_POST['jsonProduit'], true);
                foreach ($jsonProduit as $key => $ligne) {
                    if (isset($ligne["nColis"])) {
                        if ($ligne["nColis"] !== "" && $ligne["designation"] !== "") {
                            $ligneFacture= new \Facture\LigneFacture;
                            $ligneFacture->setFacture($facture);
                            $ligneFacture->setNbColis($ligne["nColis"]);
                            $ligneFacture->setProduit($ligne["produitId"]);
                            $ligneFacture->setQuantite($ligne["pnet"]);
                            $ligneFacture->setPrixUnitaire($ligne["pu"]);
                            $ligneFacture->setMontant($ligne["montant"]);
                            $ligneFactureManager = new \Facture\LigneFactureManager();
                            $inserted = $ligneFactureManager->insert($ligneFacture);
                            if ($inserted->getId() != null) {
                                 $stockManager = new \Stock\StockManager();
                                 $stockManager->destockageReel($ligne["produitId"], 'usine_dakar', $ligne["pnet"]);
                            }
                        }
                    }
                }
                $this->doSuccess($factureAdded->getId(), 'Facture enregistré avec succes');
            } else {
                $this->doError('-1', 'Impossible d\'inserer ce facture');
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
                    for ($i = 1; $i < intval($request['iSortingCols']); $i++) {
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
                $facture = $factureManager->retrieveAll($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($facture != null) {
                    $nbFactures = $factureManager->count($request['codeUsine'],$sWhere);
                    $this->doSuccessO($this->dataTableFormat($facture, $request['sEcho'], $nbFactures));
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
            if (isset($request['factureId'])) {
                $factureManager = new FactureManager();
                $factureDetails = $factureManager->findFactureDetails($request['factureId']);
                if ($factureDetails != null)
                    $this->doSuccessO($factureDetails);
                else
                    echo json_encode(array());
            } else {
                $this -> doError('-1', 'Chargement detail impossible');
            }
        
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }
    
    public function doListReglements($request) {
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
                        $sWhere .= "( ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                       $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $achats = $factureManager->retrieveAllReglements($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($achats != null) {
                    $nbAchats = $factureManager->count($request['codeUsine'],$sWhere);
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
    
    
    
    public function doStatReglements($request) {
    	try {
    		if (isset($request['codeUsine'])) {
    			$factureManager = new FactureManager();
    			$facture = $factureManager->findStatisticReglementByUsine($request['codeUsine']);
    			if($facture != null)
    				$this->doSuccessO($facture);
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
   
}

        $oFactureController = new FactureController($_REQUEST);