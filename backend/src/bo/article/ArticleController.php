<?php


require_once '../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Article\Article as Article;
use Article\ArticleManager as ArticleManager;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Produit\ProduitManager as ProduitManager;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class ArticleController extends BaseController implements BaseAction {

    
    private $parameters;
            function __construct($request) {
       
        $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
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
                        case \App::ACTION_REVOKE:
                                $this->doRevoke($request);
                                break;
                        case \App::ACTION_IMPORT:
                                $this->doImport($request);
                            	break;
                        case \App::ACTION_EXPORT:
                                $this->doExport($request);
                        	break;
                        case \App::ACTION_SEARCH:
                                $this->doSearch($request);
                                break;
                        case \App::ACTION_COUNT_RECIPIENTS:
                                $this->doGetNbContacts($request);
                                break;
                        case \App::ACTION_DELETE_CONTACTADD:
                                $this->doDeleteContactAdd($request);
                                break;
                    }
            } else {
                throw new Exception($this->parameters['NO_ACTION']);
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        try {
                $produit = new Produit();
                $produitManager = new ProduitManager();
                    $produit->setLibelle($request['libelle']);
                    $produit->setQuantite($request['quantite']);
                    $produit->setPrixUnitaire($request['prixUnitaire']);
                    $produit->setSeuil($request['seuil']);
                    $produitAdded = $produitManager->insert($produit);
                    if ($produitAdded->getId() != null) {
                        $this->doSuccess($produitAdded->getId(), 'Produit enregistré avec succes');
                     
                } else {
                    throw new Exception('impossible d\'inserer ce produit');
                }
            
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doUpdate($request) {
      
    }

    public function doList($request) {
        try {
            $articleManager = new ArticleManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('libelle', 'prixUnitaire');
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
                $produits = $articleManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($produits != null) {
                    $nbProduits = $articleManager->count($sWhere);
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
        $this->logger->log->info('Action view contact');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['contactId'])) {
                $this->logger->log->info('View params : ' . $request['contactId']);
                $contactManager = new ContactManager();
                $contact = $contactManager->view($request['contactId']);
                $contactAddManager = new ContactAddManager();
                $contactAdd = $contactAddManager->retrieveAll($request['contactId']);
                $array['contact'] = (array) $contact;
                if (count($contactAdd) != 0) {
                    $array['addChamp'] = (array) $contactAdd;
                }
                // $this->logger->log->info('View contact with cellular'.$contact['cellular']);
                $this->doSuccessO($array);
            } else {
                $this->logger->log->trace('View : Params not enough');
                throw new ConstraintException($this->parameters['PARAM_NOT_ENOUGH']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doRevoke($request) {
        $this->logger->log->info('Action revoke contact');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['userId']) && isset($request['groupId']) && isset($request['contactIds'])) {
                $this->logger->log->info('Revoke with params groupId: ' . $request['groupId'] . ' AND contactIds ' . $request['contactIds']);
                if ($request['groupId'] != "*") {
                    $groupId = $request['groupId'];
                    $contactIds = $request['contactIds'];
                    $contactManager = new ContactManager();
                    $nbModified = $contactManager->revokeContact($groupId, $contactIds);
                    $this->doSuccess($nbModified, $this->parameters['REVOKED']);
                } else {
                    $this->logger->log->trace('Cette opération est impossible pour ce groupe');
                    throw new ConstraintException($this->parameters['OPERATION_IMPOSSIBLE']);
                }
            } else {
                $this->logger->log->trace('Revoke : Params not enough');
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
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

   
 

   

    

}

        $oArticleController = new ArticleController($_REQUEST);