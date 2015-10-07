<?php


namespace Utilisateur;

/**
 * Description of UserQueries
 *
 * @author admin
 */
use Racine\Bootstrap as Bootstrap;
use Utilisateur\Utilisateur as Utilisateur;
use Log\Loggers as Logger;

class UtilisateurQueries {

    private $logger;
    private $classString;

    public function __construct() {
        $this->classString = 'Utlisateur\Utilisateur';
        $this->logger = new Logger(__CLASS__);
        date_default_timezone_set('GMT');
    }

    public function insert($utilisateur) {
        if ($utilisateur != NULL) {
            B::$entityManager->persist($utilisateur);
            B::$entityManager->flush();
        }
        return null;
    }
    
    

    public function remove($listId, $supp = null) {
          $query=("update user u set u.status=0, u.deletedDate=CURRENT_TIMESTAMP() WHERE u.id= $listId and u.profil_id<>1 and $listId not in (Select m.user_id from message m)");
          $this->logger->log->trace($query); 
        try {
            $stmt=B::$entityManager->getConnection()->prepare($query);
            $this->logger->log->trace($query);
            $stmt->execute();
            
            $trashManager = new \Trash\TrashManager ();
            $arrayContact = explode(',', $listId);
            foreach ($arrayContact as $value) {              
                $utilisateur = $this->findById($value);
                if (($utilisateur != null)) {
                    $trashManager->insert($utilisateur);
                }
            }
            //B::$entityManager->getConnection()->commit();
            return  $stmt;
        } catch (\Exception $e) {
            $this->logger->log->error($e->getMessage());
            B::$entityManager->getConnection()->rollback();
            B::$entityManager->close();
            $b=new B();
            B::$entityManager = $b->getEntityManager();
            return null;
        }
    }
   
    public function activate($listId) {
        $query=B::$entityManager->createQuery('update Utilisateur/Utilisateur u set u.activate=1 WHERE u.id in (' . $listId.') and u.activate=0 and u.status=1' );
        return $query->getResult();
    }

    public function deactivate($listId) {
        $query=B::$entityManager->createQuery('update Utilisateur/Utilisateur u set u.activate=0 WHERE u.id in (' . $listId.') and u.activate=1 and u.profil<>1 and u.status=1' );
        return $query->getResult();
    }

    public function update($utilisateur, $supp = null) {
        if ($utilisateur != NULL) {
//            if (($utilisateur->getCustomer() != null) && ($utilisateur->getPartner() != null) && ($utilisateur->getCustomer()->getStatus() != 0) && ($utilisateur->getPartner()->getActivate() != 0)) {
                B::$entityManager->merge($utilisateur);
                B::$entityManager->flush();
                return $utilisateur;
//            }
//            return null;
        }
        return null;
    }
    public function view($utilisateurId, $supp = null) {
        $query = B::$entityManager->createQuery("select c.id as userId, c.password as password from Utilisateur/Utilisateur c where c.id = ".$utilisateurId." AND c.status = 1");
        // $query->setParameter('userId', $utilisateurId);
        $utilisateur = $query->getOneOrNullResult();
        if ($utilisateur != null)
            return $utilisateur;
        else
            return null;
    }

    /**
     * get user by id
     * @param type $id
     */
    public function findById($id) {
        $dql = "select u from Utilisateur/Utilisateur u where u.id=" . $id . " and u.status=1";
        $query = B::$entityManager->createQuery($dql);
        return $query->getOneOrNullResult();
    }
    public function findByLogin($login) {
        $dql = "select u from Utilisateur/Utilisateur u where u.login='$login'" ;
        $query = B::$entityManager->createQuery($dql);
        return $query->getOneOrNullResult();
    }


