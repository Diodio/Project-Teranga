<?php

namespace Achat;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class LigneAchatQueries {
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
        $this->classString = 'Achat\LigneAchat';
    }

   
    public function insert($produit) {
        if ($produit != null) {
                Bootstrap::$entityManager->persist($produit);
            Bootstrap::$entityManager->flush();
            return $produit;
        }
    }

}
