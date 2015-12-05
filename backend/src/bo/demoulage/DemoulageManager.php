<?php

namespace Produit;
use Produit\DemoulageQueries as DemoulageQueries;



class DemoulageManager {

    private $demoulageQueries;

    public function __construct() {
        $this->demoulageQueries = new DemoulageQueries();
    }
    
    public function insert($demoulage) {
        $this->demoulageQueries->insert($demoulage);
    	return $demoulage;
    }
    
  

   

}
