<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Produit\Produit as Produit;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Produit\ProduitManager as ProduitManager;
use Produit\FamilleProduitManager as FamilleProduitManager;
use Stock\StockInitial as StockInitial;
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
                        case \App::ACTION_LIST_DEMOULAGES:
                                $this->doListDemoulages($request);
                                break;
                        case \App::ACTION_VIEW_DETAILS:
                                $this->doviewDetails($request);
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
            if ($request['familleId'] != "" && $request['designation'] != "") {
                $produitManager = new ProduitManager();
                $checkProduit = $produitManager->findProduitsByName($request['designation']);
                if ($checkProduit == NULL) {
                    $produit = new Produit();
                    $familleProduitManager = new FamilleProduitManager();
                    $famille = $familleProduitManager->findById($request['familleId']);
                    $produit->setLibelle($request['designation']);
                    $produit->setFamilleProduit($famille);
                    $produitAdded = $produitManager->insert($produit);
                    if ($produitAdded->getId() != null) {
                        if($request['stockInitial'] !==0 && $request['stockFinal'] ==0){
                            $stock = new StockInitial();
                            $stock->setStock($request['stockInitial']);
                        }
                        else if($request['stockInitial'] ==0 && $request['stockFinal'] !==0){ 
                            $stock = new \Stock\StockFinal();
                            $stock->setStock($request['stockFinal']);
                        }
                        else if($request['stockInitial'] !=0 && $request['stockFinal'] !=0){ 
                            $stock = new \Stock\StockFinal();
                            $stock->setStock($request['stockFinal']);
                        }
                        //$stock->setSeuil($request['seuil']);
                        $stock->setCodeUsine($request['codeUsine']);
                        $stock->setLogin($request['login']);
                        $stock->setProduit($produit);
                        $stockManger = new \Stock\StockManager();
                        $stockManger->insert($stock);
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
           
             $produitManager = new ProduitManager();
             if($request['oper'] == 'edit') {
                $produit = $produitManager->findById($request['id']);
                $produit->setLibelle($request['designation']);
                $produitUpdated = $produitManager->update($produit);
                if ($produitUpdated->getId() != null) {
                        $this->doSuccess($produitUpdated->getId(), 'Produit mis à jour avec succes');
                } else {
                    throw new Exception('impossible d\'inserer ce produit');
                }
             }
             else if($request['oper'] == 'del'){
                 if($request['id'] !=null) {
                     $nbLines = $produitManager->delete($request['id']);
                     $this->doSuccess($nbLines, 'REMOVED');
                 }
                 else {
                     throw new Exception('impossible de supprimer ce mareyeur');
                 }
                     
             }
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doList($request) {
        try {
            if (isset($request['familleId'])) {
                $produitManager= new ProduitManager();
                $produits = $produitManager->retrieveAll($request['familleId']);
                if ($produits != NULL) {
                    $this->doSuccessO($this->listObjectToArray($produits));
                } else
                    echo json_encode(array());
            }else {
                $this->doError('-1', 'Veuillez vérifier vos parametres');
            }
        } catch (ConstraintException $e) {
            throw $e;
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }

    public function doRemove($request) {
        $this->logger->log->info('Action Remove contact');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['contactIds'])) {
                $this->logger->log->info('Remove with params : ' . $request['contactIds']);
                $contactId = $request['contactIds'];
                $contactManager = new ContactManager();
                $nbModified = $contactManager->remove($contactId);
                $this->doSuccess($nbModified, $this->parameters['REMOVED']);
            } else {
                $this->logger->log->trace('Remove : Params not enough');
                $this->doError('-1', $this->parameters['CONTACT_NOT_REMOVED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
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
                $demoulages = $produitManager->retrieveAllDemoulages($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($demoulages != null) {
                    $nb = $produitManager->countAllDemoulages($request['codeUsine'],$sWhere);
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
                $achatDetails = $produitManager->retrieveAll($request['produitId']);
                if ($achatDetails != null)
                    $this->doSuccessO($achatDetails);
                else
                    echo json_encode(array());
            } else {
                $this -> doError('-1', 'Chargement detail produit impossible');
            }
        
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }
}

        $oProduitController = new ProduitController($_REQUEST);