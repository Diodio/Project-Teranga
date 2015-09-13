<?php

namespace Article;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ArticleQueries {
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
        $this->classString = 'Article\Article';
    }

   
    public function insert($article) {
        if ($article != null) {
            Bootstrap::$entityManager->persist($article);
            Bootstrap::$entityManager->flush();
            return $article;
        }
    }

    public function delete($articleId) {
        $article = $this->findAllById($articleId);
        if ($article != null) {
            Bootstrap::$entityManager->remove($article);
            Bootstrap::$entityManager->flush();
            return $article;
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
            $sql = 'select distinct(id), libelle, prixUnitaire
                    from article' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayContact [$i] [] = $value ['id'];
            $arrayContact [$i] [] = $value ['libelle'];
            $arrayContact [$i] [] = $value ['prixUnitaire'];
            $i++;
        }
        return $arrayContact;
    }

 
  public function retrieveTypes() {
        $query = Bootstrap::$entityManager->createQuery("select t.id as value, t.libelle as text from Produit\TypeProduit t");
        $types = $query->getResult();
        if ($types != null)
            return $types;
        else
            return null;
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
       if($sWhere !== "")
            $sWhere = " where " . $sWhere;
             $sql = 'select count(id) as nbProduits
                    from produit ' . $sWhere . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbProduits'];
    }

   
    public function retrieveAllTypeProduits($offset, $rowCount, $sOrder = "", $sWhere = "") {
                if($sWhere !="")
                    $sWhere = " where" . $sWhere;
                $sql = 'select distinct(id),libelle
                    from type_produit c  ' . $sWhere . ' group by c.id ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        
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

   
    public function countAllTypeProduits($where="") {
        if($where !="")
                    $where = " where" . $where;
           $sql = 'select count(id) as nbTypeProduits
                    from type_produit c  ' . $where . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeProduits = $stmt->fetch();
        return $nbTypeProduits['nbTypeProduits'];
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function findTypeProduitById($typeproduitId) {
            if ($typeproduitId != null) {
                return Bootstrap::$entityManager->find( 'Produit\TypeProduit', $typeproduitId );
            }
        }
    public function findAllProduits($term) {
        $sql = 'SELECT id, libelle VALUE  FROM produit
    		  where ( libelle LIKE "%' . $term . '%")';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $produits = $stmt->fetchAll();
        if ($produits != null)
            return $produits;
        else
            return null;
    }
   
}
