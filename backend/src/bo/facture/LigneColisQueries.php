<?php

namespace Facture;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class LigneColisQueries {
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
        $this->classString = '';
    }

   
    public function insert($ligneColis) {
        if ($ligneColis != null) {
            Bootstrap::$entityManager->persist($ligneColis);
            Bootstrap::$entityManager->flush();
            return $ligneColis;
        }
    }
}
