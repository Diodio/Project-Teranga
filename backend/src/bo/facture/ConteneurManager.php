<?php

namespace Facture;
use Facture\ConteneurQueries as ConteneurQueries;



class ConteneurManager {

    private $conteneurQuery;
   

    public function __construct() {
        $this->conteneurQuery = new ConteneurQueries();
    }
    
    public function insert($conteneur) {
        $this->conteneurQuery->insert($conteneur);
    	return $conteneur;
    }
   
}
