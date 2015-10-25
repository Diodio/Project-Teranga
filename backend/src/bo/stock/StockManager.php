<?php

namespace Produit;
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

    
    

    
    public function retrieveAll($produitId, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockQuery->retrieveAll($produitId, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function retrieveAllByUsine($codeUsine, $login, $produitId, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockQuery->retrieveAllByUsine($codeUsine, $login, $produitId, $offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function countAll($produitId, $where="") {
        return $this->stockQuery->countAll($produitId, $where);
    }
    
    public function countByUsine($usine, $user, $produitId, $where="") {
        return $this->stockQuery->countByUsine($usine, $user, $produitId, $where);
    }
    
  public function findStats() {
        $stockQueries = new StockQueries();
    	return $stockQueries->findStats();
  }
  
  public function findStatsFamille($produitId, $codeUsine) {
        $stockQueries = new StockQueries();
    	return $stockQueries->findStatsFamille($produitId, $codeUsine);
  }

}
