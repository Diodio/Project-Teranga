<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ProduitQueries {
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
        $this->classString = 'Produit\Produit';
    }

   
    public function insert($produit) {
        if ($produit != null) {
                Bootstrap::$entityManager->persist($produit);
            Bootstrap::$entityManager->flush();
            return $produit;
        }
    }
    
    public function update($produit) {
        if ($produit != null) {
            Bootstrap::$entityManager->merge($produit);
            Bootstrap::$entityManager->flush();
            return $produit;
        }
    }
    
    public function delete($produitId) {
        $produit = $this->findById($produitId);
        if ($produit != null) {
            Bootstrap::$entityManager->remove($produit);
            Bootstrap::$entityManager->flush();
            return $produit;
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
        $sql = 'select distinct(produit.id) as pid, libelle from produit';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

   public function retrieveAllProduitsDemoules($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
       if($sWhere !== "")
            $sWhere = " and " . $sWhere;
           if($codeUsine !== '*')  {
                $sql = 'SELECT DISTINCT produit.id id, libelle,stock, (SELECT SUM(nombreCarton) FROM carton WHERE produit.id=carton.produitId) as nbColis FROM produit, stock_reel, demoulage 
                    WHERE produit.id=stock_reel.produit_id
                    AND produit.id=demoulage.produit_id  and stock_reel.codeUsine="'.$codeUsine.'" group by produit.id' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.' ';
           }
           else {
               $sql = 'SELECT DISTINCT produit.id id, libelle, stock, (SELECT SUM(nombreCarton) FROM carton WHERE produit.id=carton.produitId) as nbColis FROM produit, stock_reel, demoulage
                         WHERE produit.id=stock_reel.produit_id
                        AND produit.id=demoulage.produit_id group by produit.id ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.'  ';
           }
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    
     public function retrieveAllDemoulages($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
       if($sWhere !== "")
            $sWhere = " and " . $sWhere;
           if($codeUsine !== '*')  {
                $sql = 'SELECT produit.id id, libelle, stock FROM produit, stock_provisoire WHERE produit.id=produit_id AND stock > 0 AND codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.' ';
           }
           else {
               $sql = 'SELECT produit.id id, libelle, stock FROM produit, stock_provisoire WHERE produit.id=produit_id AND stock > 0 ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.'  ';
           }
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    
    public function retrieveDetailProduit($produitId) {
        $sql = 'SELECT produit.id id, libelle, stock FROM produit, stock_provisoire WHERE produit.id=produit_id AND produit.id="'.$produitId.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    
     public function countAllDemoulages($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'select count(*) as nb from produit, stock_provisoire where produit.id=produit_id and stock !=0 AND codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'select count(*) as nb from produit, stock_provisoire where produit.id=produit_id and stock !=0 ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nb'];
    }
    
    public function countAllProduitsDemoulages($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'SELECT DISTINCT produit.id id, libelle, stock, (SELECT SUM(nombreCarton) FROM carton WHERE produit.id=carton.produitId) as nbColis FROM produit, stock_reel, demoulage 
                    WHERE produit.id=stock_reel.produit_id
                    AND produit.id=demoulage.produit_id  and stock_reel.codeUsine="'.$codeUsine.'" group by produit.id' . $sWhere . '';
        }
        else {
             $sql = 'SELECT DISTINCT produit.id id, libelle, stock, (SELECT SUM(nombreCarton) FROM carton WHERE produit.id=carton.produitId) as nbColis FROM produit, stock_reel, demoulage 
                    WHERE produit.id=stock_reel.produit_id
                    AND produit.id=demoulage.produit_id  group by produit.id' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return count($nbClients);
    }
    
    public function retrieveStockProvisoire($produitId){
        $sql = 'SELECT stock FROM stock_provisoire WHERE produit_id='.$produitId.'';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
        else return null;
    }

    public function retrieveStockReel($produitId){
        $sql = 'SELECT stock FROM stock_reel WHERE produit_id='.$produitId.'';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
        else return null;
    }
    public function retrieveStockProvisoireParUsine($produitId, $codeUsine){
        if($codeUsine !=='*') {
            $sql = 'SELECT stock FROM stock_provisoire WHERE produit_id='.$produitId.' and codeUsine="'. $codeUsine .'"';
        }
        else {
            $sql = 'SELECT stock FROM stock_provisoire WHERE produit_id='.$produitId.'';
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
        else return null;
    }
    public function retrieveStockReelParUsine($produitId, $codeUsine){
        if($codeUsine !=='*') {
            $sql = 'SELECT stock FROM stock_reel WHERE produit_id='.$produitId.' and codeUsine="'. $codeUsine .'"';
        }
        else {
            $sql = 'SELECT stock FROM stock_reel WHERE produit_id='.$produitId.'';
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
        else return null;
    }
  public function retrieveTypes() {
        $query = Bootstrap::$entityManager->createQuery("select t.id as value, t.libelle as text from Produit\TypeProduit t");
        $types = $query->getResult();
        if ($types != null)
            return $types;
        else
            return null;
    }
    public function view($produitId) {
        $query = Bootstrap::$entityManager->createQuery('SELECT p.id as id, p.libelle libelle, p.prixUnitaire prixUnitaire FROM Produit\Produit p WHERE p.id=' . $produitId );
        $produit = $query->getResult();
        if (count($produit) != 0) {
            return $produit;
        } else {
            return null;
        }
    }

     public function findById($produitId) {
            if ($produitId != null) {
                return Bootstrap::$entityManager->find( 'Produit\Produit', $produitId );
            }
        }
    public function count($produitId, $sWhere = "") {
        if($produitId !== '*')  {
             $sql = 'select count(produit.id) as nbProduits
                    from produit, stock where produit.id=produit_id AND produit.id='.$produitId.' ' . $sWhere . '';
        }
        else {
            $sql = 'select count(produit.id) as nbProduits
                    from produit, stock where produit.id=produit_id ' . $sWhere . '';
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbProduits'];
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
   
    
     
    
    public function retrieveAllByUsine() {
        $query = "select p.id as value, p.libelle as text from produit p  group by p.libelle";
        $stmt =  Bootstrap::$entityManager->getConnection()->prepare($query);
        $stmt->execute();
        $types = $stmt->fetchAll();
        if ($types != null)
            return $types;
        else
            return null;
    }
    
    public function findProduitsByName($name) {
        $sql = 'SELECT id FROM produit where libelle = "'. $name .'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $produit = $stmt->fetchAll();
        if ($produit != null)
            return $produit[0];
        else
            return null;
    }
    
    
    public function retrieveAllProduits($codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        $sql = 'SELECT DISTINCT id, libelle FROM produit ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount . ' ';
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    public function countAllProduits($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
            $sql = 'SELECT count(*) nb  FROM produit ' . $sWhere . '';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nb = $stmt->fetch();
        return $nb['nb'];
    }
    
}
