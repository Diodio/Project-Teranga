<?php

namespace Produit;
use Produit\CartonQueries as CartonQueries;



class CartonManager {

    private $cartonQueries;

    public function __construct() {
        $this->cartonQueries = new CartonQueries();
    }
        
    

    public function insert($carton) {
        $this->cartonQueries->insert($carton);
    	return $carton;
    }
    
}
