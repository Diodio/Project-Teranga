<?php

namespace Produit;
require_once '../../common/app.php';
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
    
    
    
    public function listAll() {
    	$this->stockQuery=$this->stockQuery->findAll();
    	return $this->stockQuery;
    }

    
    

    
    public function retrieveAll($produitId, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->stockQuery->retrieveAll($produitId, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function count($where="") {
        return $this->stockQuery->count($where);
    }
    
  public function findStats($nomUsine,$nomUser) {
        $stockQueries = new StockQueries();
    	return $stockQueries->findStats($$nomUsine,$nomUser);
	}

}