    public function findUser($id) {
        $dql = "SELECT u.id as iduser, DATE_FORMAT(u.createdDate, '".\Common\Common::setFormatDate()."') as createdDate,u.fowarding_url, u.description, u.login, l.label as language,  u.contactName,c.companyName,  u.contactEmail as mail, p.id as profil, c.type, c.email from Utilisateur/Utilisateur u  JOIN u.customer c JOIN u.language l JOIN u.profil p where u.id=$id and u.status=1";
        try {
            $query = B::$entityManager->createQuery($dql);
            $rslt = $query->getOneOrNullResult();
            return $rslt;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage());
            throw $e;
        }
    }

    /**
     * get users list of customer 
     * @param type $customerId
     * @return type
     * @throws \Customer\Exception
     */
    public function listUsers($customerId, $offset, $rowCount, $orderBy = "", $sWhere = "") {
        $sql = 'SELECT u.id, contactName as name, contactEmail as email, u.description as description, login, u.activate as statut, p.intitule as type'
                . ' from user u JOIN profil p on u.profil_id=p.id where u.customer_id= ' . $customerId . ' and u.status=1 ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount;
        $this->logger->log->trace($sql);
        try {
            $stmt = B::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $rslt = $stmt->fetchAll();
            $array = array();
            foreach ($rslt as $key => $value) {
                $utilisateur = array();
                $utilisateur[] = $value['id'];
                $utilisateur[] = $value['name'];
                $utilisateur[] = $value['description'];
                $utilisateur[] = $value['login'];
                $utilisateur[] = $value['type'];
                $utilisateur[] = $value['statut'];
                $utilisateur[] = $value['id'];
                $array[] = $utilisateur;
            }
            return $array;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage());
            throw $e;
        }
    }

    public function signin($login, $password, $usine) {
        $dql = "SELECT u.id, u.login as login, u.nomUtilisateur  as nomUtilisateur, u.status status, u.etatCompte etatCompte, p.libelle as profil, us.code codeUsine from Utilisateur\Utilisateur u JOIN u.profil p JOIN u.usine us
            where u.login='$login' and u.password='$password' and u.status=1 AND us.id='$usine' ";
        try {
            $query = Bootstrap::$entityManager->createQuery($dql);
            return $query->getOneOrNullResult();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function count($customerId, $where = "") {
        $sql = "SELECT count(id) as nbUsers from user where  customer_id=" . $customerId . " AND status=1 " . $where;
        $stmt = B::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbContacts = $stmt->fetch();
        return $nbContacts['nbUsers'];
    }
    
    public function ifExist($utilisateurname, $partner){
        $dql = "SELECT u.id, u.login, 
            u.contactName, u.contactEmail as email, u.description from Utilisateur/Utilisateur u JOIN u.customer c JOIN u.partner p JOIN u.language l JOIN u.profil pr
            where u.login='$utilisateurname'  and u.partner=$partner and u.status=1 and u.activate=1";
        $query = B::$entityManager->createQuery($dql);
        return $query->getOneOrNullResult();
    }
    
    public function getPasswordRecovery($utilisateurname, $partner, $token){
        $dql = "SELECT p from Customer\PasswordRecovery p where p.username='$utilisateurname' and p.partner='$partner' and p.token='$token'";
        $query = B::$entityManager->createQuery($dql);
        return $query->getOneOrNullResult();
    }
    
    public function setPasswordRecovery($passwordRecovery){
        if($passwordRecovery!=NULL){
            B::$entityManager->persist($passwordRecovery);
            B::$entityManager->flush();
        }
    }
    
    public function removePasswordRecovery($id){
        $query=B::$entityManager->createQuery('delete from Customer\PasswordRecovery p WHERE p.id= '. $id );
        return $query->getResult();
    }
    public function updatePassword($id, $passwordRecoveryId, $password){
        B::$entityManager->getConnection()->beginTransaction();
        try {
            $dql="update Utilisateur/Utilisateur u set u.password='".$password."' WHERE u.id = ". $id ;
            $this->logger->log->trace($dql);
            $query=B::$entityManager->createQuery($dql);
            $this->removePasswordRecovery($passwordRecoveryId);
            $result=$query->getResult();
            B::$entityManager->getConnection()->commit();
            return $result;
        } catch (\Exception $e) {
            $this->logger->log->error($e->getMessage());
            B::$entityManager->getConnection()->rollback();
            B::$entityManager->close();
            $b=new B();
            B::$entityManager = $b->getEntityManager();
            return null;
        }
    }
    /**
     * Remove user
     * @param type $utilisateurId
     */
    public function del($utilisateurId) {
        
    }

    /**
     * Restore user from trash
     * @param type $id
     */
    public function restore($id) {
        
    }
     public function activateBirthday($listId) {
        $query=B::$entityManager->createQuery('update Utilisateur/Utilisateur u set u.activateBirthday=1 WHERE u.id=('.$listId.') and u.activateBirthday=0' );
        return $query->getResult();
    }
     public function desactivateBirthday($listId) {
        $query=B::$entityManager->createQuery('update Utilisateur/Utilisateur u set u.activateBirthday=0 WHERE u.id=('.$listId.') and u.activateBirthday=1' );
        return $query->getResult();
    }
     public function getStatusBirthday($listId) {
        $query='select u.activateBirthday as status from user u where u.id=('.$listId.') AND u.status = 1';
        $stmt = B::$entityManager->getConnection()->prepare($query);
        $stmt->execute();
        $StatusAnniv = $stmt->fetch();
        return $StatusAnniv['status'];
        }
     public function getidmsgBirthday($listId) {
        $query="Select user_id as iduser, content, signature, groups, DATE_FORMAT(notSendBefore, '%H:%i') as NotSendBefore , DATE_FORMAT(notSendAfter, '%H:%i') as NotSendAfter FROM birthdayparameter where user_id=$listId";
        $stmt = B::$entityManager->getConnection()->prepare($query);
        $stmt->execute();
        $birthdayparameter = $stmt->fetch();
        return $birthdayparameter;
        }
        
        
        public function loadOtherParameters($utilisateurId){
    	$this->logger->log->trace('return email address');
        $sql = 'SELECT u.alertMail, u.activeMailSending, u.activeSMSTest from user u WHERE u.id=' . $utilisateurId;
        try {
            $stmt = B::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $rslt= $stmt->fetchAll();
            $array = array();
            foreach ($rslt as $key => $value) {
                $utilisateurInfo= array();
                $utilisateurInfo['alertMail'] = $value['alertMail'];
                $utilisateurInfo['activeMailSending'] = $value['activeMailSending'];
                $utilisateurInfo['activeSMSTest'] = $value['activeSMSTest'];
                $array[] = $utilisateurInfo;
            }
           return $array[0];
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage());
            throw $e;
        }
   	
    }
    
    //permet d'enregistrer l'(les)adresse(s) e-mail d'envoi des rapports et d'activer parallèlement cet envoi
    public function saveMailAddress($utilisateurId,$mail) {
    	$this->logger->log->trace('Save mail address for sending reporting');
        $query = B::$entityManager->createQuery ("update Utilisateur/Utilisateur p set p.alertMail='" . $mail . "', p.activeMailSending=1 WHERE p.id=" . $utilisateurId );
	return $query->getResult ();
    }
    
    //permet d'activer l'envoi de mail à (aux) l'(les)adresse(s) $mail à la fin de chaque campagne
    public function activeAlertMail($utilisateurId) {
    	$this->logger->log->trace('Activate Alert mail');
        $query = B::$entityManager->createQuery ( "UPDATE Utilisateur/Utilisateur P set P.activeMailSending=1 WHERE P.id=" . $utilisateurId);
	return $query->getResult ();
    }
    
    public function deactiveAlertMail($utilisateurId){
    	$this->logger->log->trace('Deactivate Alert mail');
        $query = B::$entityManager->createQuery ( "UPDATE Utilisateur/Utilisateur P set P.activeMailSending=0 WHERE P.id=" . $utilisateurId);
	return $query->getResult ();
    }
    
    public function activeCampaignTest($utilisateurId) {
    	$this->logger->log->trace('Activate campagn message test');
        $query = B::$entityManager->createQuery ( "UPDATE Utilisateur/Utilisateur P set P.activeSMSTest=1 WHERE P.id=" . $utilisateurId);
	return $query->getResult ();
    }
    
    public function deactiveCampaignTest($utilisateurId){
    	$this->logger->log->trace('Deactivate campagn message test');
        $query = B::$entityManager->createQuery ( "UPDATE Utilisateur/Utilisateur P set P.activeSMSTest=0 WHERE P.id=" . $utilisateurId);
	return $query->getResult ();
    }
}

