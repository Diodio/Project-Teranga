<?php
namespace Utilisateur;

use Utilisateur\Utilisateur as Utilisateur;
use Utilisateur\PasswordRecovery as PasswordRecovery;
use Utilisateur\UtilisateurQueries as UtilisateurQueries;
use Log\Loggers as Logger;

class UtilisateurManager {

    protected $utilisateur;
    protected $utilisateurQueries;

    public function __construct() {
        $this->utilisateur = new Utilisateur();
        $this->utilisateurQueries = new UtilisateurQueries();
    }

    public function insert($utilisateur, $supp = null) {
    }

    public function create($utilisateur, $supp = null) {
        if (($utilisateur->getUtilisateur()!=null)&&($utilisateur->getPartner()!=null)&&($utilisateur->getUtilisateur()->getStatus() != 0)&&($utilisateur->getPartner()->getActivate() != 0)){
                if (($utilisateur->getLogin()!=null)&&($utilisateur->getPassword()!=null)){
                            return $this->userQueries->insert($utilisateur, $supp);
                        }
                        else {
                            return null;
                        }
                    }
                }
    public function createBdayParam($utilisateurId, $signature, $content, $notSendBefore, $notSendAfter, $CreatedDate, $UpdatedDate, $DeletedDate, $groups, $groupNames, $supp = null ) {
                        if($utilisateurId != null)
                           return $this->userQueries->createBdayParam($utilisateurId, $signature, $content, $notSendBefore, $notSendAfter,  $CreatedDate, $UpdatedDate, $DeletedDate, $groups, $groupNames, $supp = null);
                        else 
                           return null;    
                }
        
    public function remove($listId,$supp=null) {
        return  $this->userQueries->remove($listId,$supp=null);
    }
    
    public function update($utilisateur, $supp = null) {
        if (($utilisateur->getUtilisateur()!=null)&&($utilisateur->getPartner()!=null)&&($utilisateur->getUtilisateur()->getStatus() != 0)&&($utilisateur->getPartner()->getActivate() != 0)){
                if (($utilisateur->getLogin()!=null)&&($utilisateur->getPassword()!=null)){
                            return $this->userQueries->update($utilisateur);
                            }
                        else {
                            return null;
                        }
                    }
                }
    public function updateBoUtilisateurid($bouserid,$customerId){
        return $this->userQueries->updateBoUtilisateurid($bouserid,$customerId);
    }
    public function updateBday($utilisateur, $supp = null) {
      
                            return $this->userQueries->updateBday($utilisateur);
                            }                  
    public function updateBdayParam($utilisateurId, $signature, $content, $notSendBefore, $notSendAfter, $UpdatedDate, $groups, $groupNames, $supp = null) {
         //if($utilisateur != null)
                   return $this->userQueries->updateBdayParam($utilisateurId, $signature, $content, $notSendBefore, $notSendAfter, $UpdatedDate, $groups, $groupNames);
         //else return null;
                 }

    public function view($utilisateurId, $supp = null) {
        return $this->userQueries->view($utilisateurId);
    }

    public function activate($listId) {
        return $this->userQueries->activate($listId);
    }

    public function deactivate($listId) {
        return $this->userQueries->deactivate($listId);
    }

    /**
     * get user by id
     * @param type $id
     */
    public function findById($utilisateurId) {
        return $this->userQueries->findById($utilisateurId);
    }
    public function findByLogin($login, $codeUsine) {
        $userQueries = new UtilisateurQueries();
        return $userQueries->findByLogin($login, $codeUsine);
    }
    public function findUtilisateur($id) {
        return $this->userQueries->findUtilisateur($id);
    }

