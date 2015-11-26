<?php

namespace Reglement;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ReglementQueries {
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
        $this->classString = 'Reglement\Reglement';
    }

   
    public function insert($reglement) {
        if ($reglement != null) {
            Bootstrap::$entityManager->persist($reglement);
            Bootstrap::$entityManager->flush();
            return $reglement;
        }
    }

    
}
