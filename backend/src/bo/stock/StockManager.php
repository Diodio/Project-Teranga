<?php

namespace Stock;
use Stock\StockQueries as StockQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class StockManager {

    private $stockQuery;
   

    public function __construct() {
        $this->stockQuery = new StockQueries();
    }
    
    public function insert($stock) {
        $this->stockQuery->insert($stock);
    	return $stock;
    }
    
    public function listAll() {
    	$this->stockQuery=$this->stockQuery->findAll();
    	return $this->stockQuery;
    }

    
    

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }

    public function retrieveAllByUsine($codeUsine, $login, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockQuery->retrieveAllByUsine($codeUsine, $login, $offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function countAll($where="") {
        return $this->stockQuery->countAll($where);
    }
    
    public function countByUsine($usine, $user, $where="") {
        return $this->stockQuery->countByUsine($usine, $user, $where);
    }
    
  public function findStats() {
        $stockQueries = new StockQueries();
    	return $stockQueries->findStats();
  }
  
  public function findStatsFamille($produitId, $codeUsine) {
        $stockQueries = new StockQueries();
    	return $stockQueries->findStatsFamille($produitId, $codeUsine);
  }
  
  public function recupereNombreStockParProduit($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
    	return $stockQueries->recupereNombreStockParProduit($produitId, $codeUsine);
  }

  public function updateNbStock($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateNbStock($produitId, $codeUsine, $nbStock);
  }
  
  public function updateNbStockReel($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateNbStockReel($produitId, $codeUsine, $nbStock);
  }
    public function resetStockProvisoire($produitId, $codeUsine ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->resetStockProvisoire($produitId, $codeUsine);
  }
  public function destockage($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->destockage($produitId, $codeUsine, $nbStock);
  }
  
  public function findStockProvisoireByProduitId($produitId, $codeUsine) {
      $stockQueries = new StockQueries();
      $stock=$stockQueries->findStockProvisoireByProduitId($produitId, $codeUsine);
      if($stock!=null)
        return $stock['id'];
    return 0;
  }
  
  public function findStockReelByProduitId($produitId, $codeUsine) {
      $stockQueries = new StockQueries();
      $stock=$stockQueries->findStockReelByProduitId($produitId, $codeUsine);
      if($stock!=null)
        return $stock['id'];
    return 0;
  }
  public function ajoutStockReelParProduit($produitId, $codeUsine, $login, $stock) {
            $stockReel = $this->findStockReelByProduitId($produitId, $codeUsine);
            if ($stockReel == 0) {
                $stockReel = new \Stock\StockReel();
                $stockReel->setCodeUsine($codeUsine);
                $stockReel->setLogin($login);
                $produitManger = new \Produit\ProduitManager();
                $produit= $produitManger->findById($produitId);
                $stockReel->setProduit($produit);
                $stockReel->setStock($stock);
                $this->insert($stockReel);
            } else {
                $this->updateNbStockReel($produitId, $codeUsine, $stock);
            }
            $this->resetStockProvisoire($produitId, $codeUsine);
        
    }
}
