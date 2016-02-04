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

   
    public function insert($ligneAchat) {
        if ($ligneAchat != null) {
                Bootstrap::$entityManager->persist($ligneAchat);
                Bootstrap::$entityManager->flush();
            return $ligneAchat;
        }
    }

    public function update($ligneAchat) {
        if ($ligneAchat != null) {
                Bootstrap::$entityManager->merge($ligneAchat);
                Bootstrap::$entityManager->flush();
            return $ligneAchat;
        }
    }
    
    public function findById($ligneAchatId) {
        if ($ligneAchatId != null) {
            return Bootstrap::$entityManager->find('Achat\LigneAchat', $ligneAchatId);
        }
    }

}
