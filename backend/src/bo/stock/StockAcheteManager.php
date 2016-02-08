<?php

namespace Stock;
use Stock\StockAcheteQueries as StockAcheteQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class StockAcheteManager {

    private $stockAcheteQuery;
   

    public function __construct() {
        $this->stockAcheteQuery = new StockAcheteQueries();
    }
    
    public function insert($stock) {
        $this->stockAcheteQuery->insert($stock);
    	return $stock;
    }
    
    public function listAll() {
    	$this->stockAcheteQuery=$this->stockAcheteQuery->findAll();
    	return $this->stockAcheteQuery;
    }

    
    

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockAcheteQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }

    public function retrieveAllByUsine($codeUsine, $login, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockAcheteQuery->retrieveAllByUsine($codeUsine, $login, $offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function countAll($where="") {
        return $this->stockAcheteQuery->countAll($where);
    }
    
    public function countByUsine($usine, $user, $where="") {
        return $this->stockAcheteQuery->countByUsine($usine, $user, $where);
    }
    
  public function findStats($codeUsine) {
        $stockQueries = new StockAcheteQueries();
    	return $stockQueries->findStats($codeUsine);
  }
  
  public function findStatsFamille($produitId, $codeUsine) {
        $stockQueries = new StockAcheteQueries();
    	return $stockQueries->findStatsFamille($produitId, $codeUsine);
  }
  
  public function recupereNombreStockAcheteParProduit($produitId, $codeUsine ) {
       $stockQueries = new StockAcheteQueries();
        $stock = $stockQueries->recupereNombreStockAcheteParProduit($produitId, $codeUsine);
       $arrayStock = array();
        $stockReel = 0;
        if($stock['quantiteAchetee']!=NULL)
            $stockReel=$stock['quantiteAchetee'];
        $arrayStock ['nbStocks'] =$stockReel;
//        foreach ($stock as $key => $value) {
//            
//            $arrayStock ['nbStocks'] = $value ['stock'];
//        }
        return $arrayStock;
       
  }

  public function getStockValueParProduit($produitId, $codeUsine ) {
       $stockQueries = new StockAcheteQueries();
        $stock = $stockQueries->recupereNombreStockParProduit($produitId, $codeUsine);
        $stockReel = 0;
        if($stock['stock']!=NULL)
            $stockReel=$stock['stock'];
        return $stockReel;
  }
  public function updateNbStockAchete($produitId, $codeUsine, $nbStock ) {	
       $stockAcheteQueries = new StockAcheteQueries();
    	return $stockAcheteQueries->updateNbStockAchete($produitId, $codeUsine, $nbStock);
  }
  
  public function updateNbStockReel($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockAcheteQueries();
    	return $stockQueries->updateNbStockReel($produitId, $codeUsine, $nbStock);
  }
  public function updateSeuilStock($produitId, $codeUsine, $nbSeuil ) {	
       $stockQueries = new StockAcheteQueries();
    	return $stockQueries->updateSeuilStock($produitId, $codeUsine, $nbSeuil);
  }
    public function resetStockProvisoire($produitId, $codeUsine, $quantiteAdemouler ) {	
       $stockQueries = new StockAcheteQueries();
    	return $stockQueries->resetStockProvisoire($produitId, $codeUsine, $quantiteAdemouler);
  }
  public function destockage($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockAcheteQueries();
    	return $stockQueries->destockage($produitId, $codeUsine, $nbStock);
  }
  
  public function destockageReel($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockAcheteQueries();
    	return $stockQueries->destockageReel($produitId, $codeUsine, $nbStock);
  }
  public function findStockAcheteByProduitId($produitId, $codeUsine) {
      $stockQueries = new StockAcheteQueries();
      $stock=$stockQueries->findStockAcheteByProduitId($produitId, $codeUsine);
      if($stock!=null)
        return $stock['id'];
    return 0;
  }
  
  public function ajoutStockReelParProduit($produitId, $codeUsine, $login, $quantiteAdemouler, $quantiteDemoulee) {
        $stockAchete = $this->findStockReelByProduitId($produitId, $codeUsine);
        if ($stockAchete == 0) {
            $stockAchete = new \Stock\StockAchete();
            $stockAchete->setCodeUsine($codeUsine);
            $stockAchete->setLogin($login);
            $produitManger = new \Produit\ProduitManager();
            $produit = $produitManger->findById($produitId);
            $stockAchete->setProduit($produit);
            $stockAchete->setStock($quantiteDemoulee);
            $seuil = ($quantiteDemoulee * 25)/100;
            $stockAchete->setSeuil($seuil);
            $this->insert($stockAchete);
        } else {
            $valueStock = $this->getStockValueParProduit($produitId, $codeUsine);
            $seuil = (($valueStock+$quantiteDemoulee) * 25/100);
            $this->updateNbStockReel($produitId, $codeUsine, $quantiteDemoulee);
            $this->updateSeuilStock($produitId, $codeUsine, $seuil);
        }
        $this->resetStockProvisoire($produitId, $codeUsine, $quantiteAdemouler);
    }

}
