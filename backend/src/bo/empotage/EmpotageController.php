<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Empotage\Empotage as Empotage;
use Empotage\EmpotageTemp as EmpotageTemp;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Empotage\EmpotageManager as EmpotageManager;
use Log\Loggers as Logger;
use App as App;

class EmpotageController extends BaseController implements BaseAction {

    private $logger;
    private $parameters;

    function __construct($request) {
        $this->logger = new Logger(__CLASS__);
        // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if (isset($request['ACTION'])) {
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
                    case \App::ACTION_SEARCH:
                        $this->doSearch($request);
                        break;
                    case \App::ACTION_ACTIVER:
                        $this->doValidEmpotage($request);
                        break;
                    case \App::ACTION_DESACTIVER:
                        $this->doAnnuleEmpotage($request);
                        break;
                    case \App::ACTION_VIEW_DETAILS:
                        $this->doViewDetails($request);
                        break;
                    case \App::ACTION_GET_LAST_NUMBER:
                        $this->doGetLastNumber($request);
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
             $listProduit=null;
             $listConteneur=null;
             $listEmpotage=null;
            if ($request['client'] != "null" || $request['client'] != "undefined") {
                $empotageManager = new EmpotageManager();
                $empotage = new Empotage();
                $empotage->setNumero($request['numEmpotage']);
                $empotage->setDate(new \DateTime("now"));
                $empotage->setHeure(new \DateTime($request['heureEmpotage']));
                $empotage->setPortDechargement($request['portDechargement']);
                $empotage->setNbTotalColis($request['nbTotalColis']);
                $empotage->setNbTotalPoids($request['nbTotalPoids']);
                $empotage->setStatus(1);
                $empotage->setCodeUsine($request['codeUsine']);
                $empotage->setLogin($request['login']);
                $clientManager = new \Client\ClientManager();
                $client = $clientManager->findById($request['client']);
                $empotage->setClient($client);
                //$empotageAdded = $$empotageManager->insert($empotage);
                //if ($empotageAdded->getId() != null) {
                    $jsonConteneur = json_decode($_POST['jsonConteneur'], true);
                    var_dump($jsonConteneur);
                    foreach ($jsonConteneur as $key => $ligneConteneur) {
                        if (isset($ligneConteneur["nConteneur"])) {
                            if ($ligneConteneur["nConteneur"] !== "" && $ligneConteneur["nPlomb"] !== "") {
                                $conteneur = new \Empotage\Conteneur();
                                $conteneur->setEmpotage($empotage);
                                $conteneur->setNumConteneur($ligneConteneur["nConteneur"]);
                                $conteneur->setNumPlomb($ligneConteneur["nPlomb"]);
                               // $conteneurManager = new \Empotage\ConteneurManager();
                                $listConteneur[]=$conteneur;
                                //$conteneurManager->insert($conteneur);
                            }
                        }
                    }
                    $jsonProduit = json_decode($_POST['jsonProduit'], true);
//                    foreach ($jsonProduit as $key => $ligne) {
//                        if (isset($ligne["nColis"])) {
//                            if ($ligne["nColis"] !== "" && $ligne["designation"] !== "") {
//                                $ligneEmpotage = new \Empotage\LigneEmpotage;
//                                $ligneEmpotage->setEmpotage($empotage);
//                                $ligneEmpotage->setNbColis($ligne["nColis"]);
//                                $ligneEmpotage->setProduit_id($ligne["produitId"]);
//                                $ligneEmpotage->setQuantite($ligne["pnet"]);
//                               // $ligneEmpotage->setPrixUnitaire($ligne["pu"]);
//                               // $ligneEmpotage->setMontant($ligne["montant"]);
//                               // $ligneEmpotageManager = new \Empotage\LigneEmpotageManager();
//                              //  $inserted = $ligneEmpotageManager->insert($ligneEmpotage);
//                                //if ($inserted->getId() != null) {
//                                    $stockEmpotagee = new \Stock\StockEmpotage();
//                                    $stockEmpotagee->setEmpotageId($empotageAdded->getId());
//                                    $stockEmpotagee->setProduitId($ligne["produitId"]);
//                                    $stockEmpotagee->setQuantiteEmpotagee($ligne["pnet"]);
//                                    $stockManager = new \Stock\StockManager();
//                                    $stockManager->insert($stockEmpotagee);
//                                    $stockManager->destockageReel($ligne["produitId"], $request['codeUsine'], $ligne["pnet"]);
//                               // }
//                            }
//                        }
//                    }

                    $jsonColis = json_decode($_POST['jsonColis'], true);
//                    foreach ($jsonColis as $key => $ligneC) {
//                        if (isset($ligneC["nbColis"])) {
//                            if ($ligneC["nbColis"] !== "" && $ligneC["qte"] !== "") {
//                                $colis = new \Empotage\LigneColis();
//                                $colis->setNombreCarton($ligneC["nbColis"]);
//                                $colis->setQuantiteParCarton($ligneC["qte"]);
//                                $colis->setProduitId($ligneC["produitId"]);
//                                $colis->setEmpotageId($empotageAdded->getId());
//                                $ligneColisManager = new \Empotage\LigneColisManager;
//                                $inserted = $ligneColisManager->insert($colis);
//                                if ($inserted->getId() != null) {
//                                    $ligneColisManager->dimunieColisEmpotagee($ligneC["produitId"], $ligneC["qte"], $ligneC["nbColis"], $request['codeUsine']);
//                                }
//                            }
//                        }
//                    }
                    $empotageAdded = $empotageManager->insert($empotage,$listConteneur,$jsonProduit,$jsonColis);
                    if ($empotageAdded != NULL) {
                        $this->doSuccess($empotageAdded->getId(), 'Empotage enregistré avec succes');
                   } else {
                    $this->doError('-1', 'Impossible d\'inserer cette empotage');
                }
            } else
                $this->doError('-1', 'Impossible d\'inserer cette empotage');
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }


