<?php


require_once '../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Article\TypeArticle as TypeArticle;
use Article\TypeArticleManager as TypeArticleManager;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class TypeArticleController extends BaseController implements BaseAction {

    
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
                        case \App::ACTION_LIST_VALID:
                                $this->doListValid($request);
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
                    if($request['libelle'] !="") {
                    $typeArticle = new TypeArticle();
                    $typeArticle->setLibelle($request['libelle']);
                    $typeArticleManager = new TypeArticleManager();
                    $typeArticleAdded = $typeArticleManager->insert($typeArticle);
                    if ($typeArticleAdded->getId() != null) {
                        $this->doSuccess($typeArticleAdded->getId(), $this->parameters['SAVED']);
                     
                    } }
                    else {
                    throw new Exception('impossible d\'inserer ce client');
                }
            
        } catch (Exception $e) {
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doUpdate($request) {
        $this->logger->log->info('Action Update contact');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['contactId']) && $request['cellular'] != '' && isset($request['cellular'])) {
                $contactManager = new ContactManager();
                $contactQueries = new \Contact\ContactQueries();
                $contact = $contactManager->findById($request['contactId']);
                if (isset($request['firstName'])) {
                    $contact->setFirstName($request['firstName']);
                }
                if (isset($request['lastName'])) {
                    $contact->setLastName($request['lastName']);
                }
                if (isset($request['email'])) {
                    $contact->setEmail($request['email']);
                }
                // enlever le prefix + et les espaces
                $cell=  str_replace('+', '', $request['cellular']);
                $cell=preg_replace('/\s+/', '', $cell);
                $contact->setCellular($cell);
                //vérification de la validité
                $validNumber= new \AtomicTask\ValidNumber();
                try{
                    $validNumber->testNumber($cell);
                    $contact->setValidate(1);
                    $contact->setReason(null);
                } catch (Exception $ex) {
                    $contact->setValidate(0);
                }
                
                $userManager = new \Customer\UserManager();
                $user = $userManager->findById($request['userId']);
                if ($user != null) {
                    $contact->setUser($user);
                    $this->logger->log->info('try to update contact :' . $contact->toString());
                    if (isset($request['addChamp'])) {
                        $this->logger->log->info('updating contact with addChamp :' . $request['addChamp']);
                        $contactManager->update($contact, $request['addChamp']);
                    } else {
                        $contactManager->update($contact);
                    }
                    $this->doSuccess($contact->getId(), $this->parameters['UPDATED']);
                } else {
                    $this->logger->log->info('Contact not update because user is NULL');
                    throw new ConstraintException($this->parameters['CONTACT_NOT_UPDATED']);
                }
            } else {
                $this->logger->log->trace('Update : Params not enough');
                throw new ConstraintException($this->parameters['CELLULAR_NOT_EMPTY']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doList($request) {
        try {
            $typeArticleManager = new TypeArticleManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('libelle');
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
                        $sWhere .= " (";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $typeProduits = $typeArticleManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($typeProduits != null) {
                    $nbTypeArticle = $typeArticleManager->count($sWhere);
                    $this->doSuccessO($this->dataTableFormat($typeProduits, $request['sEcho'], $nbTypeArticle));
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
public function doListValid($request) {
        try {
                $typeArticleManager = new TypeArticleManager();
                $groups = $typeArticleManager->retrieveAllTypes();
                if ($groups != NULL) {
                    $this->doSuccessO($this->listObjectToArray($groups));
                } else
                    echo json_encode(array());
           
        }  catch (Exception $e) {
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    public function doRemove($request) {
       
    }

    public function doView($request) {
    }

}

        $oTypeArticleController = new TypeArticleController($_REQUEST);