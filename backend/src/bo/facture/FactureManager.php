<?php

namespace Facture;
use Facture\FactureQueries as FactureQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class FactureManager {

    private $factureQuery;
   

    public function __construct() {
        $this->factureQuery = new FactureQueries();
    }
    
    public function insert($facture) {
        $this->factureQuery->insert($facture);
    	return $facture;
    }
    
    public function update($facture, $listLigneFacture) {
       return $this->factureQuery->update($facture, $listLigneFacture);
    }
    public function listAll() {
    	$this->factureQuery=$this->factureQuery->findAll();
    	return $this->factureQuery;
    }


   public function findById($produitId) {
       return $this->factureQuery->findById($produitId);
    }
   
    
    public function findTypeFactureById($typeproduitId) {
        return $this->factureQuery->findTypeFactureById($typeproduitId);
    }

    
    public function retrieveAll($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->factureQuery->retrieveAll($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function retrieveAllFactureAnnules($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
    	return $this->factureQuery->retrieveAllFactureAnnules($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }

   public function retrieveAllReglements($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->factureQuery->retrieveAllReglements($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function count($codeUsine,$where="") {
        return $this->factureQuery->count($codeUsine,$where);
    }
    
    public function countFactureAnnules($codeUsine,$where="") {
        return $this->factureQuery->countFactureAnnules($codeUsine,$where);
    }
    
    public function validFacture($factureId) {
        return $this->factureQuery->validFacture($factureId);
    }
    public function annulerFacture($factureId) {
        $facture= $this->factureQuery->findById($factureId);
        $nbTotalColis=$facture->getNbTotalColis();
        $nbTotalPoids=$facture->getNbTotalPoids();
        $codeUsine=$facture->getCodeUsine();
        $ligneFacture = $this->factureQuery->findInfoByFacture($factureId);
        foreach ($ligneFacture as $key => $value) {
            $stockManager = new \Stock\StockManager();
            $stockManager->updateNbStockReel($value ['produit'], $codeUsine, $value ['quantite']);
            $stockManager->deleteStockFacturee($factureId, $value ['produit']);
        }
        $infosColis = $this->factureQuery->findColisageByFactureId($factureId);
        foreach ($infosColis as $key => $value) {
            $colisManager = new \Produit\ColisageManager();
            $isExist = $colisManager->verifieColisage($value ['produitId'], $value ['quantiteParCarton'],$codeUsine);
            if($isExist !==0)
                $colisManager->misAjourColis($value ['produitId'], $value ['quantiteParCarton'], $value ['nombreCarton'], $codeUsine);
            else{
                 $colisage = new \Produit\Colisage();
                $colisage->setNombreCarton($value ['nombreCarton']);
                $colisage->setQuantiteParCarton($value ['quantiteParCarton']);
                $colisage->setProduitId($value ['produitId']);
                $colisage->setCodeUsine($codeUsine);
                $colisManager->insert($colisage);
            }
                
        }
        $this->factureQuery->annulerFacture($factureId);
    }
public function getLastNumberFacture() {
    $lastFactureId=$this->factureQuery->getLastNumberFacture();
    if($lastFactureId !=null){
    if(strlen($lastFactureId)==1) $lastFactureId="0000".$lastFactureId;
    else if(strlen($lastFactureId)==2) $lastFactureId="000".$lastFactureId;
    else if(strlen($lastFactureId)==3) $lastFactureId="00".$lastFactureId;
    else if(strlen($lastFactureId)==4) $lastFactureId="0".$lastFactureId;
    }
    else
        $lastFactureId="00001";
    return $lastFactureId;
}

public function findStatisticByUsine($codeUsine) {
        if ($codeUsine != null) {
            $validFacture = $this->factureQuery->findValidFactureByUsine($codeUsine);
            $nonValidFacture = $this->factureQuery->findNonValidFactureByUsine($codeUsine);
            $factureAnnuler = $this->factureQuery->findFactureAnnulerByUsine($codeUsine);
            $factureTab = array();
                if ($validFacture != null)
                    $factureTab['nbValid'] = $validFacture;
                else
                    $factureTab['nbValid'] = 0;
                if ($nonValidFacture != null)
                    $factureTab['nbNonValid'] = $nonValidFacture;
                else
                    $factureTab['nbNonValid']= 0;
                if ($factureAnnuler != null)
                    $factureTab['nbAnnule'] = $factureAnnuler;
                else
                    $factureTab['nbAnnule'] = 0;
                
               
            return $factureTab;
        } else
            return 0;
    }
    
    public function findStatisticReglementByUsine($codeUsine) {
        if ($codeUsine != null) {
            $regle = $this->factureQuery->findRegleByUsine($codeUsine);
            $nonRegle = $this->factureQuery->findNonRegleByUsine($codeUsine);
            $actureAnnuler = $this->factureQuery->findARegleByUsine($codeUsine);
            $achatTab = array();
                if ($regle != null)
                    $achatTab['nbRegle'] = $regle;
                else
                    $achatTab['nbRegle'] = 0;
                if ($nonRegle != null)
                    $achatTab['nbNonRegle'] = $nonRegle;
                else
                    $achatTab['nbNonRegle']= 0;
                if ($actureAnnuler != null)
                    $achatTab['nbAnnule'] = $actureAnnuler;
                else
                    $achatTab['nbAnnule'] = 0;
                
               
            return $achatTab;
        } else
            return 0;
    }
    public function findFactureDetails($factureId) {
        if ($factureId != null) {
            $facture = $this->factureQuery->findFactureDetails($factureId);
             $ligneFacture = $this->factureQuery->findAllProduitByFacture($factureId);
             $colis = $this->factureQuery->findColisByFacture($factureId);
             $reglement = $this->factureQuery->findReglementByFacture($factureId);
             $conteneurs = $this->factureQuery->findConteneurByFacture($factureId);
            $factureDetail = array();
            foreach ($facture as $key => $value) {
               // $factureDetail ['id'] = $value ['achat.id'];
                $factureDetail ['numero'] = $value ['numero'];
                $factureDetail ['dateFacture']  = date_format(date_create($value ['dateFacture']), 'd/m/Y');
                $factureDetail ['nomClient']  = $value ['nom'];
                $factureDetail ['adresse']  =  $value ['adresse'];
                $factureDetail ['pays']  =  $value ['pays'];
                $factureDetail ['devise']  =  $value ['devise'];
                $userManager = new \Utilisateur\UtilisateurManager();
                $user = $userManager->findByLogin($value ['login'],$value ['codeUsine']);
                $factureDetail ['user']  =  $user;
                $factureDetail ['nbTotalColis']  =  $value ['nbTotalColis'];
                $factureDetail ['nbTotalPoids']  =  $value ['nbTotalPoids'];
                $factureDetail ['montantHt']  =  $value ['montantHt'];
                $factureDetail ['montantTtc']  =  $value ['montantTtc'];
                $factureDetail ['modePaiement']  =  $value ['modePaiement'];
                $factureDetail ['numCheque']  =  $value ['numCheque'];
                $factureDetail ['datePaiement']  =  $value ['datePaiement'];
                $factureDetail ['inconterm']  =  $value ['inconterm'];
                $factureDetail ['regle']  =  $value ['regle'];
                $factureDetail ['portDechargement']  =  $value ['portDechargement'];
                $factureDetail['colis'] = $colis;
                $factureDetail['ligneFacture'] = $ligneFacture;
                $factureDetail['reglement'] = $reglement;
                $factureDetail['conteneurs'] = $conteneurs;
                
            }
            return $factureDetail;
        }
        else
            return null;
    }
    
    public function getTotalReglementByFacture($factureId) {
        $som=0;
        $facture=$this->factureQuery->getTotalReglementByFacture($factureId);
        if($facture['sommeAvance'] !=NULL)
            $som=$facture['sommeAvance'];
        return $som;
    }
    
    public function modifReglement($factureId, $status) {
        return $this->factureQuery->modifReglement($factureId, $status);
    }
    /**
     * 
     * @param type $factureId
     * @return type
     * Cette fonction pernmet de recuperer les informations de l'achat pour la validation et l'ajout du stock
     */
    public function ajoutStockParAchact($factureId) {
        $facture = $this->factureQuery->findInfoByAchact($factureId);
        foreach ($facture as $key => $value) {
            $stockManager = new \Produit\StockManager();
            $stockManager->updateNbStock($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
        }
    }
    
    public function findStatisticAnnuleByUsine($codeUsine) {
    	if ($codeUsine != null) {
    		//$validFacture = $this->factureQuery->findValidFactureByUsine($codeUsine);
    		//$nonValidFacture = $this->factureQuery->findNonValidFactureByUsine($codeUsine);
    		$factureAnnuler = $this->factureQuery->findFactureAnnulerByUsine($codeUsine);
    		$factureTab = array();
    		if ($factureAnnuler != null)
    			$factureTab['nbAnnule'] = $factureAnnuler;
    		else
    			$factureTab['nbAnnule'] = 0;
    
    		 
    		return $factureTab;
    	} else
    		return 0;
    }
    
    public function getInfoInventaire($clientId,$typeFacture, $dateDebut, $dateFin, $codeUsine) {
    	$infosP = $this->factureQuery->getInfoPoidsTotal($clientId,$typeFacture, $dateDebut, $dateFin, $codeUsine);
    	$infosM = $this->factureQuery->getInfoMontantTotal($clientId,$typeFacture, $dateDebut, $dateFin, $codeUsine);
    	$infosTab = array();
    	//var_dump($infos);
    	if ($infosP != null && $infosM !=null) {
    		if($infosM['montantTotal'] !=null)
    			$infosTab['montantTotal'] = $infosM['montantTotal'];
    		else
    			$infosTab['montantTotal'] = 0.00;
    		if($infosP['poidsTotal'] !=null)
    			$infosTab['poidsTotal'] = $infosP['poidsTotal'];
    		else
    			$infosTab['poidsTotal'] = 0.00;
    	}
    	else {
    		$infosTab['poidsTotal'] =0.00;
    		$infosTab['montantTotal'] =0.00;
    	}
    
    	return $infosTab;
    }
    
    public function retrieveFactureInventaire($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
    	return $this->factureQuery->retrieveFactureInventaire($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function countInventaires($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $where = "") {
        return $this->factureQuery->countInventaires($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $where);
    }
}
