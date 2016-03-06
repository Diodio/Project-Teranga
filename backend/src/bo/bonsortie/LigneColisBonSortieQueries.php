<?php

namespace BonSortie;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class LigneColisBonSortieQueries {
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
    public function dimunieNbColis($produitId, $quantite, $nbCarton, $codeUsine ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE carton,demoulage  SET nombreCarton = nombreCarton - $nbCarton WHERE demoulage.id=carton.demoulage_id AND produitId = $produitId AND quantiteParCarton=$quantite and carton.codeUsine='$codeUsine'");
    }
    
    public function misAjourColisDestination($produitId, $quantite, $nbCarton, $codeUsine ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE carton,demoulage  SET nombreCarton = nombreCarton + $nbCarton WHERE demoulage.id=carton.demoulage_id AND produitId = $produitId AND quantiteParCarton=$quantite and carton.codeUsine='$codeUsine'");
    }
    public function recupereColisFini($produitId, $quantite, $nbCarton ) {
        $sql = "SELECT id,nombreCarton FROM carton WHERE nombreCarton=0 AND produitId = $produitId AND quantiteParCarton=$quantite";
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
        return $connexion->executeUpdate("DELETE FROM carton WHERE id=$colisId");
    }
    
}
