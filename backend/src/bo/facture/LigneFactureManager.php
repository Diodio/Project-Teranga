<?php

namespace Facture;
use Facture\LigneColisQueries as LigneColisQueries;



class LigneFactureManager {

    private $conteneurQuery;
   

    public function __construct() {
        $this->conteneurQuery = new ConteneurQueries();
    }
    
    public function insert($conteneur) {
        $this->conteneurQuery->insert($conteneur);
    	return $conteneur;
    }
   
}
