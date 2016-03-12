<?php

namespace Produit;
use Produit\CartonQueries as CartonQueries;



class CartonManager {

    private $cartonQueries;

    public function __construct() {
        $this->cartonQueries = new CartonQueries();
    }
        
    

    public function insert($carton) {
        $this->cartonQueries->insert($carton);
    	return $carton;
    }
    
    public function findCartonByProduitId($produitId, $codeUsine) {
      $stockQueries = new CartonQueries();
      $carton=$stockQueries->findCartonByProduitId($produitId, $codeUsine);
      if($carton!=null)
        return $carton['id'];
    return 0;
  }
  
  public function getColisage($produitId, $quantite, $codeUsine) {
      $colis=$this->cartonQueries->getColisage($produitId, $quantite, $codeUsine);
      if($colis!=null)
        return $colis[0];
    return 0;
  }
}
