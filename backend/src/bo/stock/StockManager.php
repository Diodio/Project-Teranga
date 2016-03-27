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

    
    

    
    public function retrieveAll($codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockQuery->retrieveAll($codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function retrieveAllByUsine($codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockQuery->retrieveAllByUsine($codeUsine, $offset, $rowCount, $sOrder, $sWhere);
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
  
  public function misAjourStockProvisoire($produitId, $codeUsine, $nbStock ) {			
       $stockQueries = new StockQueries();
    	return $stockQueries->misAjourStockProvisoire($produitId, $codeUsine, $nbStock);
		
    }
    
    public function misAjourStockReel($produitId, $codeUsine, $nbStock ) {			
        $stockQueries = new StockQueries();
    	return $stockQueries->misAjourStockReel($produitId, $codeUsine, $nbStock);
		
    }
    
    
  public function updateNbStock($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateNbStock($produitId, $codeUsine, $nbStock);
  }
  
  public function updateNbStockReel($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateNbStockReel($produitId, $codeUsine, $nbStock);
  }
  
  public function updateSortieNbStockReel($produitId, $codeUsineOrigine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateSortieNbStockReel($produitId, $codeUsineOrigine, $nbStock);
  }
  
  public function updateSeuilStock($produitId, $codeUsine, $nbSeuil ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->updateSeuilStock($produitId, $codeUsine, $nbSeuil);
  }
    public function resetStockProvisoire($produitId, $codeUsine, $quantitedemouler ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->resetStockProvisoire($produitId, $codeUsine, $quantitedemouler);
  }
  public function destockage($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->destockage($produitId, $codeUsine, $nbStock);
  }
  
  public function destockageReel($produitId, $codeUsine, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->destockageReel($produitId, $codeUsine, $nbStock);
  }
  
  public function destockageSortieReel($produitId, $codeUsineDestination, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->destockageReel($produitId, $codeUsineDestination, $nbStock);
  }
  
  public function deleteStockReel($produitId, $codeUsineDestination, $nbStock ) {	
       $stockQueries = new StockQueries();
    	return $stockQueries->deleteStockReel($produitId, $codeUsineDestination, $nbStock);
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
  
  public function findQuantiteReelByProduitId($produitId, $codeUsine) {
      $stockQueries = new StockQueries();
      $stock=$stockQueries->findQuantiteReelByProduitId($produitId, $codeUsine);
      if($stock!=null)
        return $stock['stock'];
    return 0;
  }
  
  public function ajoutStockReelParProduit($produitId, $codeUsine, $login, $stockProvisoire, $quantiteDemoulee) {
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
        $this->resetStockProvisoire($produitId, $codeUsine, $quantiteDemoulee);
    }

    
  
  public function recupereNbStockProvisoire($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
        $stock = $stockQueries->recupereNbStockProvisoire($produitId, $codeUsine);
       $arrayStock = array();
        $stockPro = 0;
        if($stock['stockProvisoire']!=NULL)
            $stockPro=$stock['stockProvisoire'];
        return $stockPro;
       
  }
  public function recupereQuantiteAchete($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
        $stock = $stockQueries->recupereQuantiteAchete($produitId, $codeUsine);
       $arrayStock = array();
        $stockPro = 0;
        if($stock['quantiteAchetee']!=NULL)
            $stockPro=$stock['quantiteAchetee'];
        return $stockPro;
       
  }
  public function recupereQuantiteDemoulee($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
        $stock = $stockQueries->recupereQuantiteDemoulee($produitId, $codeUsine);
       $arrayStock = array();
        $stockPro = 0;
        if($stock['quantiteDemoulee']!=NULL)
            $stockPro=$stock['quantiteDemoulee'];
        return $stockPro;
       
  }
  public function recupereQuantiteFacturee($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
        $stock = $stockQueries->recupereQuantiteFacturee($produitId, $codeUsine);
       $arrayStock = array();
        $stockPro = 0;
        if($stock['quantiteFacturee']!=NULL)
            $stockPro=$stock['quantiteFacturee'];
        return $stockPro;
       
  }
  public function recupereStockReel($produitId, $codeUsine ) {
       $stockQueries = new StockQueries();
        $stock = $stockQueries->recupereStockReel($produitId, $codeUsine);
       $arrayStock = array();
        $stockPro = 0;
        if($stock['stockReel']!=NULL)
            $stockPro=$stock['stockReel'];
        return $stockPro;
  }
  public function recupereQuantiteEntree($produitId, $codeUsine ) {
  	$stockQueries = new StockQueries();
  	$stock = $stockQueries->recupereQuantiteEntree($produitId, $codeUsine);
  	$arrayStock = array();
  	$stockPro = 0;
  	if($stock['quantiteEntree']!=NULL)
  		$stockPro=$stock['quantiteEntree'];
  	return $stockPro;
  	 
  }
  public function recupereQuantiteSortie($produitId, $codeUsine ) {
  	$stockQueries = new StockQueries();
  	$stock = $stockQueries->recupereQuantiteSortie($produitId, $codeUsine);
  	$arrayStock = array();
  	$stockPro = 0;
  	if($stock['quantiteSortie']!=NULL)
  		$stockPro=$stock['quantiteSortie'];
  	return $stockPro;
  
  }
  
  public function deleteStockSortie($sortieId, $produitId) {
  	$stockQueries = new StockQueries();
  	$stock=$stockQueries->deleteStockSortie($sortieId, $produitId);
  }
  
  public function deleteStockEntree($sortieId, $produitId) {
  	$stockQueries = new StockQueries();
  	$stock=$stockQueries->deleteStockEntree($sortieId, $produitId);
  }
  
  public function deleteStockFacturee($factureId, $produitId) {
  	$stockQueries = new StockQueries();
  	return $stockQueries->deleteStockFacturee($factureId, $produitId);
  }
  

}
