<?php

namespace Usine;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class UsineQueries {
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
        $this->classString = 'Produit\FamilleProduit';
    }

   
    public function insert($familleproduit) {
        if ($familleproduit != null) {
            Bootstrap::$entityManager->persist($familleproduit);
            Bootstrap::$entityManager->flush();
            return $familleproduit;
        }
    }

    public function update($familleproduit) {
        if ($familleproduit != null) {
            Bootstrap::$entityManager->merge($familleproduit);
            Bootstrap::$entityManager->flush();
            return $familleproduit;
        }
    }

    
    public function delete($familleproduitId) {
        $familleproduit = $this->findById($familleproduitId);
        if ($familleproduit != null) {
            Bootstrap::$entityManager->remove($familleproduit);
            Bootstrap::$entityManager->flush();
            return $familleproduit;
        } else {
            return null;
        }
    }

   
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
 
  public function retrieveAll() {
        $query = Bootstrap::$entityManager->createQuery("select u.id as value, u.nomUsine as text from Usine\Usine u");
        $types = $query->getResult();
        if ($types != null)
            return $types;
        else
            return null;
    }
    
    public function retrieveAllByUsine($codeUsine) {
        $query = Bootstrap::$entityManager->createQuery("select u.code as value, u.nomUsine as text from Usine\Usine u where u.code!='$codeUsine'");
        $types = $query->getResult();
        if ($types != null)
            return $types;
        else
            return null;
    }
    public function view($familleId) {
        $query = Bootstrap::$entityManager->createQuery("select f.id as familleId, f.libelle as familleName from Produit\FamilleProduit f where f.id = :familleId");
        $query->setParameter('familleId', $familleId);
        $famille = $query->getSingleResult();
        return $famille;
    }
    public function findById($usineId) {
            $query = Bootstrap::$entityManager->createQuery("select u from Usine\Usine u where u.id = :usineId");
            $query->setParameter('usineId', $usineId);
            $usine = $query->getResult();
            if ($usine != null)
                return $usine[0];
            else
                return null;
        }
    
    public function findByCodeUsine($codeUsine) {
            $query = Bootstrap::$entityManager->createQuery("select u.nomUsine from Usine\Usine u where u.code = :codeUsine");
            $query->setParameter('codeUsine', $codeUsine);
            $usine = $query->getResult();
            if ($usine != null)
                return $usine[0];
            else
                return null;
        }
    public function count($sWhere = "") {
       
    }

   
 
    public function getEntityManager() {
        return $this->entityManager;
    }

    public function findTypeProduitById($typeproduitId) {
            if ($typeproduitId != null) {
                return Bootstrap::$entityManager->find( 'Produit\TypeProduit', $typeproduitId );
            }
        }
    
}
