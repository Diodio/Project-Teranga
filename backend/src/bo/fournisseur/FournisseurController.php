<?php


require_once '../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Client\Client as Client;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Client\ClientManager as ClientManager;
use tools\Tool as Tool;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class FournisseurController extends BaseController implements BaseAction {

    
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
                $client = new Client();
                    $client->setNom($request['nom']);
                    $client->setPrenom($request['prenom']);
                    $client->setAdresse($request['adresse']);
                    $client->setTelephone($request['telephone']);
                    $clientManager = new ClientManager();
                    $clientAdded = $clientManager->insert($client);
                    if ($clientAdded->getId() != null) {
                        $this->doSuccess($clientAdded->getId(), $this->parameters['SAVED']);
                     
                } else {
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
            $clientManager = new ClientManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('id', 'nom', 'prenom', 'adresse', 'telephone');
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
                        $sWhere .= " AND (";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(c." . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $clients = $clientManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($clients != null) {
                    $nbContact = $clientManager->count($sWhere);
                    $this->doSuccessO($this->dataTableFormat($clients, $request['sEcho'], $nbContact));
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

    public function doImport($request) {
        $this->logger->log->trace('Action Importer liste de contacts');
        $this->logger->log->trace(json_encode($request));
        $contactExist = 0;
        $nbr_ins_contacts = 0;
        $contactsList = array();
        $separateur= $request['separateur'];
        $champs = json_decode($request['champs']);
        try {
            $fileContent = $_FILES['contactfile']['tmp_name'];
            $filename = $_FILES['contactfile']['name'];
            $this->logger->log->trace($fileContent);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $this->logger->log->trace($ext);
            if($ext=='csv'){
                if(($handle = fopen($fileContent, 'r')) !== FALSE) {
                    set_time_limit(0);

                    $row = 0;

                    while(($data = fgetcsv($handle, 1000000, $separateur)) !== FALSE) {
                        // number of fields in the csv
                        $num = count($data);
                        for ($i=0; $i<$num; $i++){
                            $j=$i+1;
                            $contactsList[$row]['champs_'.$j] = $data[$i];
                        }
                        $row++;
                    }
                    
                    fclose($handle);
                }
            }else if($ext=='xlsx'){
                $this->logger->log->trace('is xlsx');
                $fichierxlsx = new SimpleXLSX($fileContent);
                $contactsList=array();
                foreach ($fichierxlsx->rows() as $keyRow => $cellIterator) {
                    $contact=array();
                    $j=0;
                    foreach ($cellIterator as $cell) {
                        $contact['champs_'.$j] = ''.$cell;
                        $j++;
                    }
                    $this->logger->log->trace('one contact ' . json_encode($contact));
                    if(count($contact)!=0){
                        $contactsList[]=$contact;
                    }
                }
            }
            $this->logger->log->trace('file ' . json_encode($contactsList));
            
            $champsGroups = $request['groups'];
            $this->logger->log->trace('contacts ' . json_encode($contactsList));
            $this->logger->log->trace('champs ' . json_encode($champs));
            $this->logger->log->trace('champsgroup ' . json_encode($champsGroups));
            
            $groups = null;
            if ($champsGroups != ''):
                $groups = json_decode($champsGroups);
            endif;
            $this->logger->log->trace('user id ' . $request['userId']);
            $userManager = new \Customer\UserManager();
            $user = $userManager->findById($request['userId']);
            $group = null;
            if (isset($request['groupId'])) {
                $groupQueries = new GroupQueries();
                $group = $groupQueries->findById($request['groupId']);
            }
            $compteur = 0;
            foreach ($champs as $key => $value) {
                if (in_array($value, array('firstName', 'lastName', 'cellular', 'email'))) {
                    ${'champ_' . $value} = $key;
                }
            }
            foreach ($contactsList as $contactSeul) {
                $this->logger->log->trace(json_encode($contactSeul));
                if ($_POST['aEntete'] == "true"):
                    if ($contactsList[0] == $contactSeul)
                        continue;
                endif;
                $additionalFields = null;
                foreach ($champs as $cc => $vc):
                    if (!in_array($vc, array('firstName', 'lastName', 'cellular', 'email'))) {
                        if ($groups != null) {
                            $this->logger->log->trace('group: cc ' . $cc . ' vc ' . $groups->$vc);
                            $additionalFields .= $groups->$vc . "," . $champs->$cc . "," . $contactSeul[$cc] . "|";
                        }
                    }
                endforeach;
                
                $contact = new Contact();
                if (isset($champ_firstName) && $champ_firstName != null)
                    if (isset($contactSeul[$champ_firstName]))
                        $contact->setFirstName($contactSeul[$champ_firstName]);

                if (isset($champ_lastName) && $champ_lastName != null)
                    if (isset($contactSeul[$champ_lastName]))
                        $contact->setLastName($contactSeul[$champ_lastName]);

                if (isset($champ_email) && $champ_email != null)
                    if (isset($contactSeul[$champ_email]))
                        $contact->setEmail($contactSeul[$champ_email]);

                if (isset($champ_cellular) && $champ_cellular != null)
                    if (isset($contactSeul[$champ_cellular]))
                        $contact->setCellular($contactSeul[$champ_cellular]);
                
                
                $this->logger->log->trace('trace process...');
                if (isset($contactSeul[$champ_cellular]) && $contactSeul[$champ_cellular] != "") {
                    if ($user != null) {
                        $this->logger->log->trace('etape 1...');
                        $contact->setUser($user);
                        $contactManager = new ContactManager();
                        $this->logger->log->info('try to insert contact with params : ');
                        if ($additionalFields != null) {
                            try {
                                $testnumero = new \AtomicTask\ValidNumber();
                                $this->logger->log->info('contactSeul : ' . json_encode($contactSeul));
                                $this->logger->log->info('champ cellular : ' . $champ_cellular);
                                $testnumero->testNumber($contactSeul[$champ_cellular]);
                                $contact->setValidate(true);
                                $contact->setOrigine('import');
                                $contactManager->insert($contact, $group, $additionalFields);
                                if ($contact->getId() == null){
                                    $contactExist++;
                                }
                            } catch (\Exception $ex) {
                                $this->logger->log->trace("Code d'erreur => " . $ex->getCode());
                                $codeManager = new \Code\CodeManager();
                                $objectCode = $codeManager->getByCode($ex->getCode());
                                $contact->setValidate(false);
                                $contact->setOrigine('import');
                                $contact->setReason($objectCode->getMessage());
                                $contactManager->insert($contact, $group, $additionalFields);
                                if ($contact->getId() == null){
                                    $contactExist++;
                                   $groupContactManager = new GroupContactManager();
                                    $groupContactManager->insert($contact, $group);
                                    $contactManager->insert($contact, $group);
                                }
                            }
                        }
                        else {
                            try {
                                $this->logger->log->trace('etape 2...');
                                $testnumero = new \AtomicTask\ValidNumber();
                                $testnumero->testNumber($contactSeul[$champ_cellular]);
                                $contact->setValidate(true);
                                $contact->setOrigine('import');
                                $this->logger->log->trace('etape 3...');
                                $contactManager->insert($contact, $group);
                                $this->logger->log->trace('etape 4...');
                                if ($contact->getId() == null){
                                    $this->logger->log->trace('etape 4.1 ...');
                                    $this->logger->log->trace('insertion dans groupContact ...');
                                    $objectContact= $contactManager->findContactByCellular($contactSeul[$champ_cellular], $request['userId']);
                                    $contactManager->insertGroupContact($objectContact, $group);
                                    $this->logger->log->trace('insertion effectuee ...');
                                    $contactExist++;
                                }
                            } catch (\Exception $ex) {
                                $this->logger->log->trace("Code d'erreur => " . $ex->getCode());
                                $this->logger->log->trace('etape 5...');
                                $codeManager = new \Code\CodeManager();
                                $objectCode = $codeManager->getByCode($ex->getCode());
                                $contact->setValidate(false);
                                $contact->setOrigine('import');
                                $contact->setReason($objectCode->getMessage());
                                $this->logger->log->trace('etape 6...');
                                $contactManager->insert($contact, $group);
                                $this->logger->log->trace('etape 7...');
                                if ($contact->getId() == null){
                                $this->logger->log->trace('etape 8...');
                                    if ($contact->getId() == null){
                                        $this->logger->log->trace('etape 8.1 ...');
                                        $contactExist++;
                                        if(is_numeric($contactSeul[$champ_cellular])){
                                            $objectContact= $contactManager->findContactByCellular($contactSeul[$champ_cellular], $request['userId']);
                                            $contactManager->insertGroupContact($objectContact, $group);
                                        }
                                }
                                
                                }
                            }
                        }
                        if ($contact != null && $contact->getId() != null) {
                            $nbr_ins_contacts++;
                        }
                    } else {
                        $this->logger->log->trace('etape 9...');
                        $this->logger->log->trace('Contact not inserted because user is NULL');
                        throw new ConstraintException($this->parameters['CONTACT_NOT_INSERTED']);
                    }
                } else {
                    
                                $this->logger->log->trace('etape 10...');
                    throw new ConstraintException($this->parameters['CONTACT_NOT_INSERTED']);
                }
            }

                                $this->logger->log->trace('etape 11...');
            $this->doSuccessImport($nbr_ins_contacts, $contactExist);
        } catch (\Doctrine\DBAL\DBALException $e) {
            
                                $this->logger->log->trace('etape 12...');
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doSuccessImport($nbr_ins_contacts, $contactExist);
        } catch (ConstraintException $e) {
            
                                $this->logger->log->trace('etape 13...');
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getLine());
            $this->doSuccessImport($nbr_ins_contacts, $contactExist);
        } catch (Exception $e) {
            
                                $this->logger->log->trace('etape 14...');
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doExport($request) {
        $this->logger->log->info('Action export contacts');
        $this->logger->log->trace(json_encode($request));
        try {
            if (isset($request ['userId']) && isset($request ['groupId'])) {
                $groupId = $request ['groupId'];
                $userId = $request ['userId'];
                $contactManager = new ContactManager ();
                $contacts = $contactManager->findContactsByGroup($userId, $groupId);
                $data = $this->parameters['ENTETE_EXPORT']."\n";
                foreach ($contacts as $contact) {
                    $data.=$contact[1] . ";" . $contact[2] . ";" . $contact[3] . ";" . $contact[4] . ";" . $contact[5] . ";" . $contact[6] . "\n";
                }
                header('Expires: 0');
                header('Cache-control: private');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Content-Description: File Transfer');
                header("Content-type: application/vnd.ms-excel");
                header('Content-Type: charset=utf-8');
                header('Content-disposition: attachment; filename="fichier.csv"');
                echo "\xEF\xBB\xBF"; // UTF-8 BOM
                echo $data;
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
        $this->logger->log->info('Action view Search Contacts');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request ['userId']) && isset($request['term'])) {
                $userId = $request['userId'];
                $contactManager = new ContactManager ();
                $term = trim(strip_tags($request['term']));
                $this->logger->log->trace($userId);
                $contacts = $contactManager->findAllRecipients($userId, $term);
                if ($contacts != null)
                    $this->doSuccessO($this->listObjectToArray($contacts));
                else
                    echo json_encode(array());
            }
            else {
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

    public function doGetNbContacts($request) {
        $this->logger->log->info('Action to count number of recipients');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['groups'])) {
                $contactManager = new ContactManager();
                $recipients = $contactManager->getNbRecipients($request['groups'],$request['userId']);
                if ($recipients != null)
                    $this->doSuccessO($recipients);
                else
                    echo json_encode(array());
            } else {
                $this->logger->log->trace('count recipients : Params not enough');
                throw new ConstraintException($this->parameters['PARAM_NOT_ENOUGH']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }
    public function doDeleteContactAdd($request) {
        $this->logger->log->info('Action delete contact add');
        $this->logger->log->info(json_encode($request));
        try {
            if(isset($request['id'])){
                $id=$request['id'];
                $contactAddMng=new ContactAddManager();
                $removed=$contactAddMng->removeById($id);
                if(is_numeric($removed)){
                    echo $removed;
                }else{
                    throw new ConstraintException($this->parameters['ERREUR_SERVEUR']);
                }
                
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }

}

        $oFournisseurController = new FournisseurController($_REQUEST);