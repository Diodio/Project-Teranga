<?php

namespace Client;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ClientQueries {
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
        $this->classString = 'Client\Client';
    }

   
    public function insert($client) {
        if ($client != null) {
            Bootstrap::$entityManager->persist($client);
            Bootstrap::$entityManager->flush();
            return $client;
        }
    }

    public function delete($clientId) {
        $client = $this->findAllById($clientId);
        if ($client != null) {
            Bootstrap::$entityManager->remove($client);
            Bootstrap::$entityManager->flush();
            return $client;
        } else {
            return null;
        }
    }

    
    
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
    public function retrieveAll($offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " where " . $sWhere;
            $sql = 'select distinct(id), nom, adresse, telephone
                    from client' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayClients = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayClients [$i] [] = $value ['id'];
            $arrayClients [$i] [] = $value ['nom'];
            $arrayClients [$i] [] = $value ['adresse'];
            $arrayClients [$i] [] = $value ['telephone'];
            $arrayClients [$i] [] = $value ['id'];
            $i++;
        }
        return $arrayClients;
    }

 
  public function retrieveTypes() {
        $query = Bootstrap::$entityManager->createQuery("select t.id as value, t.libelle as text from Client\TypeClient t");
        $types = $query->getResult();
        if ($types != null)
            return $types;
        else
            return null;
    }
    public function view($clientId) {
        $query = B::$entityManager->createQuery('SELECT id, libelle,poidsNet, prixUnitaire, stock, seuil FROM Client\Client p WHERE p.id=' . $clientId . '');
        $client = $query->getResult();
        if (count($client) != 0) {
            return $client;
        } else {
            return null;
        }
    }

    
    public function count($sWhere = "") {
       if($sWhere !== "")
            $sWhere = " where " . $sWhere;
             $sql = 'select count(id) as nbClients
                    from client ' . $sWhere . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbClients'];
    }

   
    public function retrieveAllTypeClients($offset, $rowCount, $sOrder = "", $sWhere = "") {
                if($sWhere !="")
                    $sWhere = " where" . $sWhere;
                $sql = 'select distinct(id),libelle
                    from type_client c  ' . $sWhere . ' group by c.id ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['libelle'];
            $i ++;
        }
        return $arrayContact;
    }

   
    public function countAllTypeClients($where="") {
        if($where !="")
                    $where = " where" . $where;
           $sql = 'select count(id) as nbTypeClients
                    from type_client c  ' . $where . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeClients = $stmt->fetch();
        return $nbTypeClients['nbTypeClients'];
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function findTypeClientById($typeclientId) {
            if ($typeclientId != null) {
                return Bootstrap::$entityManager->find( 'Client\TypeClient', $typeclientId );
            }
        }
    public function findAllClients($term) {
        $sql = 'SELECT id, libelle VALUE  FROM client
    		  where ( libelle LIKE "%' . $term . '%")';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        if ($clients != null)
            return $clients;
        else
            return null;
    }
   
    
     public function findClientsByName($name) {
        $sql = 'SELECT id  FROM client where ( id = "'. $name .'")';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $client = $stmt->fetchAll();
        if ($client != null)
            return $client;
        else
            return null;
    }
}
