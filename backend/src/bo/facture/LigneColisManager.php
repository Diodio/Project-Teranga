<?php

namespace Facture;
use Facture\LigneColisQueries as LigneColisQueries;



class LigneColisManager {

    private $ligneColisQuery;
   

    public function __construct() {
        $this->ligneColisQuery = new ConteneurQueries();
    }
    
    public function insert($ligneColis) {
        $this->ligneColisQuery->insert($ligneColis);
    	return $ligneColis;
    }
   
}
