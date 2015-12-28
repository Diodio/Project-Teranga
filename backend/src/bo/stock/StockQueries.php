<?php

namespace Stock;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class StockQueries {
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
        $this->classString = 'Stock\Stock';
    }
public function insert($stock) {
    if ($stock != null) {
            Bootstrap::$entityManager->persist($stock);
        Bootstrap::$entityManager->flush();
        return $stock;
    }
}
    
public function retrieveAll($offset, $rowCount, $orderBy = "", $sWhere = "") {
        
            $sql = 'SELECT produit.id, libelle, seuil, codeUsine, SUM(stock) AS stock
                    FROM produit,stock_reel WHERE produit.id=produit_id  ' . $sWhere . ' group by produit.id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
      
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayStocks = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayStocks [$i] [] = $value ['libelle'];
            $arrayStocks [$i] [] = $value ['stock'];
            $arrayStocks [$i] [] = $value ['seuil'];
            $i++;
        }
        return $arrayStocks;
    }
    

    public function retrieveAllByUsine($codeUsine, $login, $offset, $rowCount, $orderBy = "", $sWhere = "") {
             $sql = 'SELECT produit.id, libelle, seuil, codeUsine, SUM(stock) AS stock
                    FROM produit,stock_reel WHERE produit.id=produit_id AND codeUsine="'.$codeUsine.'" '.$sWhere.' group by produit.id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
     
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayStocks = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayStocks [$i] [] = $value ['libelle'];
            $arrayStocks [$i] [] = $value ['stock'];
            $arrayStocks [$i] [] = $value ['seuil'];
            $i++;
        }
        return $arrayStocks;
    }
    
    public function countAll($where="") {
        $sql = 'select count(produit.id) as nbStocks
                    from produit,stock_reel where produit.id=produit_id ' . $where . '';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeStocks = $stmt->fetch();
        return $nbTypeStocks['nbStocks'];
    }

    public function countByUsine($codeUsine, $login, $where="") {

        $sql = 'select count(produit.id) as nbStocks
                    from produit,stock_reel where produit.id=produit_id AND codeUsine="'.$codeUsine.'" ' . $where . '';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeStocks = $stmt->fetch();
        return $nbTypeStocks['nbStocks'];
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function findTypeStockById($typeproduitId) {
            if ($typeproduitId != null) {
                return Bootstrap::$entityManager->find( 'Stock\TypeStock', $typeproduitId );
            }
        }
    public function findAllStocks($term) {
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
   
    
     public function findStocksByName($name) {
        $sql = 'SELECT id, stock, seuil FROM produit where libelle = "'.$name.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $produit = $stmt->fetchAll();
        if ($produit != null)
            return $produit[0];
        else
            return null;
    }
    
    public function findStockProvisoireByProduitId($produitId, $codeUsine) {
        $sql = 'SELECT id FROM stock_provisoire where produit_id = "'.$produitId.'" and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $produit = $stmt->fetchAll();
        if ($produit != null)
            return $produit[0];
        else
            return null;
    }
    
    public function findStockReelByProduitId($produitId, $codeUsine) {
        $sql = 'SELECT id FROM stock_reel where produit_id = "'.$produitId.'" and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $produit = $stmt->fetchAll();
        if ($produit != null)
            return $produit[0];
        else
            return null;
    }
    
    public function findStats($codeUsine) {
        if($codeUsine !='*')
            $sql = "SELECT u.nomUsine, u.couleur, SUM(stock) AS nbStocks  FROM stock_reel s, usine u WHERE s.codeUsine=u.code AND s.codeUsine='".$codeUsine."' GROUP BY nomUsine ORDER BY nomUsine DESC";
        else
           $sql = "SELECT u.nomUsine, u.couleur, SUM(stock) AS nbStocks  FROM stock_reel s, usine u WHERE s.codeUsine=u.code GROUP BY nomUsine ORDER BY nomUsine DESC";

        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        $arrayStock = array();
        $i = 0;
        foreach ($stock as $key => $value) {
            $arrayStock [$i]['nomUsine'] = $value ['nomUsine'];
            $arrayStock [$i]['couleur'] = $value ['couleur'];
            $arrayStock [$i]['nbStocks'] = $value ['nbStocks'];
            $i++;
        }
        return $arrayStock;
    }
    
    
    
    public function recupereNombreStockParProduit($produitId, $codeUsine ) {
        $sql = "SELECT stock  FROM stock_reel WHERE produit_id=$produitId and codeUsine='".$codeUsine."'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
         return null;
        
    }

    public function updateNbStock($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_provisoire SET stock = stock + $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    
    public function updateNbStockReel($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET stock = stock + $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");

    }
    public function updateSeuilStock($produitId, $codeUsine, $nbSeuil ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET seuil = $nbSeuil WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    public function resetStockProvisoire($produitId, $codeUsine ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_provisoire SET stock = 0 WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    
        
      public function destockage($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_provisoire SET stock = stock - $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
	}
        
        public function destockageReel($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET stock = stock - $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
	}
}
