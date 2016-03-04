<?php

namespace BonSortie;
use Facture\LigneColisQueries as LigneColisQueries;



class LigneColisBonSortieManager {

    private $ligneColisQuery;
   

    public function __construct() {
        $this->ligneColisQuery = new LigneColisBonSortieQueries();
    }
    
    public function insert($ligneColis) {
        $this->ligneColisQuery->insert($ligneColis);
    	return $ligneColis;
    }
    public function dimunieNbColis($produitId, $quantite, $nbCarton, $codeUsine) {	
         return $this->ligneColisQuery->dimunieNbColis($produitId, $quantite, $nbCarton, $codeUsine);
    }
    
    public function misAjourColisDestination($produitId, $quantite, $nbCarton, $codeUsine) {	
         return $this->ligneColisQuery->misAjourColisDestination($produitId, $quantite, $nbCarton, $codeUsine);
    }
}
