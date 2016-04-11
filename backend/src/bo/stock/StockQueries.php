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
    
public function retrieveAll($codeUsine, $offset, $rowCount, $orderBy = "", $sWhere = "") {
    if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*'){
            $sql = 'SELECT produit.id, libelle, seuil, codeUsine, SUM(stock) AS stock
                    FROM produit,stock_reel WHERE produit.id=produit_id and stock!=0 ' . $sWhere . ' and codeUsine="'.$codeUsine.'" group by produit.id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else{
           $sql = 'SELECT produit.id, libelle, seuil, codeUsine, SUM(stock) AS stock
                    FROM produit,stock_reel WHERE produit.id=produit_id and stock!=0.00 ' . $sWhere . ' group by produit.id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.''; 
        }
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
    

    public function retrieveAllByUsine($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
             $sql = 'SELECT produit.id pid, libelle, seuil, codeUsine, SUM(stock) AS stock
                    FROM produit,stock_reel WHERE produit.id=produit_id AND codeUsine="'.$codeUsine.'" '.$sWhere.' and stock!=0.00 group by produit.id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
     
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayStocks = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayStocks [$i] [] = $value ['libelle'];
            $arrayStocks [$i] [] = $value ['stock'];
            $arrayStocks [$i] [] = $value ['pid'];
            $arrayStocks [$i] [] = $value ['seuil'];
            $i++;
        }
        return $arrayStocks;
    }
    
    public function countAll($codeUsine,$sWhere="") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*'){
            $sql = 'select count(produit.id) as nbStocks
                        from produit,stock_reel where produit.id=produit_id and codeUsine="'.$codeUsine.'" ' . $sWhere . ' and stock!=0.00';
        }
        else {
            $sql = 'select count(produit.id) as nbStocks
                        from produit,stock_reel where produit.id=produit_id ' . $sWhere . ' and stock!=0.00';
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeStocks = $stmt->fetch();
        return $nbTypeStocks['nbStocks'];
    }

    public function countByUsine($codeUsine, $login, $sWhere="") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;

        $sql = 'select count(produit.id) as nbStocks
                    from produit,stock_reel where produit.id=produit_id AND codeUsine="'.$codeUsine.'" ' . $sWhere . ' and stock!=0.00 ';
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
    
    public function findQuantiteReelByProduitId($produitId, $codeUsine) {
        $sql = 'SELECT stock FROM stock_reel where produit_id = "'.$produitId.'" and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if ($stock != null)
            return $stock[0];
        else
            return null;
    }
    
    public function updateNbStock($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_provisoire SET stock = stock + $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    
    public function deleteStockReel($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("DELETE FROM stock_reel WHERE  produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    
    public function misAjourStockProvisoire($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_provisoire SET stock = $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    
    public function misAjourStockReel($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET stock = $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    
    public function updateNbStockReel($produitId, $codeUsine, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET stock = stock + $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");

    }
    
    public function updateSortieNbStockReel($produitId, $codeUsineOrigine,$nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET stock = stock + $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsineOrigine."'");
    }
    
    public function updateSeuilStock($produitId, $codeUsine, $nbSeuil ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET seuil = $nbSeuil WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    public function resetStockProvisoire($produitId, $codeUsine, $quantiteAdemouler ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_provisoire SET stock = stock - $quantiteAdemouler WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
		
    }
    
        
    public function destockage($produitId, $codeUsine, $nbStock) {
        if ($produitId != "" && $codeUsine != "" && $nbStock != "") {
            $connexion = Bootstrap::$entityManager->getConnection();
            return $connexion->executeUpdate("UPDATE stock_provisoire SET stock = stock - $nbStock WHERE produit_id = $produitId AND codeUsine='" . $codeUsine . "'");
        }
        return NULL;
    }

    public function destockageReel($produitId, $codeUsineDestination, $nbStock ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE stock_reel SET stock = stock - $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsineDestination."'");
		
	}
        
    public function recupereNbStockProvisoire($produitId, $codeUsine ) {
        $sql = "SELECT SUM(stock) stockProvisoire FROM stock_provisoire spr WHERE spr.produit_id=$produitId and stock<>0.00  and codeUsine='".$codeUsine."'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
         return null;
        
    }
    
    public function recupereQuantiteAchete($produitId, $codeUsine ) {
        $sql = "SELECT SUM(quantiteAchetee) quantiteAchetee FROM stock_achete sat, achat a WHERE a.id=sat.achatId  and quantiteAchetee<>0.00 AND sat.produitId=$produitId and a.codeUsine='".$codeUsine."'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
         return null;
        
    }
    
     public function recupereQuantiteDemoulee($produitId, $codeUsine ) {
        $sql = "SELECT SUM(quantiteDemoulee) quantiteDemoulee FROM demoulage WHERE produit_id=$produitId and quantiteDemoulee<>0.00 and codeUsine='".$codeUsine."'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
         return null;
        
    }
    
    public function recupereQuantiteFacturee($produitId, $codeUsine ) {
        $sql = "SELECT SUM(quantiteFacturee) quantiteFacturee FROM stock_facture sfa, facture f WHERE f.id= sfa.factureId and sfa.produitId=$produitId and quantiteFacturee<>0.00 and f.codeUsine='".$codeUsine."'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
         return null;
        
    }
    
    public function recupereStockReel($produitId, $codeUsine ) {
        $sql = "SELECT SUM(stock) stockReel FROM stock_reel sre WHERE sre.produit_id=$produitId and stock<>0.00 and codeUsine='".$codeUsine."'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if($stock!=null)
            return $stock[0];
         return null;
    }
    
    public function recupereQuantiteEntree($produitId, $codeUsine ) {
    	$sql = "SELECT SUM(se.quantiteEntree) quantiteEntree FROM stock_entree se, bon_sortie bs WHERE bs.id=se.sortieId and quantiteEntree<>0.00 and se.produitId=$produitId and bs.destination='".$codeUsine."'";
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$stock = $stmt->fetchAll();
    	if($stock!=null)
    		return $stock[0];
    	return null;
    }
    public function recupereQuantiteSortie($produitId, $codeUsine ) {
    	$sql = "SELECT SUM(ss.quantiteSortie) quantiteSortie FROM stock_sortie ss, bon_sortie bs WHERE bs.id=ss.sortieId and quantiteSortie<>0.00 and ss.produitId=$produitId and bs.origine='".$codeUsine."'";
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$stock = $stmt->fetchAll();
    	if($stock!=null)
    		return $stock[0];
    	return null;
    
    }
    
    public function deleteStockSortie($sortieId, $produitId) {
    	$connexion=  Bootstrap::$entityManager->getConnection();
    	return $connexion->executeUpdate('delete  FROM stock_sortie where produitId = "'.$produitId.'" and sortieId="'.$sortieId.'"');
    }
    public function deleteStockFacturee($factureId, $produitId) {
    	$connexion=  Bootstrap::$entityManager->getConnection();
    	return $connexion->executeUpdate('delete  FROM stock_facture where produitId = "'.$produitId.'" and factureId="'.$factureId.'"');
    }
    
}
