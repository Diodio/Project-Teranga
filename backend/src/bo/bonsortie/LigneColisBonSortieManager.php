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
    public function dimunieNbColis($produitId, $quantite, $nbCarton) {	
         return $this->ligneColisQuery->dimunieNbColis($produitId, $quantite, $nbCarton);
    }
    
    public function ajoutNbColis($produitId, $quantite, $nbCarton) {	
         return $this->ligneColisQuery->ajoutNbColis($produitId, $quantite, $nbCarton);
    }
}
