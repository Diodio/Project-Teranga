<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class CartonQueries {
    /*
     *
     */

    private $entityManager;
    private $classString;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
        $this->classString = 'Carton\Carton';
    }

   
    public function insert($carton) {
        if ($carton != null) {
            if ($carton->getId() != null){
                Bootstrap::$entityManager->merge($carton);
            }
            else {
                Bootstrap::$entityManager->persist($carton);
            }
            Bootstrap::$entityManager->flush();
            return $carton;
        }
    }
 
    public function findCartonByProduitId($produitId, $codeUsine, $quantite,$nbColis) {
        $sql = 'SELECT distinct id FROM carton WHERE produitId = "'.$produitId.'" and codeUsine="'.$codeUsine.'" and nombreCarton >='.$nbColis.' and quantiteParCarton='.$quantite.'';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $cartonId = $stmt->fetchAll();
        if ($cartonId != null)
            return $cartonId[0];
        else
            return null;
    }
    
 
    public function getColisage($produitId, $quantite,$codeUsine, $nbColis) {
            $sql = 'SELECT distinct nombreCarton FROM carton WHERE produitId='.$produitId.' and quantiteParCarton='.$quantite.' and codeUsine="' .$codeUsine.'" and nombreCarton >='.$nbColis.'';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colis= $stmt->fetchAll();
        return $colis;
    }
    
    public function getEntityManager() {
        return $this->entityManager;
    }
    
  
}
