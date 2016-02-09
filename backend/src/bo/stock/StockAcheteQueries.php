<?php

namespace Stock;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class StockAcheteQueries {
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
    public function findStocksAcheteById($achatId, $produitId) {
        $sql = "SELECT id FROM stock_achete where achatId = '$achatId' and produitId='$produitId'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stockId = $stmt->fetch();
        if($stockId!=null)
            return $stockId['id'];
        return null;
    }
    public function findById($stockAcheteId) {
        if ($stockAcheteId != null) {
            return Bootstrap::$entityManager->find('Stock\StockAchete', $stockAcheteId);
        }
    }

     public function delete($stockAchete) {
            Bootstrap::$entityManager->remove($stockAchete);
            Bootstrap::$entityManager->flush();
            return $stockAchete;
        
    }
    
    public function getEntityManager() {
        return $this->entityManager;
    }

 
}