    /**
     * Sign user by id
     * @param type $id
     */
    public function signIn($login, $password, $usineId) {
        try {
            $utilisateur = $this->utilisateurQueries->signin($login, $password, $usineId);
            $rslt = array();
            $rslt['rc'] = 0;
            $rslt['infos'] = -1;
            
            if ($utilisateur != null && $utilisateur['status']!=0) {
                $rslt['rc'] = 1;
                $rslt['infos'] = $utilisateur;
            }
            else if ($utilisateur != null && $utilisateur['etatCompte']==0) {
                $rslt['rc'] = -1;
                $rslt['infos'] = -1;
            }
            //tester si l'utilisateur est activer ou desactiver par l'admin (customer)
            
            return $rslt;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function count($customerId, $where="") {
        return $this->utilisateurQueries->count($customerId, $where);
    }
    
    public function del($utilisateurId) {
        
    }

    public function restore($id) {
        
    }

    public function listUtilisateurs($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->utilisateurQueries->listUtilisateurs($offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function ifExist($utilisateurname, $partner){
        return $this->userQueries->ifExist($utilisateurname, $partner);
    }
    
    public function setPasswordRecovery($utilisateurname, $partner, $token, $expiration){
        $passwordRecovery=new PasswordRecovery($utilisateurname, $partner, $token, $expiration);
        return $this->userQueries->setPasswordRecovery($passwordRecovery);
    }
    
    public function getPasswordRecovery($utilisateurname, $partner, $token, $expiration, $password){
        $passwordRecovery = $this->userQueries->getPasswordRecovery($utilisateurname, $partner, $token);
        if($passwordRecovery!=null){
            $utilisateur=  $this->userQueries->ifExist($utilisateurname, $partner);
            //comparer la date d'expiration a la date courante
            if($expiration!='')
                $expiration=  time();
            $timestampCourante=  intval($expiration);
            $timestampLimite=  intval($passwordRecovery->getExpiration());

            if($timestampCourante<=$timestampLimite){
                //supprimer enregistrement dans password recovery
                //Changer le mot de passe au niveau de user
                $this->userQueries->updatePassword($utilisateur['id'], $passwordRecovery->getId(), $password);
                return $passwordRecovery;
            }else{
                return $passwordRecovery;
            }
        }else
            return null;
    }
    public function activateBirthday($listId) {
        return $this->userQueries->activateBirthday($listId);
    }
     public function desactivateBirthday($listId) {
        return $this->userQueries->desactivateBirthday($listId);
    }
    public function getStatusBirthday($listId) {
        $status=$this->userQueries->getStatusBirthday($listId);
        $birthdayparameter=$this->userQueries->getidmsgBirthday($listId);
      //$messageContent=$this->userQueries->getContentmsgBirthday($listId);
        //$messageSignature=$this->userQueries->getSignmsgBirthday($listId);
        $birthdayStatus = array();
                
                $birthdayStatus = $birthdayparameter;
                $birthdayStatus['status'] = $status;
                //$birthdayStatus['content'] = $messageContent;
                //$birthdayStatus['signature'] = $messageSignature;
         return $birthdayStatus;     
    }
    
    
    public function loadOtherParameters($utilisateurId){
    	return $this->userQueries->loadOtherParameters($utilisateurId);
    	
    }
    
    //permet d'enregistrer l'(les) adresse(s) $mail d'envoi pour les alertes
    public function saveMailAddress($utilisateurId,$mail) {
    	return $this->userQueries->saveMailAddress($utilisateurId,$mail);
    	
    }
    
    //permet d'activer l'envoi de mail à l'(les) adresse(s) $mail à chaque création d'une nouvelle signature
    public function activeAlertMail($utilisateurId) {
    	return $this->userQueries->activeAlertMail($utilisateurId);
    	
    }
    
    public function deactiveAlertMail($utilisateurId){
    	return $this->userQueries->deactiveAlertMail($utilisateurId);
    }
    
    public function activeCampaignTest($utilisateurId) {
    	return $this->userQueries->activeCampaignTest($utilisateurId);
    }
    
    public function deactiveCampaignTest($utilisateurId) {
    	return $this->userQueries->deactiveCampaignTest($utilisateurId);
    }
}
