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
    
    public function findCartonByProduitId($produitId, $codeUsine,$quantite,$nbColis) {
      $stockQueries = new CartonQueries();
      $carton=$stockQueries->findCartonByProduitId($produitId, $codeUsine,$quantite, $nbColis);
      if($carton!=null)
        return $carton['id'];
    return 0;
  }
  
  public function getColisage($produitId, $quantite, $codeUsine,$nbColis) {
      $colis=$this->cartonQueries->getColisage($produitId, $quantite, $codeUsine,$nbColis);
      if($colis!=null)
        return $colis[0];
    return 0;
  }
}
