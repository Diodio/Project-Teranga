<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Produit\Produit as Produit;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Produit\ProduitManager as ProduitManager;
use Stock\StockProvisoire as StockProvisoire;
use Produit\StockManager as StockManager;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class ProduitController extends BaseController implements BaseAction {

    
    private $parameters;
            function __construct($request) {
       
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
                                $this->doGetProduitParUsine($request);
                                break;
                        case \App::ACTION_LIST_REEL_PAR_USINE:
                                $this->doGetProduitReelParUsine($request);
                                break;
                        case \App::ACTION_LIST_DEMOULAGES:
                                $this->doListDemoulages($request);
                                break;
                        case \App::ACTION_VIEW_DETAILS:
                                $this->doviewDetails($request);
                                break;
                        case \App::ACTION_LIST_VALID:
                                $this->doListProduitsDemoulages($request);
                                break;
                        case \App::ACTION_LIST_PRODUITS:
                                $this->doGetListProduit($request);
                                break;
                        case \App::ACTION_DETAIL_PRODUIT:
                                $this->doDetailProduit($request);
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
            if ($request['designation'] != "") {
                $produitManager = new ProduitManager();
                $checkProduit = $produitManager->findProduitsByName($request['designation']);
                if ($checkProduit == NULL) {
                    $produit = new Produit();
                    $produit->setLibelle($request['designation']);
                    $produit->setLibelleFacture($request['libelleFacture']);
                    $produitAdded = $produitManager->insert($produit);
                    if ($produitAdded->getId() != null) {
                        if ($request['stockProvisoire'] !== 0 || $request['stockReel'] !== 0) {
                            if ($request['stockProvisoire'] !== 0 && $request['stockReel'] == 0) {
                                $stock = new StockProvisoire();
                                $stock->setStock($request['stockProvisoire']);
                            } else if ($request['stockProvisoire'] == 0 && $request['stockReel'] !== 0) {
                                $stock = new \Stock\StockReel();
                                $stock->setStock($request['stockReel']);
                            } else if ($request['stockProvisoire'] !== 0 && $request['stockReel'] !== 0) {
                                $stock = new \Stock\StockReel();
                                $stock->setStock($request['stockReel']);
                                $stock1 = new \Stock\StockProvisoire();
                                $stock1->setStock($request['stockProvisoire']);
                                $stock1->setSeuil($request['seuil']);
                                $stock1->setCodeUsine($request['codeUsine']);
                                $stock1->setLogin($request['login']);
                                $stock1->setProduit($produit);
                                $stockManger1 = new \Stock\StockManager();
                                $stockManger1->insert($stock1);
                            }
                            $stock->setSeuil($request['seuil']);
                            $stock->setCodeUsine($request['codeUsine']);
                            $stock->setLogin($request['login']);
                            $stock->setProduit($produit);
                            $stockManger = new \Stock\StockManager();
                            $stockManger->insert($stock);
                        }
                        $this->doSuccess($produitAdded->getId(), 'Produit enregistré avec succes');
                    } else {
                        $this->doError('-1', 'Impossible d\'inserer ce produit');
                    }
                } else {
                    $this->doError('-1', 'Ce produit éxiste déja');
                }
            } else {
                $this->doError('-1', 'Veuillez vérifier vos parametres');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }

    public function doUpdate($request) {
        try {
            if ($request['designation'] != "") {
                $produitManager = new ProduitManager();
               $checkProduit = $produitManager->findProduitsByName($request['designation']);
                if ($checkProduit == NULL) {
                    $produit = new Produit();
                    $produit->setId($request['produitId']);
                    $produit->setLibelle($request['designation']);
                    $produit->setLibelleFacture($request['libelleFacture']);
                    $produitAdded = $produitManager->update($produit);
                    if ($produitAdded->getId() != null) {
                            $stockManager = new Stock\StockManager();
                            if ($request['stockProvisoire'] !== "0") {
                                $stockPro = $stockManager->findStockProvisoireByProduitId($request['produitId'], $request['codeUsine']);
                                if ($stockPro == 0) {
                                    $produitP=$produitManager->findById($request['produitId']);
                                    $stockP = new StockProvisoire();
                                    $stockP->setProduit($produitP);
                                    $stockP->setStock($request['stockProvisoire']);
                                    $stockP->setCodeUsine($request['codeUsine']);
                                    $stockP->setLogin($request['login']);
                                    $stockManager->insert($stockP);
                                } else {
                                    $stockManager->misAjourStockProvisoire($request['produitId'], $request['codeUsine'], $request['stockProvisoire']);
                                }
                            }
                            if ($request['stockReel'] !== "0") {
                                $stockReel = $stockManager->findStockReelByProduitId($request['produitId'], $request['codeUsine']);
                                if ($stockReel == 0) {
                                    $produitV=$produitManager->findById($request['produitId']);
                                    $stockR = new \Stock\StockReel();
                                    $stockR->setStock($request['stockReel']);
                                    $stockR->setSeuil($request['seuil']);
                                    $stockR->setCodeUsine($request['codeUsine']);
                                    $stockR->setLogin($request['login']);
                                    $stockR->setProduit($produitV);
                                    $stockManager1 =new Stock\StockManager();
                                    $stockManager1->insert($stockR);
                                    
                                }
                                else{
                                   $stockManager->misAjourStockReel($request['produitId'], $request['codeUsine'], $request['stockReel']) ;
                                }
                            }
                        
                        $this->doSuccess($produitAdded->getId(), 'Produit enregistré avec succes');
                    } else {
                        $this->doError('-1', 'Impossible d\'inserer ce produit');
                    }
                    
                }else {
                    $this->doError('-1', 'Ce produit éxiste déja');
                }
               
            } else {
                $this->doError('-1', 'Veuillez vérifier vos parametres');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }

    public function doList($request) {
        try {
    		$produitManager = new ProduitManager();
    		if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
    			// Begin order from dataTable
    			$sOrder = "";
    			$aColumns = array('id','libelle');
    			if (isset($request['iSortCol_0'])) {
    				$sOrder = "ORDER BY  ";
    				for ($i = 0; $i < intval($request['iSortingCols']); $i++) {
    					if ($request['bSortable_' . intval($request['iSortCol_' . $i])] == "true") {
    						$sOrder .= "" . $aColumns[intval($request['iSortCol_' . $i])] . " " .
    								($request['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
    					}
    				}
                               //  var_dump($sOrder);
    				$sOrder = substr_replace($sOrder, "", -2);
    				if ($sOrder == "ORDER BY") {
    					$sOrder .= " libelle asc";
    				}
    			}
                           
    			// End order from DataTable
    			// Begin filter from dataTable
    			$sWhere = "";
    			if (isset($request['sSearch']) && $request['sSearch'] != "") {
    				$sSearchs = explode(" ", $request['sSearch']);
    				//for ($j = 0; $j < count($sSearchs); $j++) {
    					$sWhere .= "( ";
    					for ($i = 0; $i < count($aColumns); $i++) {
    						$sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $request['sSearch'] . "%') OR";
    						if ($i == count($aColumns) - 1)
    							$sWhere = substr_replace($sWhere, "", -3);
    					}
    					$sWhere = $sWhere .=")";
    				//}
    			}
    			// End filter from dataTable
    			$demoulages = $produitManager->retrieveAll($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
    			if ($demoulages != null) {
    				$nb = $produitManager->countAllProduits($request['codeUsine'],$sWhere);
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

    public function doRemove($request) {
        try {
            if (isset($request['produitIds'])) {
                $produitId = $request['produitIds'];
                $codeUsine = $request['codeUsine'];
                $produitManager = new ProduitManager();
//                $verifAchat = $produitManager->verifieUsageProduitAchat($produitId);
//                $verifBonSortie = $produitManager->verifieUsageProduitBonSortie($produitId);
//                $verifFacture = $produitManager->verifieUsageProduitFacture($produitId);
                $verifSP = $produitManager->verifieUsageProduitStockProvisoire($produitId, $codeUsine);
                $verifSR = $produitManager->verifieUsageProduitStockReel($produitId, $codeUsine);
                $msg="";
                //var_dump($verifFacture);
//                if($verifAchat==1 && $verifBonSortie==0 && $verifFacture==0)
//                    $msg="Impossible de supprimer ce produit car il est utilisé dans bon d'achat";
//                else if($verifAchat==0 && $verifBonSortie==1 && $verifFacture==0 )
//                    $msg="Impossible de supprimer ce produit car il est utilisé dans bon de sortie";
//                else if($verifAchat==0 && $verifBonSortie==0 && $verifFacture==1 )
//                    $msg="Impossible de supprimer ce produit car il est utilisé dans facture";
//                else if($verifAchat==1 && $verifBonSortie==1 && $verifFacture==0 )
//                    $msg="Impossible de supprimer ce produit car il est utilisé dans bon d'achat et bon de sortie";
//                else if($verifAchat==1 && $verifBonSortie==0 && $verifFacture==1 )
//                    $msg="Impossible de supprimer ce produit car il est utilisé dans bon d'achat et facture";
//                else if($verifAchat==0 && $verifBonSortie==1 && $verifFacture==1 )
//                    $msg="Impossible de supprimer ce produit car il est utilisé dans bon de sortie et facture";
//                else if($verifAchat==1 && $verifBonSortie==1 && $verifFacture==1 )
//                    $msg="Impossible de supprimer ce produit car il est utilisé dans bon d'achat, bon de sortie et facture";
                    
                if($verifSP==1 && $verifSR==0)
                    $msg="Impossible de supprimer ce produit car il dipose d'un stock provisoire";
                if($verifSP==0 && $verifSR==1)
                    $msg="Impossible de supprimer ce produit car il dipose d'un stock réel";
                if($verifSP==1 && $verifSR==1)
                    $msg="Impossible de supprimer ce produit car il dipose d'un stock provisoire et réel";
                if($msg==""){
                   $nbModified = $produitManager->delete($produitId);
                   $this->doSuccess($nbModified, 'REMOVED');
                }
                else
                    $this->doError('-1', $msg);
               
            } else {
                $this->doError('-1', 'PRODUIT_NOT_REMOVED');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doView($request) {
       
        try {
            if (isset($request['produitId'])) {
                $produitManager = new ProduitManager();
                $produit = $produitManager->view($request['produitId']);
                $this->doSuccessO($produit);
            } else {
                throw new Exception('PARAM_NOT_ENOUGH');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

     public function doGetInfoProduct($request) {
        try {
            if (isset($request['produitId'])) {
                $produitManager = new ProduitManager();
                $prix = $produitManager->findPrixById($request['produitId']);
                if($prix !=null)
                    $this->doSuccessO($prix);
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
    
    public function doSearch($request) {
        try {
            if (isset($request['term'])) {
                $produitManager = new ProduitManager ();
                $term = trim(strip_tags($request['term']));
                $produits = $produitManager->findAllProduits($term);
                if ($produits != null)
                    $this->doSuccessO($this->listObjectToArray($produits));
                else
                    echo json_encode(array());
            }
            else {
                throw new ConstraintException($this->parameters['PARAM_NOT_ENOUGH']);
            }
        } catch (ConstraintException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function doGetProduitParUsine($request) {
        try {
            if (isset($request['codeUsine'])) {
                $produitManager = new ProduitManager();
                $produit = $produitManager->retrieveAllByUsine($request['codeUsine']);
                if($produit !=null)
                    $this->doSuccessO($produit);
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
    public function doGetListProduit($request) {
        try {
            if (isset($request['codeUsine'])) {
                $produitManager = new ProduitManager();
                $produit = $produitManager->retrieveAllByUsine();
                if($produit !=null)
                    $this->doSuccessO($produit);
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
    public function doGetProduitReelParUsine($request) {
        try {
            if (isset($request['codeUsine'])) {
                $produitManager = new ProduitManager();
                $produit = $produitManager->retrieveListStockProduitParUsine($request['codeUsine']);
                if($produit !=null)
                    $this->doSuccessO($produit);
                else
                   echo json_encode(array());  
            } else {
                throw new Exception('Parametre insuffisant');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }
    

     public function doListDemoulages($request) {
        try {
            $produitManager = new ProduitManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('libelle', 'stock');
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
                        $sOrder .= " libelle desc";
                    }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
                if (isset($request['sSearch']) && $request['sSearch'] != "") {
                    //$sSearchs = explode(" ", $request['sSearch']);
                   //for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= "( ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $request['sSearch'] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                       $sWhere = $sWhere .=")";
                   // }
                }
                // End filter from dataTable
                $demoulages = $produitManager->retrieveAllDemoulages($request['usineCode'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($demoulages != null) {
                    $nb = $produitManager->countAllDemoulages($request['usineCode'],$sWhere);
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
    
    public function doListProduitsDemoulages($request) {
        try {
            $produitManager = new ProduitManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('libelle', 'stock');
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
                        $sOrder .= " libelle desc";
                    }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
             if (isset($request['sSearch']) && $request['sSearch'] != "") {
                    //$sSearchs = explode(" ", $request['sSearch']);
                  //  for ($j = 0; $j < count($sSearchs); $j++) {
                  //      $sWhere .= " ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $request['sSearch'] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        // $sWhere = $sWhere .=")";
                //    }
                }
                // End filter from dataTable
                $demoulages = $produitManager->retrieveAllProduitsDemoulages($request['usineCode'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($demoulages != null) {
                    $nb = $produitManager->countAllProduitsDemoulee($request['usineCode'],$sWhere);
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
     public function doViewDetails($request) {
        try {
            if (isset($request['produitId'])) {
                $produitManager = new ProduitManager();
                $produitDetails = $produitManager->retrieveDetailProduit($request['produitId'], $request['codeUsine']);
                if ($produitDetails != null)
                    $this->doSuccessO($produitDetails);
                else
                    echo json_encode(array());
            } else {
                $this -> doError('-1', 'Chargement detail produit impossible');
            }
        
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }
    
    
    public function doDetailProduit($request) {
    	try {
    		$produitManager = new ProduitManager();
    		if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
    			// Begin order from dataTable
    			$sOrder = "";
    			$aColumns = array('id','libelle');
    			if (isset($request['iSortCol_0'])) {
    				$sOrder = "ORDER BY  ";
    				for ($i = 0; $i < intval($request['iSortingCols']); $i++) {
    					if ($request['bSortable_' . intval($request['iSortCol_' . $i])] == "true") {
    						$sOrder .= "" . $aColumns[intval($request['iSortCol_' . $i])] . " " .
    								($request['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
    					}
    				}
                               //  var_dump($sOrder);
    				$sOrder = substr_replace($sOrder, "", -2);
    				if ($sOrder == "ORDER BY") {
    					$sOrder .= " libelle desc";
    				}
    			}
                           
    			// End order from DataTable
    			// Begin filter from dataTable
    			$sWhere = "";
    			if (isset($request['sSearch']) && $request['sSearch'] != "") {
    				//$sSearchs = explode(" ", $request['sSearch']);
    				//for ($j = 0; $j < count($sSearchs); $j++) {
    					$sWhere .= "( ";
    					for ($i = 0; $i < count($aColumns); $i++) {
    						$sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $request['sSearch'] . "%') OR";
    						if ($i == count($aColumns) - 1)
    							$sWhere = substr_replace($sWhere, "", -3);
    					}
    					$sWhere = $sWhere .=")";
    				//}
    			}
    			// End filter from dataTable
    			$details = $produitManager->retrieveConsultDetailProduit($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
    			if ($details != null) {
    				$nb = $produitManager->countAllProduits($request['codeUsine'],$sWhere);
    				$this->doSuccessO($this->dataTableFormat($details, $request['sEcho'], $nb));
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

        $oProduitController = new ProduitController($_REQUEST);