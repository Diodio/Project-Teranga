<?php

namespace Empotage;
use Empotage\LigneEmpotageQueries as LigneEmpotageQueries;



class LigneEmpotageManager {

    private $ligneEmpotageQuery;
   

    public function __construct() {
        $this->ligneEmpotageQuery = new LigneEmpotageQueries();
    }
    
    public function insert($ligneFacture) {
        $this->ligneEmpotageQuery->insert($ligneFacture);
    	return $ligneFacture;
    }
    
    public function findById($ligneFactureId) {
        return $this->ligneEmpotageQuery->findById($ligneFactureId);
    }
   
}
