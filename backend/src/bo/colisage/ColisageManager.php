<?php

namespace Produit;
use Produit\ColisageQueries as ColisageQueries;



class ColisageManager {

    private $colisageQueries;

    public function __construct() {
        $this->colisageQueries = new ColisageQueries();
    }
        
    

    public function insert($colisage) {
        $this->colisageQueries->insert($colisage);
    	return $colisage;
    }
    
   public function findById($colisageId) {
        return $this->colisageQueries->findById($colisageId);
    }
    
    public function verifieColisage($produitId, $quantite, $codeUsine) {
      $colisageQueries = new ColisageQueries();
      $colisage=$colisageQueries->verifieColisage($produitId, $quantite, $codeUsine);
      if($colisage!=null)
        return $colisage['id'];
    return 0;
  }
  
  
  public function getNombreCartonColisage($produitId, $quantite, $codeUsine) {
      $colisageQueries = new ColisageQueries();
      $colisage=$colisageQueries->getNombreCartonColisage($produitId, $quantite, $codeUsine);
      if($colisage!=null)
        return $colisage['nombreCarton'];
    return 0;
  }
  
  public function misAjourColis($produitId, $quantite, $nbCarton, $codeUsine) {
      $colisageQueries = new ColisageQueries();
      $colisageQueries->misAjourColis($produitId, $quantite, $nbCarton, $codeUsine) ;
  }
}
