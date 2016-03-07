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
        $sql = 'SELECT c.id FROM carton c, demoulage d WHERE d.id=c.demoulage_id and produit_id = "'.$produitId.'" and c.codeUsine="'.$codeUsine.'"';
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
