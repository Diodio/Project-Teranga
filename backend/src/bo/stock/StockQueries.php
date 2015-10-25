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
    
public function retrieveAll($produitId, $offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($produitId == '*') {
             $sql = 'select distinct(produit.id), libelle, stock, seuil
                    from produit,stock where produit.id=produit_id '.$sWhere.' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'select distinct(produit.id), libelle, stock, seuil
                    from produit,stock where produit.id=produit_id and produit_id = "'.$produitId . '" ' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }    
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
    

    public function retrieveAllByUsine($codeUsine, $login, $produitId, $offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($produitId == '*') {
             $sql = 'select distinct(produit.id), libelle, stock, seuil
                    from produit,stock where produit.id=produit_id AND codeUsine="'.$codeUsine.'" '.$sWhere.' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'select distinct(produit.id), libelle, stock, seuil
                    from produit,stock where produit.id=produit_id AND produit_id = "'.$produitId . '" and codeUsine="'.$codeUsine.'" ' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }    
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
    
    public function countAll($produitId, $where="") {
        
        if($produitId == '*') {
                $sql = 'select count(produit.id) as nbStocks
                    from produit,stock where produit.id=produit_id  ' . $where.'';
        }
        else {
            $sql = 'select count(produit.id) as nbStocks
                    from produit,stock where produit.id=produit_id and produit_id  = '.$produitId . ' ' . $where . '';
        }
            
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeStocks = $stmt->fetch();
        return $nbTypeStocks['nbStocks'];
    }

    public function countByUsine($codeUsine, $login, $produitId, $where="") {
//        if($where !="")
//                    $where = " where" . $where;
        if($produitId == '*') {
                $sql = 'select count(id) as nbStocks
                    from produit where codeUsine="'.$codeUsine.'" ' . $where . '';
        }
        else {
            $sql = 'select count(id) as nbStocks
                    from produit where familleProduit_id  = '.$produitId . ' and codeUsine="'.$codeUsine.'" ' . $where . '';
        }
            
       
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
    
    public function findStats() {
        $sql = "SELECT u.nomUsine, u.couleur, SUM(stock) AS nbStocks  FROM stock s, usine u WHERE s.codeUsine=u.code GROUP BY nomUsine ORDER BY nomUsine DESC";
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
    
    public function findStatsFamille($produitId, $codeUsine ) {
        if($produitId == '*') {
            $sql = "SELECT libelle, SUM(stock) AS nbStocks  FROM produit p, stock s, usine u WHERE p.id=produit_id and p.codeUsine=u.code AND u.code = '".$codeUsine."' GROUP BY libelle";
        }else {
            $sql = "SELECT u.nomUsine, u.couleur, SUM(stock) AS nbStocks  FROM produit p,stock s, usine u WHERE p.id=produit_id and p.codeUsine=u.code AND familleProduit_id = $produitId AND u.code = '".$codeUsine."' GROUP BY nomUsine ORDER BY nomUsine DESC";
        }
        
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        $arrayStock = array();
        $i = 0;
        foreach ($stock as $key => $value) {
            $arrayStock [$i]['libelle'] = $value ['libelle'];
            $arrayStock [$i]['nbStocks'] = $value ['nbStocks'];
            $i++;
        }
        return $arrayStock;
    }
    
    public function recupereNombreStockParProduit($produitId, $codeUsine ) {
        $sql = "SELECT stock  FROM stock WHERE produit_id=$produitId and codeUsine='".$codeUsine."'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        $arrayStock = array();
        $i = 0;
        foreach ($stock as $key => $value) {
            $arrayStock ['nbStocks'] = $value ['stock'];
        }
        return $arrayStock;
    }

    public function updateNbStock($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock SET stock = stock + $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
	}
}
