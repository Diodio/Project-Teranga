<?php

namespace Empotage;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class LigneEmpotageQueries {
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

   
    public function insert($ligneEmpotage) {
        if ($ligneEmpotage != null) {
            Bootstrap::$entityManager->persist($ligneEmpotage);
            Bootstrap::$entityManager->flush();
            return $ligneEmpotage;
        }
    }
    
    public function update($ligneEmpotage) {
        if ($ligneEmpotage != null) {
            Bootstrap::$entityManager->merge($ligneEmpotage);
            Bootstrap::$entityManager->flush();
            return $ligneEmpotage;
        }
    }
    
    public function findById($ligneFactureId) {
            if ($ligneFactureId != null) {
                    return Bootstrap::$entityManager->find('Empotage\LigneEmpotage', $ligneFactureId);
            }
    }
}
