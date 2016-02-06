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
    
  public function findStats($codeUsine) {
        $stockQueries = new StockQueries();
    	return $stockQueries->findStats($codeUsine);
  }
  
  public function findStatsFamille($produitId, $codeUsine) {
        $stockQueries = new StockQueries();
    	return $stockQueries->findStatsFamille($produitId, $codeUsine);
  }
  
  public function recupereNombreStockParProduit($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
        $stock = $stockQueries->recupereNombreStockParProduit($produitId, $codeUsine);
       $arrayStock = array();
        $stockReel = 0;
        if($stock['stock']!=NULL)
            $stockReel=$stock['stock'];
        $arrayStock ['nbStocks'] =$stockReel;
//        foreach ($stock as $key => $value) {
//            
//            $arrayStock ['nbStocks'] = $value ['stock'];
//        }
        return $arrayStock;
       
  }

  public function getStockValueParProduit($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
        $stock = $stockQueries->recupereNombreStockParProduit($produitId, $codeUsine);
        $stockReel = 0;
        if($stock['stock']!=NULL)
            $stockReel=$stock['stock'];
        return $stockReel;
  }
  public function updateNbStock($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateNbStock($produitId, $codeUsine, $nbStock);
  }
  
  public function updateNbStockReel($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateNbStockReel($produitId, $codeUsine, $nbStock);
  }
  public function updateSeuilStock($produitId, $codeUsine, $nbSeuil ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateSeuilStock($produitId, $codeUsine, $nbSeuil);
  }
    public function resetStockProvisoire($produitId, $codeUsine, $quantiteAdemouler ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->resetStockProvisoire($produitId, $codeUsine, $quantiteAdemouler);
  }
  public function destockage($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->destockage($produitId, $codeUsine, $nbStock);
  }
  
  public function destockageReel($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->destockageReel($produitId, $codeUsine, $nbStock);
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
  public function ajoutStockReelParProduit($produitId, $codeUsine, $login, $quantiteAdemouler, $quantiteDemoulee) {
        $stockReel = $this->findStockReelByProduitId($produitId, $codeUsine);
        if ($stockReel == 0) {
            $stockReel = new \Stock\StockReel();
            $stockReel->setCodeUsine($codeUsine);
            $stockReel->setLogin($login);
            $produitManger = new \Produit\ProduitManager();
            $produit = $produitManger->findById($produitId);
            $stockReel->setProduit($produit);
            $stockReel->setStock($quantiteDemoulee);
            $seuil = ($quantiteDemoulee * 25)/100;
            $stockReel->setSeuil($seuil);
            $this->insert($stockReel);
        } else {
            $valueStock = $this->getStockValueParProduit($produitId, $codeUsine);
            $seuil = (($valueStock+$quantiteDemoulee) * 25/100);
            $this->updateNbStockReel($produitId, $codeUsine, $quantiteDemoulee);
            $this->updateSeuilStock($produitId, $codeUsine, $seuil);
        }
        $this->resetStockProvisoire($produitId, $codeUsine, $quantiteAdemouler);
    }

}
