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
        $connexion->executeUpdate("UPDATE colisage  SET nombreCarton = nombreCarton - $nbCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite and codeUsine='$codeUsine'");
    }
    
     public function dimunieSortieNbColis($produitId, $quantite, $nbCarton, $codeUsineDestination ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton - $nbCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite and codeUsine='$codeUsineDestination'");
    }
    
    public function misAjourColisSortieOrigine($produitId, $quantite, $nbCarton, $codeUsineOrigine ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton + $nbCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite and codeUsine='$codeUsineOrigine'");
    }
    
     public function misAjourColisDestination($produitId, $quantite, $nbCarton, $codeUsine ) {			
        $connexion=  Bootstrap::$entityManager->getConnection();
        $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton + $nbCarton WHERE produitId = $produitId AND quantiteParCarton=$quantite and codeUsine='$codeUsine'");
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
        return $connexion->executeUpdate("DELETE FROM carton WHERE id=$colisId");
    }
    
    public function getAllColisBonSortie($bonsortieId, $produitId) {
            $sql = 'SELECT nombreCarton as nbCarton,quantiteParCarton FROM ligne_colis_bonsortie WHERE bonsortie_id='.$bonsortieId.' and produit_id=' . $produitId . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] ['nbCarton'] = $value ['nbCarton'];
            $arrayContact [$i] ['quantiteParCarton'] = $value ['quantiteParCarton'];
            $i ++;
        }
        return $arrayContact;
    }
    
    public function verifieColisage($produitId, $quantite, $codeUsineOrigine) {
        $sql = 'SELECT id FROM carton WHERE quantiteParCarton='.$quantite.' AND produitId='.$produitId.' AND codeUsine="'.$codeUsineOrigine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $stock = $stmt->fetchAll();
        if ($stock != null)
            return $stock[0];
        else
            return null;
    }
}
