<?php

namespace Achat;
use Achat\AchatQueries as AchatQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class AchatManager {

    private $achatQuery;
   

    public function __construct() {
        $this->achatQuery = new AchatQueries();
    }
    
    public function insert($produit) {
        $this->achatQuery->insert($produit);
    	return $produit;
    }
    
    public function listAll() {
    	$this->achatQuery=$this->achatQuery->findAll();
    	return $this->achatQuery;
    }


   public function findById($produitId) {
       return $this->achatQuery->findById($produitId);
    }
   
    
    public function findTypeAchatById($typeproduitId) {
        return $this->achatQuery->findTypeAchatById($typeproduitId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->achatQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function count($where="") {
        return $this->achatQuery->count($where);
    }
    
    


}
