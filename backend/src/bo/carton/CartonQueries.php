<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class CartonQueries {
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
        $this->classString = 'Carton\Carton';
    }

   
    public function insert($carton) {
        if ($carton != null) {
            if ($carton->getId() != null){
                Bootstrap::$entityManager->merge($carton);
            }
            else {
                Bootstrap::$entityManager->persist($carton);
            }
            Bootstrap::$entityManager->flush();
            return $carton;
        }
    }
 
    public function findColisByProduitId($produitId, $codeUsine, $quantiteParCarton) {
        $sql = 'SELECT id FROM colisage WHERE produitId = "'.$produitId.'" and codeUsine="'.$codeUsine.'" and quantiteParCarton='.$quantiteParCarton.'';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colisageId = $stmt->fetchAll();
        if ($colisageId != null)
            return $colisageId[0];
        else
            return null;
    }
    
    public function findCartonByProduitId($produitId, $codeUsine, $quantite,$nbColis) {
        $sql = 'SELECT id FROM colisage WHERE produitId = "'.$produitId.'" and codeUsine="'.$codeUsine.'" and quantiteParCarton='.$quantite.'';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $cartonId = $stmt->fetchAll();
        if ($cartonId != null)
            return $cartonId[0];
        else
            return null;
    }
    
 
    public function getColisage($produitId, $quantite,$codeUsine, $nbColis) {
            $sql = 'SELECT nombreCarton FROM colisage WHERE produitId='.$produitId.' and quantiteParCarton='.$quantite.' and codeUsine="' .$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colis= $stmt->fetchAll();
        return $colis;
    }
    
    public function getEntityManager() {
        return $this->entityManager;
    }
     public function misAjourColis($produitId, $quantite, $nombreCarton, $codeUsine) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE carton SET nombreCarton = nombreCarton + $nbCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite and codeUsine='$codeUsine' and nombreCarton>='.$nombreCarton.'");
    }
  
    public function verifieColisage($produitId, $quantite, $nombreCarton, $codeUsine) {
        $sql = 'SELECT distinct quantiteParCarton FROM carton WHERE quantiteParCarton='.$quantite.' AND produitId='.$produitId.' AND codeUsine="'.$codeUsine.'" and nombreCarton>='.$nombreCarton.'';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if ($stock != null)
            return $stock[0];
        else
            return null;
    }
}
