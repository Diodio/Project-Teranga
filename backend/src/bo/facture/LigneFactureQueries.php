<?php

namespace Facture;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class LigneFactureQueries {
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
        
    }

   
    public function insert($ligneFacture) {
        if ($ligneFacture != null) {
            Bootstrap::$entityManager->persist($ligneFacture);
            Bootstrap::$entityManager->flush();
            return $ligneFacture;
        }
    }
    
    public function findById($ligneFactureId) {
            if ($ligneFactureId != null) {
                    return Bootstrap::$entityManager->find('Facture\LigneFacture', $ligneFactureId);
            }
    }
}
