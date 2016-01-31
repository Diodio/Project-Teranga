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

    public function create($utilisateur) {
        if ($utilisateur != NULL) {
            if($utilisateur->getId()==null)
                Bootstrap::$entityManager->persist($utilisateur);
            else 
                Bootstrap::$entityManager->merge($utilisateur);
            Bootstrap::$entityManager->flush();
        }
        return null;
    } 
    
    

    public function remove($listId, $supp = null) {
          $query=("update utilisateur u set u.status=0, u.deleteDate=CURRENT_TIMESTAMP() WHERE u.id= $listId");
          $this->logger->log->trace($query); 
        try {
            $stmt=Bootstrap::$entityManager->getConnection()->prepare($query);
            $this->logger->log->trace($query);
            $stmt->execute();
            return  $stmt;
        } catch (\Exception $e) {
            $this->logger->log->error($e->getMessage());
            Bootstrap::$entityManager->getConnection()->rollback();
            Bootstrap::$entityManager->close();
            $b=new Bootstrap();
            Bootstrap::$entityManager = $b->getEntityManager();
            return null;
        }
    }
   
    public function activate($listId) {
        $query=  Bootstrap::$entityManager->createQuery('update Utilisateur\Utilisateur u set u.etatCompte=1 WHERE u.id in (' . $listId.') and u.etatCompte=0 and u.status=1' );
        return $query->getResult();
    }

    public function deactivate($listId) {
        $query=Bootstrap::$entityManager->createQuery('update Utilisateur\Utilisateur u set u.etatCompte=0 WHERE u.id in (' . $listId.') and u.etatCompte=1 and u.status=1' );
        return $query->getResult();
    }

    public function update($utilisateur, $supp = null) {
        if ($utilisateur != NULL) {
//            if (($utilisateur->getCustomer() != null) && ($utilisateur->getPartner() != null) && ($utilisateur->getCustomer()->getStatus() != 0) && ($utilisateur->getPartner()->getetatCompte() != 0)) {
                B::$entityManager->merge($utilisateur);
                B::$entityManager->flush();
                return $utilisateur;
//            }
//            return null;
        }
        return null;
    }
    public function view($utilisateurId, $supp = null) {
       $sql = 'SELECT id, nomUtilisateur, login, password, usine_id, profil_id FROM utilisateur WHERE id="'.$utilisateurId.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $user= $stmt->fetch();
        return $user;
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
   public function findAllProfils() {
        $sql = "select id value, description text from profil";
         $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $profils = $stmt->fetchAll();
        return $profils;
    }
    public function findByLogin($login, $codeUsine) {
        $sql = 'SELECT nomUtilisateur FROM utilisateur,usine WHERE usine.id=usine_id AND code="'.$codeUsine.'" and login="'.$login.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nomUtilisateur'];
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
    public function listUtilisateurs($offset, $rowCount, $orderBy = "", $sWhere = "") {
        $sql = 'SELECT u.id uid, nomUtilisateur, description,login, nomUsine, etatCompte, connected FROM utilisateur u,usine us, profil p WHERE u.usine_id=us.id AND u.profil_id=p.id AND status=1';
        $this->logger->log->trace($sql);
        try {
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $rslt = $stmt->fetchAll();
            $array = array();
            foreach ($rslt as $key => $value) {
                $utilisateur = array();
                $utilisateur[] = $value['uid'];
                $utilisateur[] = $value['etatCompte'];
                $utilisateur[] = $value['nomUtilisateur'];
                $utilisateur[] = $value['description'];
                $utilisateur[] = $value['login'];
                $utilisateur[] = $value['nomUsine'];
                $utilisateur[] = $value['connected'];
                $utilisateur[] = $value['uid'];
                $array[] = $utilisateur;
            }
            return $array;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage());
            throw $e;
        }
    }

    public function signin($login, $password, $usineId) {
        $dql = "SELECT u.id uid, u.login as login, u.nomUtilisateur  as nomUtilisateur, u.status status, u.etatCompte etatCompte, 
                p.libelle as profil, p.description as description, us.code codeUsine, us.nomUsine from Utilisateur\Utilisateur u JOIN u.profil p JOIN u.usine us
            where u.login='$login' and u.password='$password' and u.status=1 AND us.id='$usineId' ";
        try {
            $query = Bootstrap::$entityManager->createQuery($dql);
            return $query->getOneOrNullResult();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function setOnLine($userId) {
        $query=Bootstrap::$entityManager->createQuery('update Utilisateur\Utilisateur u set u.connected=1, u.connectedDate=CURRENT_TIMESTAMP() WHERE u.id in (' . $userId.') ' );
        return $query->getResult();
    }
    public function setOffLine($userId) {
        $query=Bootstrap::$entityManager->createQuery('update Utilisateur\Utilisateur u set u.connected=0, u.disconnectedDate=CURRENT_TIMESTAMP()  WHERE u.id in (' . $userId.') ' );
        return $query->getResult();
    }
    public function count($customerId, $where = "") {
        $sql = "SELECT count(*) as nbUsers FROM utilisateur u,usine us, profil p WHERE u.usine_id=us.id AND u.profil_id=p.id AND status=1" . $where;
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbContacts = $stmt->fetch();
        return $nbContacts['nbUsers'];
    }
    
    public function ifExist($utilisateurname, $partner){
        $dql = "SELECT u.id, u.login, 
            u.contactName, u.contactEmail as email, u.description from Utilisateur/Utilisateur u JOIN u.customer c JOIN u.partner p JOIN u.language l JOIN u.profil pr
            where u.login='$utilisateurname'  and u.partner=$partner and u.status=1 and u.etatCompte=1";
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
}

