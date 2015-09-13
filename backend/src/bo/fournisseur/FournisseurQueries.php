<?php

namespace Fournisseur;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class FournisseurQueries {
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
                }
            
            
        }

   
    public function update($contact, $listContactAdd = null) {
         try{
                if ($client != null) {
                    Bootstrap::$entityManager->merge($client);
                    Bootstrap::$entityManager->flush();
                }
            
            } catch (\Exception $e) {
                Bootstrap::$entityManager->close();
                $b=new Bootstrap();
                Bootstrap::$entityManager = $b->getEntityManager();
                return null;
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
        
                $sql = 'select distinct(id),nom, prenom, adresse, telephone
                    from client c  ' . $sWhere . ' group by c.id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['id'];
            $arrayContact [$i] [] = $value ['prenom'];
            $arrayContact [$i] [] = $value ['nom'];
            $arrayContact [$i] [] = $value ['adresse'];
            $arrayContact [$i] [] = $value ['telephone'];
            $i ++;
        }
        return $arrayContact;
    }

 
 
    public function view($contactId, $supp = null) {
        $contactd = $this->findAllById($contactId);
        if ($contactd->getValidate() == true) {
            $sql = "SELECT distinct(c.id), c.firstName, c.lastName, c.cellular, c.email, co.code, co.indicative FROM Contact\Contact c, Common\Country co WHERE c.id=" . $contactId . " and c.status=1 and c.cellular like concat(co.indicative, '%') ";
        } else {
            $sql = "SELECT distinct(c.id), c.firstName, c.lastName, c.cellular, c.email FROM Contact\Contact c WHERE c.id=" . $contactId . " and c.status=1  ";
        }
        $query = Bootstrap::$entityManager->createQuery($sql);
        try {
            $contact = $query->getSingleResult();
            return $contact; 
        } catch (Exception $e) {  
            return null;
        }
    }

    
    public function count($sWhere = "") {
       
             $sql = 'select count(id) as nbClients,nom, prenom, adresse, telephone
                    from client c  ' . $sWhere . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbClients'];
    }

   

    public function getEntityManager() {
        return $this->entityManager;
    }

    
    
   
}
