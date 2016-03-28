<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ColisageQueries {
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
        $this->classString = 'Colisage\Colisage';
    }

   
    public function insert($colisage) {
        if ($colisage != null) {
            if ($colisage->getId() != null){
                Bootstrap::$entityManager->merge($colisage);
            }
            else {
                Bootstrap::$entityManager->persist($colisage);
            }
            Bootstrap::$entityManager->flush();
            return $colisage;
        }
    }
 
   public function findById($colisageId) {
        if ($colisageId != null) {
                return Bootstrap::$entityManager->find('Produit\Colisage', $colisageId);
        }
    }
    
    public function getEntityManager() {
        return $this->entityManager;
    }
   
    public function verifieColisage($produitId, $quantite, $codeUsine) {
        $sql = 'SELECT id FROM colisage WHERE quantiteParCarton='.$quantite.' AND produitId='.$produitId.' AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if ($stock != null)
            return $stock[0];
        else
            return null;
    }
    public function getNombreCartonColisage($produitId, $quantite, $codeUsine) {
        $sql = 'SELECT nombreCarton FROM colisage WHERE quantiteParCarton='.$quantite.' AND produitId='.$produitId.' AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if ($stock != null)
            return $stock[0];
        else
            return null;
    }
    
    
     public function misAjourColis($produitId, $quantite, $nombreCarton, $codeUsine) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton + $nombreCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite and codeUsine='$codeUsine'");
    }
    
}
