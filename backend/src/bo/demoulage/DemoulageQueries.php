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
            if ($demoulage->getId() != null){
                Bootstrap::$entityManager->merge($demoulage);
            }
            else {
                Bootstrap::$entityManager->persist($demoulage);
            }
            Bootstrap::$entityManager->flush();
            return $demoulage;
        }
    }
 
    
  public function verifieDemoulage($produitId, $codeUsine) {
        $sql = 'SELECT id FROM demoulage where produit_id = "'.$produitId.'" and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $demoulage = $stmt->fetchAll();
        if ($demoulage != null)
            return $demoulage[0];
        else
            return null;
    }
    public function getEntityManager() {
        return $this->entityManager;
    }
    
    public function getAllColis($produitId) {
        $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM carton c, demoulage d WHERE d.id=c.demoulage_id AND d.produit_id='.$produitId.' GROUP BY quantiteParCarton';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['nbCarton'];
            $arrayContact [$i] [] = $value ['quantiteParCarton'];
            $i ++;
        }
        return $arrayContact;
    }

}
