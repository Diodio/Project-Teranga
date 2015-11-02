<?php

namespace Achat;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class AchatQueries {
    /*
     *
     */

    private $entityManager;
    private $classString;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
        $this->classString = 'Achat\Achat';
    }

   
    public function insert($achat) {
        if ($achat != null) {
            Bootstrap::$entityManager->persist($achat);
            Bootstrap::$entityManager->flush();
            return $achat;
        }
    }

    
    
    
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
    public function retrieveAll($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($codeUsine !=='*') {
            if($sWhere !== "")
            $sWhere = " and " . $sWhere;
            $sql = 'select distinct(id), status,dateAchat, numero
                    from achat where codeUsine="'.$codeUsine.'" ' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
        if($sWhere !== "")
            $sWhere = " where " . $sWhere;
            $sql = 'select distinct(id), status,dateAchat, numero
                    from achat' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayAchats = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayAchats [$i] [] = $value ['id'];
            $arrayAchats [$i] [] = $value ['status'];
            $arrayAchats [$i] [] = $value ['dateAchat'];
            $arrayAchats [$i] [] = $value ['numero'];
            $i++;
        }
        return $arrayAchats;
    }

 
  

     public function findById($produitId) {
            $query = Bootstrap::$entityManager->createQuery("select p from Achat\Achat p where p.id = :produitId");
            $query->setParameter('familleId', $produitId);
            $produit = $query->getResult();
            if ($produit != null)
                return $produit[0];
            else
                return null;
        }
    public function count($codeUsine, $sWhere = "") {
        if($codeUsine !=='*') {
            if($sWhere !== "")
                $sWhere = " and " . $sWhere;
            $sql = 'select count(id) as nbAchats
                    from achat where codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
            if($sWhere !== "")
            $sWhere = " where " . $sWhere;
             $sql = 'select count(id) as nbAchats
                    from achat ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbAchats'];
    }
    
    public function getLastNumberAchat() {
        $sql = 'select max(id)+1 as lastAchats from achat';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastAchat = $stmt->fetch();
        return $lastAchat['lastAchats'];
    }
    
    public function validAchat($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Achat\Achat a set a.status=1 WHERE a.id = '$achatId'");
        return $query->getResult();
    }
    
    public function findValidAchatByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findNonValidAchatByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    public function findAchatAnnulerByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=2 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
}
