<?php

namespace BonSortie;



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
    
    public function dimunieSortieNbColis($produitId, $quantite, $nbCarton, $codeUsineDestination) {	
         return $this->ligneColisQuery->dimunieSortieNbColis($produitId, $quantite, $nbCarton, $codeUsineDestination);
    }
    
    public function misAjourColisDestination($produitId, $quantite, $nbCarton, $codeUsine) {	
         return $this->ligneColisQuery->misAjourColisDestination($produitId, $quantite, $nbCarton, $codeUsine);
    }
    
    public function misAjourColisSortieOrigine($produitId, $quantite, $nbCarton, $codeUsineOrigine) {	
         return $this->ligneColisQuery->misAjourColisSortieOrigine($produitId, $quantite, $nbCarton, $codeUsineOrigine);
    }
     public function getAllColisBonSortie($bonsortieId, $produitId) {
        return $this->ligneColisQuery->getAllColisBonSortie($bonsortieId, $produitId);
    }
  
  public function verifieColisage($produitId, $quantite, $codeUsineOrigine) {
      $stockQueries = new StockQueries();
      $stock=$stockQueries->verifieColisage($produitId, $quantite, $codeUsineOrigine);
      if($stock!=null)
        return $stock['id'];
    return 0;
  }
}
