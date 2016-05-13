<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

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
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_INSERT:
                        $this->doInsert($request);
                        break;
                    case \App::ACTION_UPDATE:
                        $this->doUpdate($request);
                        break;
                    case \App::ACTION_UPDATE_LIGNE:
                        $this->doUpdateLigne($request);
                        break;
                    case \App::ACTION_VIEW:
                        $this->doView($request);
                        break;
                    case \App::ACTION_LIST:
                        $this->doList($request);
                        break;
                    case \App::ACTION_LIST_REGLEMENTS:
                        $this->doListReglements($request);
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
                    case \App::ACTION_STAT_REGLEMENTS:
                        $this->doStatReglements($request);
                        break;
                    case \App::ACTION_VIEW_DETAILS:
                        $this->doViewDetails($request);
                        break;
                    case \App::ACTION_LIST_INVENTAIRE_ACHATS:
                        $this->doListInventaireAchat($request);
                        break;
                    case \App::ACTION_GET_INFOS:
                        $this->doGetInfoInventaire($request);
                        break;
                    case \App::ACTION_LIST_GERANT:
                        $this->doListGerant($request);
                        break;
                        case \App::ACTION_STAT_GERANT:
                        	$this->doStatGerant($request);
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
            $this->logger->log->info(json_encode($request));
            if ($request['mareyeur'] != "null") {
                $achatManager = new AchatManager();
                $isExist = $achatManager->isExist($request['numAchat'], $request['codeUsine']);
                if ($isExist == NULL) {
                    $achat = new Achat();
                    $achat->setNumero($request['numAchat']);
                    $achat->setHeureReception(new \DateTime($request['heureReception']));
                    $achat->setDateAchat(new \DateTime($request['dateAchat']));
                    $achat->setPoidsTotal($request['poidsTotal']);
                    $mareyeurManager = new \Mareyeur\MareyeurManager();
                    $mareyeur = $mareyeurManager->findById($request['mareyeur']);
                    $achat->setMareyeur($mareyeur);
                    $achat->setCodeUsine($request['codeUsine']);
                    $achat->setLogin($request['login']);
                     $this->logger->log->info('debut insertion achat');
                    $achatAdded = $achatManager->insert($achat);
                     $this->logger->log->info('debut insertion achat');
                    if ($achatAdded->getId() != null) {
                        $jsonAchat = json_decode($_POST['jsonProduit'], true);
                        foreach ($jsonAchat as $key => $ligne) {
                            if (isset($ligne["designation"]) && $ligne["designation"] !== "-1") {
                                $ligneAchat = new \Achat\LigneAchat();
                                $ligneAchat->setAchat($achat);
                                $produitId = $ligne["designation"];
                                $produitManager = new Produit\ProduitManager();
                                $produit = $produitManager->findById($produitId);
                                $ligneAchat->setProduit($produit);
                                $ligneAchat->setQuantite($ligne['qte']);
                                $ligneAchatManager = new \Achat\LigneAchatManager();
                                $ligneAchatManager->insert($ligneAchat);
                            }
                        }
                        $this->doSuccess($achatAdded->getId(), 'Achat enregistr� avec succes');
                    } else {
                        $this->doError('-1', 'Impossible d\'inserer cet achat');
                    }
                } else {
                    $this->doError('-1', 'Ce numero d\'achat éxiste déja');
                }
            } else {
                $this->doError('-1', 'Impossible d\'inserer cet achat');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR'. $e->getMessage());
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
                $achats = $achatManager->retrieveAll($request['typeAchat'], $request['usineCode'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($achats != null) {
                    $nbAchats = $achatManager->count($request['typeAchat'], $request['usineCode'], $sWhere);
                    $this->doSuccessO($this->dataTableFormat($achats, $request['sEcho'], $nbAchats));
                } else {
                    $this->doSuccessO($this->dataTableFormat(array(), $request['sEcho'], 0));
                }
            } else {
                throw new Exception('Impossible d\'afficher la liste');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('Impossible d\'afficher la liste');
        }
    }
    
   

    public function doListReglements($request) {
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
                $achats = $achatManager->retrieveAllReglements($request['codeUsine'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($achats != null) {
                    $nbAchats = $achatManager->countReglement($request['codeUsine'], $sWhere);
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
        $this->logger->log->info('Action Remove user');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['achatId'])) {
                $this->logger->log->info('Remove with params : ' . $request['achatId']);
                $achatId = $request['achatId'];
                $achatManager = new AchatManager();
                $nbModified = $achatManager->remove($achatId);
                $this->doSuccess($nbModified, 'achat supprime');
            } else {
                $this->logger->log->error('Remove : Params not enough');
                $this->doError('-1', 'Impossible de supprimer cet achat');
            }
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('Erreur lors du traitement de votre requete');
        }
    }
    public function doUpdate($request) {
        try {
            if (isset($request['achatId']) && $request['achatId'] != "") {
                $achatId = $request['achatId'];
                $achatManager = new AchatManager();
                $achat = $achatManager->findById($achatId);
                $achat->setMontantTotal($request['montantTotal']);
                $achat->setModePaiement($request['modePaiement']);
                if ($request['modePaiement'] == 'CHEQUE')
                    $achat->setNumCheque($request['numCheque']);
                else if ($request['modePaiement'] == 'VIREMENT')
                    $achat->setDatePaiement(new \DateTime($request['datePaiement']));
                // $achat->setCodeUsine($request['codeUsine']);
                // $achat->setLogin($request['login']);
                if($achat->getRegle() != 2) {
                if ($request['avance'] != "") {
                    if ($request['regle'] == "true")
                        $achat->setRegle(2);
                    else
                        $achat->setRegle(1);
                    $reliquat = $request['montantTotal'] - $request['avance'];
                    $achat->setReliquat($reliquat);
                    $achat->setTransport($request['transport']);
                    $reglement = new Reglement\ReglementAchat();
                    $reglement->setAchat($achat);
                    $reglement->setDatePaiement(new \DateTime("now"));
                    $reglement->setAvance($request['avance']);
                    $reglementManager = new Reglement\ReglementManager();
                    $reglementManager->insert($reglement);
                }
                else {
                    $achat->setRegle(0);
                }
                }
                $achatAdded = $achatManager->update($achat);
                if ($achatAdded->getId() != null) {
                    $ligneAchatManager = new \Achat\LigneAchatManager();
                    $jsonAchat = json_decode($_POST['jsonProduit'], true);
                    foreach ($jsonAchat as $key => $ligne) {
                        if (isset($ligne["ligneId"])) {
                            $ligneAchat = $ligneAchatManager->findById($ligne["ligneId"]);
                            //$ligneAchat->setId($ligne["ligneId"]);
                            //$ligneAchat->setAchat($achat);
                            //$produitId = $ligne["ligneId"];
                            // $produitManager = new Produit\ProduitManager();
                            //$produit= $produitManager->findById($produitId);
                            // $ligneAchat->setProduit($produit);
                            $ligneAchat->setPrixUnitaire($ligne['pu']);
                            $ligneAchat->setQuantite($ligne['qte']);
                            $ligneAchat->setMontant($ligne['montant']);
                            $ligneAchatManager->update($ligneAchat);
                        }
                    }
                    $this->doSuccess($achatAdded->getId(), 'Achat mis à jour avec succes');
                } else {
                    $this->doError('-1', 'Impossible d\'effectuer ce reglement');
                }
            } else {
                $this->doError('-1', 'Impossible d\'effectuer ce reglement');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'Erreur lors du traitement de votre requete');
        }
    }

     public function doUpdateLigne($request) {
        try {
            if (isset($request['achatId']) && $request['achatId'] != "") {
                $achatId = $request['achatId'];
                $ligneId = $request['ligneId'];
                $pu = $request['pu'];
                $montant = $request['montant'];
                $montantTotal = $request['montantTotal'];
                $achatManager = new AchatManager();
                $achat = $achatManager->findById($achatId);
                $achat->setMontantTotal($montantTotal);
                $achatAdded = $achatManager->update($achat);
                if ($achatAdded->getId() !== null) {
                    $ligneAchatManager = new \Achat\LigneAchatManager();
                    $ligneAchat = $ligneAchatManager->findById($ligneId);
                    $ligneAchat->setPrixUnitaire($pu);
                    $ligneAchat->setMontant($montant);
                    $ligneAchatManager->update($ligneAchat);
                    $this->doSuccess($achatAdded->getId(), 'Achat mis à jour avec succes');
                } else {
                    $this->doError('-1', 'Impossible d\'effectuer ce reglement');
                }
            } else {
                $this->doError('-1', 'Impossible d\'effectuer ce reglement');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'Erreur lors du traitement de votre requete');
        }
    }

    public function doView($request) {
        
    }

    public function doValidAchat($request) {
        try {
            if ($request['achatId'] != null) {
                $achatManager = new AchatManager();

                //if($valid==1)
                $achatManager->ajoutStockParAchact($request['achatId']);
                $this->doSuccess($request['achatId'], 'Validation effectu� avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doAnnuleAchat($request) {
        try {
            if ($request['achatId'] != null) {
                $achatManager = new AchatManager();
                $achatManager->annulerStockParAchact($request['achatId']);
                $this->doSuccess($request['achatId'], 'Annulation effectuee avec succes');
            } else {
                $this->doError('-1', 'Params not enough');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doGetLastNumberAchat($request) {
        try {
            $achatManager = new AchatManager();
            $lastAchat = $achatManager->getLastNumberAchat($request['codeUsine']);
            $this->doSuccess($lastAchat, 'Dernier bon d\'achat');
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doStat($request) {
        try {
            if (isset($request['codeUsine'])) {
                $AchatManager = new AchatManager();
                $achat = $AchatManager->findStatisticByUsine($request['login'],$request['codeUsine']);
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

    public function doStatReglements($request) {
        try {
            if (isset($request['codeUsine'])) {
                $AchatManager = new AchatManager();
                $achat = $AchatManager->findStatisticReglementByUsine($request['codeUsine']);
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
            if (isset($request['achatId'])) {
                $achatManager = new AchatManager();
                $achatDetails = $achatManager->findAchatDetails($request['achatId']);
                if ($achatDetails != null)
                    $this->doSuccessO($achatDetails);
                else
                    echo json_encode(array());
            } else {
                $this->doError('-1', 'Chargement detail achat impossible');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }

    function doListInventaireAchat($request) {
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
                        $sOrder .= " numero desc";
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
                $achats = $achatManager->retrieveAchatInventaire($request['mareyeurId'],$request['dateDebut'], $request['dateFin'], $request['regle'], $request['usineCode'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($achats != null) {
                    $nbAchats = $achatManager->countInventaires($request['mareyeurId'],$request['dateDebut'], $request['dateFin'], $request['regle'], $request['usineCode'], $sWhere);
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
    
    public function doListGerant($request) {
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
    			$achats = $achatManager->retrieveAllAchatGerant($request['login'], $request['usineCode'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
    			if ($achats != null) {
    				$nbAchats = $achatManager->countAllAchatGerant($request['login'], $request['usineCode'], $sWhere);
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
    
    public function doGetInfoInventaire($request) {
        try {
            $achatManager = new AchatManager();
            $infos = $achatManager->getInfoInventaire($request['mareyeurId'], $request['typeAchat'],$request['dateDebut'],$request['dateFin'], $request['codeUsine']);
            $this->doSuccessO($infos);
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doStatGerant($request) {
    	try {
    		if (isset($request['codeUsine'])) {
    			$AchatManager = new AchatManager();
    			$achat = $AchatManager->findStatisticByUsineGerant($request['login'],$request['codeUsine']);
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

}

$oAchatController = new AchatController($_REQUEST);
