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
    
    public function findColisByProduitId($produitId, $codeUsine, $quantiteParCarton) {
        $colisQueries = new CartonQueries();
      $carton=$colisQueries->findColisByProduitId($produitId, $codeUsine,$quantiteParCarton);
      if($carton!=null)
        return $carton['id'];
    return 0;
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
  
  public function misAjourColis($produitId, $quantite, $nbCarton, $codeUsine) {
     $this->cartonQueries->misAjourColis($produitId, $quantite, $nbCarton, $codeUsine) ;
  }
  
  public function verifieColisage($produitId, $quantite, $nombreCarton, $codeUsine) {
      $stock=$this->cartonQueries->verifieColisage($produitId, $quantite, $nombreCarton, $codeUsine);
      if($stock!=null)
        return $stock['id'];
    return 0;
  }
}