    public function doList($request) {
        try {
            $empotageManager = new EmpotageManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('dateEmpotage', 'numero', 'nom');
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
                        $sOrder .= " dateEmpotage desc";
                    }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
                if (isset($request['sSearch']) && $request['sSearch'] != "") {
                    //$sSearchs = explode(" ", $request['sSearch']);
                  //  for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= "( ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $request['sSearch'] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                         $sWhere = $sWhere .=")";
                //    }
                }
                // End filter from dataTable
                $empotage = $empotageManager->retrieveAll($request['codeUsine'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($empotage != null) {
                    $nbEmpotages = $empotageManager->count($request['codeUsine'], $sWhere);
                    $this->doSuccessO($this->dataTableFormat($empotage, $request['sEcho'], $nbEmpotages));
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
        try {
            if (isset($request['factureId']) && $request['factureId'] != "") {
                $empotageId = $request['factureId'];
                $empotageManager = new EmpotageManager();
                $empotage = $empotageManager->findById($empotageId);
                $empotage->setMontantHt($request['montantHt']);
                $empotage->setMontantTtc($request['montantTtc']);
                $empotage->setModePaiement($request['modePaiement']);
                $empotage->setInconterm($request['inconterm']);
                if ($request['modePaiement'] == 'CHEQUE')
                    $empotage->setNumCheque($request['numCheque']);
                else if ($request['modePaiement'] == 'VIREMENT')
                    $empotage->setDatePaiement(new \DateTime($request['datePaiement']));
                // $achat->setCodeUsine($request['codeUsine']);
                // $achat->setLogin($request['login']);
                if ($request['avance'] != "" && $request['avance'] != "undefined" && $request['avance']!=0) {
                    if ($request['regle'] == "true")
                        $empotage->setRegle(2);
                    else
                        $empotage->setRegle(1);
                    $reliquat = $request['montantTtc'] - $request['avance'];
                    $empotage->setReliquat($reliquat);
                    $reglement = new Reglement\ReglementEmpotage();
                    $reglement->setEmpotage($empotage);
                    $reglement->setDatePaiement(new \DateTime("now"));
                    $reglement->setAvance($request['avance']);
                    $reglementManager = new Reglement\ReglementManager();
                    $reglementManager->insert($reglement);
                }
                else {
                    $empotage->setRegle(0);
                }
                //$empotageAdded = $empotageManager->update($empotage);
               // if ($empotageAdded->getId() != null) {
                $listLigneEmpotage=NULL;
                    $ligneEmpotageManager = new \Empotage\LigneEmpotageManager();
                    $jsonProduit = json_decode($_POST['jsonProduit'], true);
                    foreach ($jsonProduit as $key => $ligne) {
                        if (isset($ligne["ligneId"])) {
                            $ligneEmpotage = $ligneEmpotageManager->findById($ligne["ligneId"]);
                            //$ligneAchat->setId($ligne["ligneId"]);
                            //$ligneAchat->setAchat($achat);
                            //$produitId = $ligne["ligneId"];
                            // $produitManager = new Produit\ProduitManager();
                            //$produit= $produitManager->findById($produitId);
                            // $ligneAchat->setProduit($produit);
                            $ligneEmpotage->setPrixUnitaire($ligne['pu']);
                            $ligneEmpotage->setQuantite($ligne['qte']);
                            $ligneEmpotage->setMontant($ligne['montant']);
                            $listLigneEmpotage[]=$ligneEmpotage;
                            //$ligneEmpotageManager->update($ligneEmpotage);
                        }
                    }
                    $empotageAdded = $empotageManager->update($empotage, $listLigneEmpotage);
                    if($empotageAdded !=NULL)
                     $this->doSuccess($empotageAdded->getId(), 'Empotage mise à jour avec succes');
                else {
                    $this->doError('-1', 'Impossible d\'effectuer cette mise à jour');
                }
            } else {
                $this->doError('-1', 'Impossible d\'effectuer cette mise à jour');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'Erreur lors du traitement de votre requete');
        }
    }


    public function doView($request) {
        
    }

    public function doValidEmpotage($request) {
        try {
            if ($request['achatId'] != null) {
                $empotageManager = new EmpotageManager();
                $valid = $empotageManager->validEmpotage($request['achatId']);
                if ($valid == 1)
                    $empotageManager->ajoutStockParAchact($request['achatId']);
                $this->doSuccess($request['achatId'], 'Validation effectué avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doAnnuleEmpotage($request) {
        try {
            if ($request['factureId'] != null) {
                $empotageManager = new EmpotageManager();
                $empotageManager->annulerEmpotage($request['factureId']);
                $this->doSuccess($request['factureId'], 'Annulation effectuée avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doGetLastNumber($request) {
        try {
            $empotageManager = new EmpotageManager();
            $lastEmpotage = $empotageManager->getLastNumberEmpotage($request['codeUsine']);
            $this->doSuccess($lastEmpotage, 'Derniere empotage');
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doStat($request) {
        try {
            if (isset($request['codeUsine'])) {
                $EmpotageManager = new EmpotageManager();
                $achat = $EmpotageManager->findStatisticByUsine($request['codeUsine']);
                if ($achat != null)
                    $this->doSuccessO($achat);
                else
                    echo json_encode(array());
            } else {
                $this->doError('-1', $this->parameters['PARAM_NOT_ENOUGH']);
                $this->logger->log->error('View : Params not enough');
            }
        } catch (Exception $e) {
            $this->doError('-1', $this->parameters['CANNOT_GET_MSG']);
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
    
    public function doStatAnnule($request) {
    	try {
    		if (isset($request['codeUsine'])) {
    			$EmpotageManager = new EmpotageManager();
    			$achat = $EmpotageManager->findStatisticAnnuleByUsine($request['codeUsine']);
    			if ($achat != null)
    				$this->doSuccessO($achat);
    			else
    				echo json_encode(array());
    		} else {
    			$this->doError('-1', $this->parameters['PARAM_NOT_ENOUGH']);
    			$this->logger->log->error('View : Params not enough');
    		}
    	} catch (Exception $e) {
    		$this->doError('-1', $this->parameters['CANNOT_GET_MSG']);
    		$this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
    	}
    }

    public function doViewDetails($request) {
        try {
            if (isset($request['factureId'])) {
                $empotageManager = new EmpotageManager();
                $empotageDetails = $empotageManager->findEmpotageDetails($request['factureId']);
                if ($empotageDetails != null)
                    $this->doSuccessO($empotageDetails);
                else
                    echo json_encode(array());
            } else {
                $this->doError('-1', 'Chargement detail impossible');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }

   
}

$oEmpotageController = new EmpotageController($_REQUEST);
