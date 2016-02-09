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
    
   public function findById($stockAcheteId) {
       return $this->stockAcheteQuery->findById($stockAcheteId);
   }

   public function findStocksAcheteById($achatId, $produitId) {
       return $this->stockAcheteQuery->findStocksAcheteById($achatId, $produitId);
   }
   
   public function delete($stockAcheteId) {
       return $this->stockAcheteQuery->delete($stockAcheteId);
   }
}
