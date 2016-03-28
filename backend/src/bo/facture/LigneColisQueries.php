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
    public function dimunieNbColis($produitId, $quantite, $nbCarton ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton - $nbCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite");
       // $this->recupereColisFini($produitId, $quantite, $nbCarton);
    }
    public function dimunieColisFacturee($produitId, $quantite, $nbCarton,$codeUsine ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton - $nbCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite and codeUsine='$codeUsine'");
       // $this->recupereColisFini($produitId, $quantite, $nbCarton);
    }
    
    public function recupereColisFini($produitId, $quantite, $nbCarton ) { 
        $sql = "SELECT id,nombreCarton FROM colisage WHERE nombreCarton=0 AND produitId = $produitId AND quantiteParCarton=$quantite";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colis = $stmt->fetchAll();
        foreach ($colis as $key => $value) {
            if($value ['nombreCarton'] == 0)
               $this->supprimeNbColis ($value ['id']) ;
        }
    }
    public function supprimeNbColis($colisId ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("DELETE FROM colisage WHERE id=$colisId");
    }
    
}
