<?php

namespace Inventaire;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class InventaireQueries {
    /*
     *
     */

    private $entityManager;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
    }

    public function getInfoMontantTotal($dateDebut, $dateFin, $codeUsine) {
    	if($dateDebut=='')
    		$dateDebut="1900-01-01";
    	if($dateFin=="")
    		$dateFin="2900-01-01";
    	if($dateDebut=="")
    		$dateDebut="1900-01-01";
    	if($dateFin=="")
    		$dateFin="2900-01-01";
         $sqlClients="";
        if($clientId!="*"){
            $sqlClients.=" and client_id=$clientId";
        }
    	if($typeFacture=='*')
    		$sql = 'SELECT SUM(montantHt) montantTotal FROM facture f WHERE status=1 and montantHt<>0.00 AND nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'" '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ';
    	else
    		$sql = 'SELECT SUM(rf.avance) montantTotal FROM reglement_facture rf, facture f WHERE status=1 and facture_id=f.id AND regle='.$typeFacture.' and montantHt<>0.00 and rf.avance<>0 AND nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'"  '.$sqlClients.'  and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$infos = $stmt->fetch();
    	return $infos;
    }
}
