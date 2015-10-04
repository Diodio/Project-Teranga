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


    public function retrieveAll($produitId, $offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($produitId == '*') {
             $sql = 'select distinct(id), libelle, stock, seuil
                    from produit ' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'select distinct(id), libelle, stock, seuil
                    from produit where familleProduit_id = '.$produitId . '' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
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

    public function count($produitId, $where="") {
//        if($where !="")
//                    $where = " where" . $where;
        if($produitId == '*') {
                $sql = 'select count(id) as nbStocks
                    from produit  ' . $where . '';
        }
        else {
            $sql = 'select count(id) as nbStocks
                    from produit where familleProduit_id  = '.$produitId . ' ' . $where . '';
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
    
     public function findStats($nomUsine,$nomUser) {
                $sql = "SELECT u.nomUsine, u.couleur, SUM(stock) AS nbStocks  FROM produit p, usine u WHERE p.nomUsine=u.nomUsine GROUP BY nomUsine ORDER BY nomUsine DESC";  
		$stmt = Bootstrap::$entityManager->getConnection ()->prepare ( $sql );
		$stmt->execute ();
		$stock = $stmt->fetchAll ();
		$arrayStock = array ();
		$i = 0;
		foreach ( $stock as $key => $value ) {
                        $arrayStock [$i]['nomUsine'] = $value ['nomUsine'];
                        $arrayStock [$i]['couleur'] = $value ['couleur'];
			$arrayStock [$i]['nbStocks'] = $value ['nbStocks'];
                        $i++;
		}
		return $arrayStock;
	}
}
