<?php

namespace BonSortie;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class LigneSortieQueries {
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
        $this->classString = 'BonSortie\LigneSortie';
    }

   
    public function insert($sortie) {
        if ($sortie != null) {
                Bootstrap::$entityManager->persist($sortie);
            Bootstrap::$entityManager->flush();
            return $sortie;
        }
    }

}
