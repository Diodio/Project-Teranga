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
 
    public function findCartonByProduitId($produitId, $codeUsine) {
        $sql = 'SELECT id FROM carton WHERE produitId = "'.$produitId.'" and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $cartonId = $stmt->fetchAll();
        if ($cartonId != null)
            return $cartonId[0];
        else
            return null;
    }
    
 
    public function getEntityManager() {
        return $this->entityManager;
    }
    
  
}
