<?php
session_start();
/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Group
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;  
    

use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Utilisateur\UtilisateurManager as UtilisateurManager;
use Log\Loggers as Logger;
use Exceptions\ConstraintException as ConstraintException;
use Utilisateur\ProfilManager as ProfilManager;
class UtilisateurController extends BaseController implements BaseAction {

    private $userManager;
    private $user;
    private $logger;
    private $parameters;
    
private $langageManager;
    public function __construct($request) {
        $this->logger = new Logger(__CLASS__);
//        if(isset($_COOKIE['userLanguage'])){
//            $lang = $_COOKIE['userLanguage'];
//        }else{
//            $lang =  $_COOKIE['partnerLanguage'];
//        }
//        $this->parameters = parse_ini_file("../../../../portail/lang/trad_".$lang.".ini");
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_INSERT:
                        $this->doInsert($request);
                        break;
                    case \App::ACTION_LIST_PROFIL:
                        $this->doListProfil($request);
                        break;
                    case \App::ACTION_UPDATE:
                        $this->doUpdate($request);
                        break;
                    case \App::ACTION_REMOVE:
                        $this->doRemove($request);
                        break;
                    case \App::ACTION_ACTIVER:
                        $this->doActiver($request);
                        break;
                    case \App::ACTION_DESACTIVER:
                        $this->doDesactiver($request);
                        break;
                    case \App::ACTION_VIEW:
                        $this->doView($request);
                        break;
                    case \App::ACTION_LIST:
                        $this->doList($request);
                        break;
                    case \App::ACTION_SIGNIN:
                        $this->doSignin($request);
                        break;
                    case \App::ACTION_SIGNOUT:
                        $this->doSignout($request);
                        break;
                    case \App::ACTION_GET_PASSWORD:
                        $this->doGetPassword($request);
                        break;
                    case \App::ACTION_SET_PASSWORD:
                        $this->doSetPasswordRecovery($request);
                        break;
                    case \App::ACTION_ACTIVE_BIRTHDAY:
                        $this->doActiveBirthday($request);
                        break;
                    case \App::ACTION_DESACTIVE_BIRTHDAY:
                        $this->doDesactiveBirthday($request);
                        break;
                     case \App::ACTION_GET_STATUS_BIRTHDAY:
                        $this->doGetStatusBirthday($request);
                        break;
                     case \App::ACTION_GET_CONTACTS_BIRTHDAY:
                        $this->doGetContactsBirthday($request);
                        break;
                     case \App::ACTION_SAVE_BIRTHDAY:
                        $this->doSaveBirthday($request);
                        break;
                     case \App::ACTION_INSERT_BIRTHDAY_PARAMETRE:
                        $this->doInsertBirthdayParametre($request);
                        break;
                    case \App::ACTION_CAMPAIGN_ALERTMAIL:
                        $this->doAlertMail($request);
                        break;
                    case \App::ACTION_CAMPAIGN_SAVEMAIL:
                        $this->doSaveMail($request);
                        break;
                    case \App::ACTION_CAMPAIGN_NOTALERTMAIL:
                        $this->doNotAlertMail($request);
                        break;
                    case \App::ACTION_CAMPAIGN_LOADDEFAULT:
                        $this->doLoadOtherParameters($request);
                        break;
                    case \App::ACTION_ACTIVATE_CAMPAIGN_TEST:
                        $this->doActiveCampaignTest($request);
                        break;
                    case \App::ACTION_DEACTIVATE_CAMPAIGN_TEST:
                        $this->dodeActiveCampaignTest($request);
                        break;
                }
            } else
                throw new Exception($this->parameters['NO_ACTION']);
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doSaveMail($request) {
        $this->logger->log->info('Action Save email');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['userId']) && isset($request['mail']) && isset($request['checkedA'])) {
                 $this->userManager = new UtilisateurManager();
                 $this->user = $this->userManager->saveMailAddress($request['userId'],$request['mail']);
                 $this->doSuccess($this->user,$this->parameters['GEN_SAVED']);
            }else{
                $this->logger->log->error('SaveMail : Params not enough');
                $this->doError('-1', $this->parameters['GEN_NOT_SAVED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doAlertMail($request) {
        $logger = new Logger(__CLASS__);
        try {
            if (isset($request['userId']) && isset($request['checkedA'])) {
                 $this->userManager = new UtilisateurManager();
                 $this->user = $this->userManager->activeAlertMail($request['userId']);
                 $this->doSuccess($this->user,$this->parameters['GEN_SAVED']);
            }else{
                $this->logger->log->error('AlertMail : Params not enough');
                $this->doError('-1', $this->parameters['GEN_NOT_SAVED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function doNotAlertMail($request) {
        $logger = new Logger(__CLASS__);
        try {
            if (isset($request['checkedA'])) {
                 $this->userManager = new UtilisateurManager();
                 $this->user = $this->userManager->deactiveAlertMail($request['userId']);
                 $this->doSuccess($this->user,$this->parameters['GEN_SAVED']);
            }else{
                $this->logger->log->error('AlertMail : Params not enough');
                $this->doError('-1', $this->parameters['GEN_NOT_SAVED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function doLoadOtherParameters($request) {
        $logger = new Logger(__CLASS__);
        try {
            if (isset($request['userId'])) {
                $this->userManager = new UtilisateurManager();
                $mail = $this->userManager->loadOtherParameters($request['userId']);
                    if($mail!= NULL){
                    $this->doSuccessO($mail);
                    }  else {
                         echo json_encode(array());
                    }
        } else{
                $this->logger->log->error('AlertMail : Invalid Data');
                $this->doError('-1', $this->parameters['INVALID_DATA']);
        }}catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
   
    }
    
    public function doInsert($request) {
        $logger=new Logger(__CLASS__);
        try{
            $logger->log->trace("Debut insertion user");
            if(isset($request['ACTION']) && isset($request['nom']) && isset($request['login']) && isset($request['password']) && isset($request['usineId']) && isset($request['profilId'])){
                $userId=$request['userId'];
                $nom=$request['nom'];
                $login=$request['login'];
                $password=$request['password'];
                $usineId=  $request['usineId'];
                $profilId=$request['profilId'];
                if($nom!="" && $login!="" && $password!="" && $usineId!="-1" && $profilId!="-1"){
                    $userManager =new UtilisateurManager();
                    $user=new Utilisateur\Utilisateur();
                    if($userId !=0)
                        $user->setId ($userId);
                    $user->setNomUtilisateur($nom);
                    $user->setLogin($login);
                    $user->setPassword($password);
                    $user->setStatus(1);
                    $user->setEtatCompte(1);
                    $usineManager = new Usine\UsineManager();
                    $usine=$usineManager->findById($usineId);
                    $user->setUsine($usine);
                    $profilManager = new ProfilManager();
                    $profil=$profilManager->findById($profilId);
                    $user->setProfil($profil);
                    $logger->log->trace("Debut insertion user1");
                    $userManager->createOrEdit($user);
                    if($user->getId()!=null){
                        $this->doSuccess($user->getId(),'Utilisateur créé avec succes');
                    }else{
                        throw new ConstraintException('Cet utilisateur existe deja');
                    }
                }
            }else{
                $this->logger->log->error('List : Params not enough');
                $this->doError('-1', 'Insertion impossible');
            }
            $logger->log->trace("Fin insertion user");
        } 
        catch (Exception $e) {
            $this->doError('-1', 'Insertion impossible');
        }
        
    }

    public function doList($request) {
        $this->logger->log->info('Action List user');
        $this->logger->log->info(json_encode($request));
        try {
           $utilisateurManager=new UtilisateurManager();
            if(isset($request['iDisplayStart']) && isset($request['iDisplayLength'])){
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('nomUtilisateur','login', 'usine_id','profil_id');
                if ( isset( $request['iSortCol_0'] ) ){
                        $sOrder = "ORDER BY  "; 
                        for ( $i=0 ; $i<intval( $request['iSortingCols'] ) ; $i++ ){
                                if ( $request[ 'bSortable_'.intval($request['iSortCol_'.$i]) ] == "true" ){
                                        $sOrder .= "`".$aColumns[ intval( $request['iSortCol_'.$i] ) ]."` ".
                                                ($request['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                                }
                        }

                        $sOrder = substr_replace( $sOrder, "", -2 );
                        if ( $sOrder == "ORDER BY" )
                        {
                                 $sOrder .= " createdDate desc ";
                        }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
                if ( isset($request['sSearch']) && $request['sSearch'] != "" )
                {
                    $sSearchs = explode(" ", $request['sSearch']);
                    for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= " AND (";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(`" . $aColumns[$i] . "` LIKE '%" . ($sSearchs[$j]) . "%') OR";
                            if($i == count($aColumns)-1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $users=$utilisateurManager->listUtilisateurs($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if($users!=null){
                    $nbUsers=$utilisateurManager->count($sWhere);
                    $this->logger->log->info($nbUsers. 'users retrieved');
                    $this->doSuccessO($this->dataTableFormat($users, $request['sEcho'], $nbUsers));
                }
                else{
                    $this->doSuccessO($this->dataTableFormat(array(), $request['sEcho'], 0));
                }
            }else{
                $this->logger->log->error('List : Params not enough');
                throw new ConstraintException($this->parameters['LIST_USER_IMP']);
            } 
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doRemove($request) {
        $this->logger->log->info('Action Remove user');
        $this->logger->log->info(json_encode($request));
        try{
            if(isset($request['userIds'])){
                $this->logger->log->info('Remove with params : '.$request['userIds']);
                $userIds=$request['userIds'];
                $userManager=new UtilisateurManager();
                $nbModified= $userManager->remove($userIds);
                $this->doSuccess($nbModified, 'Utilisateur supprime');
            }else{
                $this->logger->log->error('Remove : Params not enough');
                $this->doError('-1', 'Impossible de supprimer cet utilisateur');
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doUpdate($request) {
        $logger = new Logger(__CLASS__);
        try {
            if (isset($request['nouveaupassword']) && isset($request['iduser'])) {
                 $this->userManager = new UtilisateurManager();
                 $user = $this->userManager->view($request['iduser']);
                if ($request['ancienpassword'] == ($user['password'])) {
                    $this->user = $this->userManager->findById($request['iduser']);
                    $this->user->setPassword($request['nouveaupassword']);
                    $this->user->setUpdatedDate(new \DateTime("now"));
                    $user=$this->userManager->update($this->user);
                    $logger->log->trace(json_encode($this->user));
                    $this->doSuccess($this->user, $this->parameters['PASSWORD_CHANGED']);  
                } else {
                    $logger->log->error('Insert : Ancien mot de passe not correct');
                    throw new ConstraintException($this->parameters['OLD_PASSWORD_NOT_CORRECT']);
                }
            } else if (isset($request['NameContact']) && isset($request['iduser'])) {
                $this->userManager = new UtilisateurManager();
                $this->user = $this->userManager->findById($request['iduser']);
                $this->user->setContactName(($request['NameContact']));
                $this->user->setUpdatedDate(new \DateTime("now"));
                $user = $this->userManager->update($this->user);
                $logger->log->trace(json_encode($user));
                $this->doSuccess($user, $this->parameters['UPDATED']);
            }else if (isset($request['fowardingurl']) && isset($request['iduser'])) {
                $this->userManager = new UtilisateurManager();
                $this->user = $this->userManager->findById($request['iduser']);
                $this->user->setFowarding_url(($request['fowardingurl']));
                $this->user->setUpdatedDate(new \DateTime("now"));
                $user = $this->userManager->update($this->user);
                $logger->log->trace(json_encode($user));
                $this->doSuccess($user, $this->parameters['UPDATED']);
            } else if (isset($request['PhoneContact']) && isset($request['iduser'])) {
                $this->userManager = new UtilisateurManager();
                $this->user = $this->userManager->findById($request['iduser']);
                $this->user->setContactPhone(($request['PhoneContact']));
                $this->user->setUpdatedDate(new \DateTime("now"));
                $user = $this->userManager->update($this->user);
                $logger->log->trace(json_encode($user));
                $this->doSuccess($user, $this->parameters['UPDATED']);
            } else if (isset($request['address']) && isset($request['iduser'])) {
                $this->userManager = new UtilisateurManager();
                $user = $this->userManager->findById($request['iduser']);
                $logger->log->trace("old user ".$user->getAddress());
                $user->setAddress($request['address']);
                $logger->log->trace("new user ".$user->getAddress());
                $user->setUpdatedDate(new \DateTime("now"));
                $this->userManager->update($user);
                $this->doSuccess($user->getId(), $this->parameters['UPDATED']);
            } 
            else if (isset($request['languageId']) && isset($request['iduser'])) {
                $this->userManager = new UtilisateurManager();
                $this->langageManager = new Common\LanguageManager();
                $this->user = $this->userManager->findById($request['iduser']);
                $this->user->setLanguage($this->langageManager->findById($request['languageId']));
                $this->user->setUpdatedDate(new \DateTime("now"));
                $user = $this->userManager->update($this->user);
                $logger->log->trace(json_encode($user));
                $this->doSuccess($user, $this->parameters['UPDATED']);
            }else if(isset($request['contactName']) && isset($request['description']) && isset($request['userId'])&& isset($request['email']) && isset($request['password'])){
                $this->userManager = new UtilisateurManager();
                $this->user = $this->userManager->findById($request['userId']);
                $this->user->setContactName($request['contactName']);
                $this->user->setDescription($request['description']);
                $this->user->setContactEmail($request['email']);
                $this->user->setPassword (md5($request['password']));
               
//                $profilManager=new ProfilManager();
//                $objectProfil=  $profilManager->findById($request['profil']);
//                $this->user->setProfil($objectProfil);
                $this->user->setUpdatedDate(new \DateTime("now"));
                $user = $this->userManager->update($this->user);
                $logger->log->trace(json_encode($user));
                $this->doSuccess($user, $this->parameters['UPDATED']);
            }
            else {
                $logger->log->error('Update : Invalid Data');       
                throw new ConstraintException($this->parameters['INVALID_DATA']);
            }
        } catch (ConstraintException $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doView($request) {
        $logger = new Logger(__CLASS__);
        try {
            if (isset($request['userId'])) {
                $userManager = new UtilisateurManager();
                $infosUser = $userManager->view($request['userId']);
                if ($infosUser != NULL) {
                    $this->doSuccessO(($infosUser));
                } else
                    echo json_encode(array());
            }
            else {
                $logger->log->error('List : Invalid Data');
                throw new ConstraintException($this->parameters['INVALID_DATA']);
            }
        } catch (ConstraintException $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function doSignin($request){
        $this->userManager =  new UtilisateurManager();
        try {
            if(isset($request['ACTION']) && isset($request['login']) && isset($request['password']) && isset($request['usineId']) ){
            try{
                $rslt=  $this->userManager->signin($request['login'], $request['password'], $request['usineId']);
                if($rslt['rc']!=0){
                //le client existe
                // retourner json
                    echo json_encode($rslt);
                }else{
                    echo json_encode($rslt);
                }
            } catch (Exception $e) {
                $this->doError('-1', $e->getMessage());
            } catch (Exception $e) {
                $this->doError('-1', 'ERREUR_SERVEUR');
            }
        }else{
            throw new Exception('INVALID DATA');
        }
        } catch (Exception $e) {
                $this->doError('-1', $e->getMessage());
            } catch (Exception $e) {
                $this->doError('-1', 'ERREUR_SERVEUR');
            }
        
    }
    
    public function doSignout($request){
        $logger = new Logger(__CLASS__);
        $logger->log->trace('Signout');
        if(isset($request['ACTION']) && $request['ACTION']=='SIGNOUT'){
            $logger->log->trace('Fin Signout');
        }else{
            echo '0';
        }
    }
    public function doActiver($request){
        $this->logger->log->info('Action activate user');
        try{
            if(isset($request['userIds'])){
                $this->logger->log->info('Remove with params : '.$request['userIds']);
                $userIds=$request['userIds'];
                $userManager=new UtilisateurManager();
                $nbModified= $userManager->activate($userIds);
                $this->doSuccess($nbModified, 'Utilisateur active');
            }else{
                $this->logger->log->error('Remove : Params not enough');
                $this->doError('-1', 'Utilisateur non active');
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('ERREUR_SERVEUR');
        }
    }
    public function doDesactiver($request){
        $this->logger->log->info('Action deactivate user');
        $this->logger->log->info(json_encode($request));
        try{
            if(isset($request['userIds'])){
                $this->logger->log->info('Remove with params : '.$request['userIds']);
                $userIds=$request['userIds'];
                $userManager=new UtilisateurManager();
                $nbModified= $userManager->deactivate($userIds);
                $this->doSuccess($nbModified, 'Utilisateur desactive');
                }else{
                $this->logger->log->error('Remove : Params not enough');
                $this->doError('-1', 'Utilisateur desactive');
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('ERREUR_SERVEUR');
        }
    }
    public function doListProfil($request){
        $userManager=new UtilisateurManager();
        $listProfils= $userManager->findAllProfils();

        echo json_encode($listProfils);
    }
    
    
    public function doGetPassword($request){
        //verifier si le login existe.
        $this->logger->log->info('Action get password of user');
        $this->logger->log->info(json_encode($request));
        if(isset($request['ACTION']) && $request['ACTION']=='GET_PASSWORD'){
            if(isset($request['u']) && isset($request['p']) && isset($request['t']) && isset($request['q'])){
            $username=$request['u'];
            $partner=$request['p'];
            $token=$request['t'];
            $time=$request['q'];
            $password=$request['password'];
            //si oui 
            $userManager=new Utilisateur\UtilisateurManager();
            // persist infos
            $passwordRecovery=$userManager->getPasswordRecovery($username, $partner, $token, $time, $password);
            $this->doSuccessO($passwordRecovery);
            }
        }
    }
    
    public function doSetPasswordRecovery($request){
        //verifier si le login existe.
        $this->logger->log->info('Action get password of user');
        $this->logger->log->info(json_encode($request));
        $userManager=new Utilisateur\UtilisateurManager();
        if(isset($request['ACTION']) && $request['ACTION']=='SET_PASSWORD'){
            if(isset($request['username']) && isset($request['partner'])){
                $username=$request['username'];
                $partner=$request['partner'];
                // si l'utilisateur existe
                $user= $userManager->ifExist($username, $partner);
                if($user!=null){
                    //generer un token constitue du login, du partner  et du timestamp
                    $token= Common\Common::gen_uuid();
                    $expirationDate=time();
                    
                    // persist infos
                    //Envoyer par mail a l'utilisateur
                    $mail = new PHPMailer();

                    $mail->IsSMTP(); // enable SMTP
                    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                    $mail->SMTPAuth = true;  // authentication enabled
                    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465; 
                    $mail->Username = 'kiwi.senegal@gmail.com';  
                    $mail->Password = 'kiwisenegal'; 
                    $mail->From     = "kiwi.senegal@gmail.com";
                    $mail->FromName = "2smobile";
                    $mail->AddAddress($user['email']);
                    $mail->IsHTML(true);
                    // $mail->AddAddress("pouyelayese88@gmail.com");

                    $mail->Subject  = "Demande d'un nouveau mot de passe";
                    $mail->Body     = "<html><body>Cher <b>".$username."</b>, \n\n

                                        Nous avons reçu une demande pour définir un nouveau mot de passe.\n\n

                                        Cliquez sur le lien ci-dessous pour définir un nouveau mot de passe chez 2smobile

                                        <a href='".App::getHome()."/passwordrecovery.php?u=$username&p=$partner&t=$token&q=$expirationDate'>Définition d'un nouveau mot de passe </a>. \n\n

                                        Bonne journée, \n
                                        2smobile</body></html>";
                    $mail->WordWrap = 50;

                    if(!$mail->Send()) {
                      echo 'Email non envoyé !';
                      //echo 'Mailer error: ' . $mail->ErrorInfo;
                    } else {
                      $userManager->setPasswordRecovery($username, $partner, $token, $expirationDate);
                      echo 'Email envoyé !';
                    }
                }else{
                    echo "Cet utilisateur n'existe pas !";
                }
            }
        }
        
        
        // si non  return json avec val 0
        
    }
    public function doActiveBirthday($request){
        $this->logger->log->info('Action Active Birthday user');
        $this->logger->log->info(json_encode($request));
        try{
            if(isset($request['userId'])){
                $this->logger->log->info('Remove with params : '.$request['userId']);
                $userId=$request['userId'];
                $userManager=new UtilisateurManager();
                $nbModified= $userManager->activateBirthday($userId);
                $this->doSuccess($nbModified, $this->parameters['ACTIVATED']);
            }else{
                $this->logger->log->error('Remove : Params not enough');
                $this->doError('-1', $this->parameters['USER_NOT_ACTIVATED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    public function doDesactiveBirthday($request){
        $this->logger->log->info('Action Desactive Birthday user');
        $this->logger->log->info(json_encode($request));
        try{
            if(isset($request['userId'])){
                $this->logger->log->info('Remove with params : '.$request['userId']);
                $userId=$request['userId'];
                $userManager=new UtilisateurManager();
                $nbModified= $userManager->desactivateBirthday($userId);
                $this->doSuccess($nbModified, $this->parameters['ACTIVATED']);
            }else{
                $this->logger->log->error('Remove : Params not enough');
                $this->doError('-1', $this->parameters['USER_NOT_ACTIVATED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    public function doGetStatusBirthday($request){
        $this->logger->log->info('Action Get Status Birthday user');
        $this->logger->log->info(json_encode($request));
        try{
            if(isset($request['userId'])){
                $this->logger->log->info('Remove with params : '.$request['userId']);
                $userId=$request['userId'];
                $userManager=new UtilisateurManager();
                $birthdayStatus= $userManager->getStatusBirthday($userId);
                $this->doSuccessO($birthdayStatus);
                
            }else{
                $this->logger->log->error('Remove : Params not enough');
                $this->doError('-1', $this->parameters['USER_NOT_ACTIVATED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    
     public function doInsertBirthdayParametre($request) {
        $logger=new Logger(__CLASS__);
        try{
            $logger->log->trace("Debut insertion Birthday");
                $signature= $request['signature'];
                $subject= $request['subject'];
                $content= $request['content'];
                $notSendBefore= new DateTime($request['notSendBefore']);
                $notSendAfter= new DateTime($request['notSendAfter']);
                $userId= $request['userId'];
                $groups= $request['msgGroupe'];
                //$groupNames= $request['groupNames'];
                $UpdatedDate= date_format((new \DateTime("now")), 'Y-m-d H:i:s');
                $CreatedDate= date_format((new \DateTime("now")), 'Y-m-d H:i:s');
                $DeletedDate="";
                
                if($userId==$request['Iduser']){
                        $UtilisateurManager= new UtilisateurManager();
                        $birthday= new BirthdayParameter();
                        
                        if($groups !=null){
                        if($groups == "*") {
                        $birthday= new BirthdayParameter();
                        $groupNames = "Tout le monde";
                        //$birthday->setGroups("*");
                         }
                             else {
                        $birthday= new BirthdayParameter();
                        $groupNames = $request['groupNames']; //$groupManager->retrieveAllGroupName($groups);
                            }
                        $birthday->setGroupNames($groupNames);
                         }
                        //$UtilisateurManager->updateBday($birthday);
                        $birthday= $UtilisateurManager->updateBdayParam($userId, $signature, $content, $request['notSendBefore'], $request['notSendAfter'], $UpdatedDate, $groups, $groupNames );
                        $this->doSuccess($birthday, $this->parameters['UPDATED']);
                    
                   }  
                   else {
                       $UtilisateurManager= new UtilisateurManager();
                        $birthday= new BirthdayParameter();
                        
                        if($groups !=null){
                        if($groups == "*") {
                        $birthday= new BirthdayParameter();
                        $groupNames = "Tout le monde";
                        //$birthday->setGroups("*");
                         }
                             else {
                        $birthday= new BirthdayParameter();
                        $groupNames = $request['groupNames']; //$groupManager->retrieveAllGroupName($groups);
                            }
                        $birthday->setGroupNames($groupNames);
                         }
                        //$UtilisateurManager->updateBday($birthday);
                        $birthday= $UtilisateurManager->createBdayParam($userId, $signature, $content, $request['notSendBefore'], $request['notSendAfter'], $CreatedDate, $UpdatedDate, $DeletedDate, $groups, $groupNames );
                        $this->doSuccess($birthday, $this->parameters['UPDATED']);
                        
                       /*
                        if($groups !=null){
                        if($groups == "*") {
                        $UtilisateurManager= new UtilisateurManager();
                        $user= $UtilisateurManager->findById($userId);
                        $birthday= new BirthdayParameter();
                        $birthday->setSubject($subject);
                        $birthday->setSignature($signature);
                        $birthday->setContent($content);
                        $birthday->setNotSendBefore($notSendBefore);
                        $birthday->setNotSendAfter($notSendAfter);
                        $birthday->setUser($user);
                        $birthday->setCreatedDate (new DateTime());
                        $birthday->setUpdatedDate (new DateTime());    
                        $birthday= new BirthdayParameter();
                        $groupNames = "Tout le monde";
                        $birthday->setGroups("*");
                         }
                             else {
                         $UtilisateurManager= new UtilisateurManager();
                        $user= $UtilisateurManager->findById($userId);
                        $birthday= new BirthdayParameter();
                        $birthday->setSubject($subject);
                        $birthday->setSignature($signature);
                        $birthday->setContent($content);
                        $birthday->setNotSendBefore($notSendBefore);
                        $birthday->setNotSendAfter($notSendAfter);
                        $birthday->setUser($user);
                        $birthday->setCreatedDate (new DateTime());
                        $birthday->setUpdatedDate (new DateTime());        
                        $birthday= new BirthdayParameter();
                        $birthday->setGroups($groups);
                        $groupManager = new GroupManager();
                        $groupNames = $groupManager->retrieveAllGroupName($groups);
                            }
                        $birthday->setGroupNames($groupNames);
                         }
                       
                        $UtilisateurManager->createBdayParam($birthday);
                        if($birthday->getId()!=null){
                        $this->doSuccess($birthday->getId(),$this->parameters['SAV']);
                    }else{
                     $this->logger->log->error('User already exists or in trash');
                     throw new ConstraintException($this->parameters['USER_ALREADY_EXISTS']);
                    }  
                   */}
              
            $logger->log->trace("Fin insertion birthday");
        } catch (ConstraintException $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $e->getMessage());
        } catch (Exception $e) {
            $logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            $this->doError('-1', $this->parameters['ERREUR_SERVEUR']);
        }
        
    }
    
     public function doActiveCampaignTest($request) {
        try {
            if (isset($request['userId']) && isset($request['checkedA'])) {
                 $this->userManager = new UtilisateurManager();
                 $this->user = $this->userManager->activeCampaignTest($request['userId']);
                 $this->doSuccess($this->user,$this->parameters['GEN_SAVED']);
            }else{
                $this->logger->log->error('Active campaign message test  : Params not enough');
                $this->doError('-1', $this->parameters['GEN_NOT_SAVED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }
    
    public function dodeActiveCampaignTest($request) {
        try {
            if (isset($request['userId']) && isset($request['checkedA'])) {
                 $this->userManager = new UtilisateurManager();
                 $this->user = $this->userManager->deactiveCampaignTest($request['userId']);
                 $this->doSuccess($this->user,$this->parameters['GEN_SAVED']);
            }else{
                $this->logger->log->error('Active campaign message test : Params not enough');
                $this->doError('-1', $this->parameters['GEN_NOT_SAVED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

}


    $oUtilisateurController = new UtilisateurController($_REQUEST);