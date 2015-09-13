<?php

namespace Article;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class TypeArticleQueries {
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
        $this->classString = 'Article\TypeArticle';
    }

   
    public function insert($produit) {
        if ($produit != null) {
            Bootstrap::$entityManager->persist($produit);
            Bootstrap::$entityManager->flush();
            return $produit;
        }
    }

    public function delete($produitId) {
       
    }

   
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }
    
    public function view($contactId, $supp = null) {
       
    }
   
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
                if($sWhere !="")
                    $sWhere = " where" . $sWhere;
                $sql = 'select distinct(id),libelle
                    from typearticle  ' . $sWhere . ' group by id ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        
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

   
    public function count($where="") {
        if($where !="")
                    $where = " where" . $where;
           $sql = 'select count(id) as nbTypeArticles
                    from typearticle  ' . $where . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeArticles = $stmt->fetch();
        return $nbTypeArticles['nbTypeArticles'];
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function findById($typeproduitId) {
            if ($typeproduitId != null) {
                return Bootstrap::$entityManager->find( 'Produit\TypeProduit', $typeproduitId );
            }
        }
   public function retrieveAllTypes() {
        $query = Bootstrap::$entityManager->createQuery("select t.id as value, t.libelle as text from Article\TypeArticle t");
        $typeArticles = $query->getResult();
        if ($typeArticles != null)
            return $typeArticles;
        else
            return null;
    }
   
}
