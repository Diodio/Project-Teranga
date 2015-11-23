<?php

namespace Facture;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ConteneurQueries {
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
        $this->classString = 'Facture\Conteneur';
    }

   
    public function insert($conteneur) {
        if ($conteneur != null) {
            Bootstrap::$entityManager->persist($conteneur);
            Bootstrap::$entityManager->flush();
            return $conteneur;
        }
    }
}
