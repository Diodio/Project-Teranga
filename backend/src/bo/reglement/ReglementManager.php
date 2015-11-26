<?php

namespace Reglement;
use Reglement\ReglementQueries as ReglementQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class ReglementManager {

    private $reglementQuery;
   

    public function __construct() {
        $this->reglementQuery = new ReglementQueries();
    }
    
    public function insert($reglement) {
        $this->reglementQuery->insert($reglement);
    	return $reglement;
    }
    
    

}
