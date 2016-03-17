<?php

namespace Produit;
use Produit\ColisageQueries as ColisageQueries;



class ColisageManager {

    private $colisageQueries;

    public function __construct() {
        $this->colisageQueries = new ColisageQueries();
    }
        
    

    public function insert($carton) {
        $this->colisageQueries->insert($carton);
    	return $carton;
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
}
