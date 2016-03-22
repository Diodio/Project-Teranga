<?php

namespace Facture;
use Facture\LigneFactureQueries as LigneFactureQueries;



class LigneFactureManager {

    private $ligneFactureQuery;
   

    public function __construct() {
        $this->ligneFactureQuery = new LigneFactureQueries();
    }
    
    public function insert($ligneFacture) {
        $this->ligneFactureQuery->insert($ligneFacture);
    	return $ligneFacture;
    }
    
    public function findById($ligneFactureId) {
        return $this->ligneFactureQuery->findById($ligneFactureId);
    }
   
}
