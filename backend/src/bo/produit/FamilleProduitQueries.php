<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class FamilleProduitQueries {
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
        $query = Bootstrap::$entityManager->createQuery("select t.id as value, t.libelle as text from Produit\FamilleProduit t");
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
    public function findById($familleId) {
            $query = Bootstrap::$entityManager->createQuery("select f from Produit\FamilleProduit f where f.id = :familleId");
            $query->setParameter('familleId', $familleId);
            $famille = $query->getResult();
            if ($famille != null)
                return $famille[0];
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
