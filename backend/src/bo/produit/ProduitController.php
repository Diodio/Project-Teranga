<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Produit\Produit as Produit;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Produit\ProduitManager as ProduitManager;
use Produit\FamilleProduitManager as FamilleProduitManager;
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
                                break;
                        case \App::ACTION_LIST_PAR_USINE:
                                $this->doGetProduitParUsine($request);
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
                    $produit->setPoidsBrut($request['poidsBrut']);
                    $produit->setPoidsNet($request['poidsNet']);
                    $produit->setPrixUnitaire($request['prixUnitaire']);
                    $produit->setStock($request['stock']);
                    $produit->setSeuil($request['seuil']);
                    $produit->setCodeUsine($request['codeUsine']);
                    $produit->setLogin($request['login']);
                    $produit->setFamilleProduit($famille);
                    $produitAdded = $produitManager->insert($produit);
                    if ($produitAdded->getId() != null) {
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
       
    }

    public function doList($request) {
        try {
            $produitManager = new ProduitManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('designation', 'poidsNet', 'prixUnitaire');
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
                $produits = $produitManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($produits != null) {
                    $nbProduits = $produitManager->count($sWhere);
                    $this->doSuccessO($this->dataTableFormat($produits, $request['sEcho'], $nbProduits));
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
            if (isset($request['productId'])) {
                $this->logger->log->info('View params : ' . $request['productId']);
                $produitManager = new ProduitManager();
                $produit = $produitManager->view($request['productId']);
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
            if (isset($request['libelle'])) {
                $produitManager = new ProduitManager();
                $produit = $produitManager->findProduitsByName($request['libelle']);
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

}

        $oProduitController = new ProduitController($_REQUEST);