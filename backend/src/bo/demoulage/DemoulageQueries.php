<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class DemoulageQueries {
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
        $this->classString = 'Demoulage\Demoulage';
    }

   
    public function insert($demoulage) {
        if ($demoulage != null) {
            Bootstrap::$entityManager->persist($demoulage);
            Bootstrap::$entityManager->flush();
            return $demoulage;
        }
    }
 
    public function getEntityManager() {
        return $this->entityManager;
    }
    
}
