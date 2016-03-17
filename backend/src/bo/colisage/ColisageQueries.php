<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ColisageQueries {
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
        $this->classString = 'Colisage\Colisage';
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
 
   public function findById($colisageId) {
        if ($colisageId != null) {
                return Bootstrap::$entityManager->find('Colisage\Colisage', $colisageId);
        }
    }
    
    public function getEntityManager() {
        return $this->entityManager;
    }
   
    public function verifieColisage($produitId, $quantite, $codeUsine) {
        $sql = 'SELECT id FROM colisage WHERE quantiteParCarton='.$quantite.' AND produitId='.$produitId.' AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if ($stock != null)
            return $stock[0];
        else
            return null;
    }
}
