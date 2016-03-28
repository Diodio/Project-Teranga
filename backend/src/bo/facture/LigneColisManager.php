<?php

namespace Facture;
use Facture\LigneColisQueries as LigneColisQueries;



class LigneColisManager {

    private $ligneColisQuery;
   

    public function __construct() {
        $this->ligneColisQuery = new LigneColisQueries();
    }
    
    public function insert($ligneColis) {
        $this->ligneColisQuery->insert($ligneColis);
    	return $ligneColis;
    }
    public function dimunieNbColis($produitId, $quantite, $nbCarton) {	
         return $this->ligneColisQuery->dimunieNbColis($produitId, $quantite, $nbCarton);
    }
    
    public function dimunieColisFacturee($produitId, $quantite, $nbCarton, $codeUsine) {	
         return $this->ligneColisQuery->dimunieColisFacturee($produitId, $quantite, $nbCarton, $codeUsine);
    }
}
