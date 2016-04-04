<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
;

use Exceptions\ConstraintException as ConstraintException;
use App as App;
use Log\Loggers as Logger;
use Produit\DemoulageManager as DemoulageManager;

class DemoulageController extends BaseController {

    private $parameters;
    private $logger;

    function __construct($request) {

        $this->logger = new Logger(__CLASS__);
        // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_INSERT:
                        $this->doInsert($request);
                        break;
                    case \App::ACTION_GET_COLIS:
                        $this->doGetColis($request);
                        break;
                    case \App::ACTION_GET_NBCOLIS:
                        $this->doGetNbColis($request);
                        break;
                    case \App::ACTION_GET_COLISAGES:
                        $this->doVerifieColis($request);
                        break;
                    case \App::ACTION_GET_INFOS:
                        $this->doGetQuantite($request);
                        break;
                    case \App::ACTION_LIST_DEMOULE:
                        $this->doListeDemoule($request);
                        break;
                    case \App::ACTION_LIST_DEMOULE_ANNULE:
                        $this->doListeDemouleAnnnule($request);
                        break;
                    case \App::ACTION_GET_COLIS_DEMOULAGE:
                        $this->doGetColisColisage($request);
                        break;
                    case \App::ACTION_GET_LAST_NUMBER:
                        $this->doGetLastNumber($request);
                        break;
                    case \App::ACTION_DESACTIVER:
                        $this->doAnnuler($request);
                        break;
                    case \App::ACTION_REMOVE:
                        $this->doRemove($request);
                        break; 
                    case \App::ACTION_VERIFY_COLISAGE:
                        $this->doVerifieColisage($request);
                        break; 
                }
            } else {
                throw new Exception('NO ACTION');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        try {
            if ($request['produitId'] != "" && $request['numero'] != "" && $request['quantiteDemoulee'] != "") {
                $produitManager = new \Produit\ProduitManager();
                $produit = $produitManager->findById($request['produitId']);
                $demoulageManager = new Produit\DemoulageManager();
                $demoulage = new Produit\Demoulage();
                $demoulage->setProduit($produit);
                $demoulage->setNumero($request['numero']);
                $demoulage->setQuantiteAvantDemoulage($request['stockProvisoire']);
                $demoulage->setQuantiteDemoulee($request['quantiteDemoulee']);
                $demoulage->setCodeUsine($request['codeUsine']);
                $demoulage->setLogin($request['login']);
                $jsonCarton = json_decode($_POST['jsonCarton'], true);
                $added = $demoulageManager->insert($demoulage, $jsonCarton);
                if ($added != NULL) {
//                    $stockManager = new \Stock\StockManager();
//                    $stockManager->ajoutStockReelParProduit($request['produitId'], $request['codeUsine'], $request['login'], $request['stockProvisoire'], $request['quantiteDemoulee']);
                    $this->doSuccess($demoulage->getId(), 'Produit demoulé avec succes');
                }
                else
                    $this->doError('-1', 'Impossible de créer ce demoulage');
            }
            else {
                $this->doError('-1', 'Veuillez vérifier vos parametres');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'Impossible de créer ce demoulage');
        }
    }

    public function doGetColis($request) {
        try {
            if (isset($request['produitId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $infoscolis = $demoulageManager->getAllColis($request['produitId'], $request['codeUsine']);
                if ($infoscolis != NULL) {
                    $this->doSuccessO($infoscolis);
                } else {
                    echo json_encode(array());
                }
            } else {
                $this->doError('-1', 'Données invalides');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doGetColisColisage($request) {
        try {
            if (isset($request['demoulageId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $infoscolis = $demoulageManager->getAllColisDemoulage($request['demoulageId'], $request['codeUsine']);
                if ($infoscolis != NULL) {
                    $this->doSuccessO($infoscolis);
                } else {
                    echo json_encode(array());
                }
            } else {
                $this->doError('-1', 'Données invalides');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doVerifieColis($request) {
        try {
            if (isset($request['produitId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $infoscolis = $demoulageManager->verificationColis($request['produitId'], $request['nbColis'], $request['quantite']);
                $this->doSuccess($infoscolis, 'Produit demoulé avec succes');
            } else {
                $this->doError('-1', 'Données invalides');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    public function doVerifieColisage($request) {
        
        try {
            $trouve=0;
            if (isset($_POST['jsonColis'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $jsonColis = json_decode($_POST['jsonColis'], true);
                foreach ($jsonColis as $key => $ligneC) {
                    if(isset($ligneC['produitId']) && isset($ligneC['nombreCarton']) && isset($ligneC['quantiteParCarton']) && isset($request['codeUsine']))
                        $infoscolis = $demoulageManager->verificationColisage($ligneC['produitId'], $ligneC['nombreCarton'], $ligneC['quantiteParCarton'], $request['codeUsine']);
                        if($infoscolis==0){
                            $trouve++;
                    }
                }
                $this->doSuccess($trouve, 'get colisage');
            } else {
                $this->doError('-1', 'Données invalides');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
    
    
    public function doGetQuantite($request) {
        try {
            if (isset($request['produitId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $colis = $demoulageManager->getQuantiteColisage($request['produitId'], $request['codeUsine']);
                if ($colis != null)
                    $this->doSuccessO($colis);
                else
                    echo json_encode(array());
            } else {
                throw new Exception('PARAM_NOT_ENOUGH');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }
    public function doGetNbColis($request) {
        try {
            if (isset($request['produitId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $colis = $demoulageManager->getNBColis($request['produitId'], $request['codeUsine']);
                if ($colis != null)
                    $this->doSuccessO($colis);
                else
                    echo json_encode(array());
            } else {
                throw new Exception('PARAM_NOT_ENOUGH');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }
    
    public function doListeDemoule($request) {
        try {
            $this->logger->log->info(json_encode($request));
            $demoulageManager = new DemoulageManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('numero', 'libelle', 'quantiteDemoulee');
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
//                 if (isset($request['sSearch']) && $request['sSearch'] != "") {
//                     $sSearchs = explode(" ", $request['sSearch']);
//                     for ($j = 0; $j < count($sSearchs); $j++) {
//                         $sWhere .= "( ";
//                         for ($i = 0; $i < count($aColumns); $i++) {
//                             $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
//                             if ($i == count($aColumns) - 1)
//                                 $sWhere = substr_replace($sWhere, "", -3);
//                         }
//                         $sWhere = $sWhere .=")";
//                     }
//                 }
                // End filter from dataTable
                $demoulages = $demoulageManager->retrieveAll($request['etat'], $request['usineCode'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($demoulages != null) {
                    $nb = $demoulageManager->countAll($request['etat'], $request['usineCode'], $sWhere);
                    $this->doSuccessO($this->dataTableFormat($demoulages, $request['sEcho'], $nb));
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

    public function doGetLastNumber($request) {
        try {
            $demooulageManager = new DemoulageManager();
            $last = $demooulageManager->getLastNumber();
            $this->doSuccess($last, 'Dernier bon');
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doAnnuler($request) {
        try {
            if ($request['demoulageId'] != null) {
                $demoulageManager = new DemoulageManager();
                $demou = $demoulageManager->annulerParDemoulagId($request['demoulageId']);
                if($demou!=NULL)
                    $this->doSuccess($request['demoulageId'], 'Annulation effectuee avec succes');
                else
                    $this->doError('-1', 'Impossible d\'annuler ce demoulage car les cartons sont  deja utilises');
            } else {
                $this->doError('-1', 'Veuiillez verifier vos parametres SVP!');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doRemove($request) {
        try {
            if (isset($request['demoulageId'])) {
                $demoulageId = $request['demoulageId'];
                $demoulageManager = new DemoulageManager();
                $nbModified = $demoulageManager->remove($demoulageId);
                $this->doSuccess($nbModified, 'demoulage supprime');
            } else {
                $this->doError('-1', 'Impossible de supprimer ce demoulage');
            }
        } catch (Exception $e) {
            throw new Exception('Erreur lors du traitement de votre requete');
        }
    }
    
    public function doListeDemouleAnnnule($request) {
    	try {
    		$this->logger->log->info(json_encode($request));
    		$demoulageManager = new DemoulageManager();
    		if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
    			// Begin order from dataTable
    			$sOrder = "";
    			$aColumns = array('numero', 'libelle', 'quantiteDemoulee');
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
    			//                 if (isset($request['sSearch']) && $request['sSearch'] != "") {
    			//                     $sSearchs = explode(" ", $request['sSearch']);
    			//                     for ($j = 0; $j < count($sSearchs); $j++) {
    			//                         $sWhere .= "( ";
    			//                         for ($i = 0; $i < count($aColumns); $i++) {
    			//                             $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
    			//                             if ($i == count($aColumns) - 1)
    				//                                 $sWhere = substr_replace($sWhere, "", -3);
    				//                         }
    				//                         $sWhere = $sWhere .=")";
    				//                     }
    				//                 }
    			// End filter from dataTable
    			$demoulages = $demoulageManager->retrieveAllAnnules($request['etat'], $request['usineCode'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
    			if ($demoulages != null) {
    				$nb = $demoulageManager->countAll($request['etat'], $request['usineCode'], $sWhere);
    				$this->doSuccessO($this->dataTableFormat($demoulages, $request['sEcho'], $nb));
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

}

$oDemoulageController = new DemoulageController($_REQUEST);
