<?php

namespace Empotage;
use Empotage\EmpotageQueries as EmpotageQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class EmpotageManager {

    private $empotageQuery;
   

    public function __construct() {
        $this->empotageQuery = new EmpotageQueries();
    }
    
      public function insert($empotage,$listConteneur,$jsonProduit,$jsonColis) {
       return $this->empotageQuery->insert($empotage,$listConteneur,$jsonProduit,$jsonColis);
    } 
   
    
    public function update($facture, $listLigneEmpotage) {
       return $this->empotageQuery->update($facture, $listLigneEmpotage);
    }
    public function listAll() {
    	$this->empotageQuery=$this->empotageQuery->findAll();
    	return $this->empotageQuery;
    }


   public function findById($produitId) {
       return $this->empotageQuery->findById($produitId);
    }
   
    
    public function findTypeEmpotageById($typeproduitId) {
        return $this->empotageQuery->findTypeEmpotageById($typeproduitId);
    }

    
    public function retrieveAll($codeUsine,$etat,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->empotageQuery->retrieveAll($codeUsine,$etat,$offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function retrieveAllEmpotageAnnules($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
    	return $this->empotageQuery->retrieveAllEmpotageAnnules($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }

   public function retrieveAllReglements($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->empotageQuery->retrieveAllReglements($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function count($codeUsine,$etat,$where="") {
        return $this->empotageQuery->count($codeUsine,$etat,$where);
    }
    
    public function countEmpotageAnnules($codeUsine,$where="") {
        return $this->empotageQuery->countEmpotageAnnules($codeUsine,$where);
    }
    
    public function validEmpotage($factureId) {
        return $this->empotageQuery->validEmpotage($factureId);
    }
    public function annulerEmpotage($empotageId) {
        $empotage= $this->empotageQuery->findById($empotageId);
        $isBilling=$this->empotageQuery->isBilling($empotageId);
        if($isBilling==NULL){
        $codeUsine=$empotage->getCodeUsine();
        $ligneEmpotage = $this->empotageQuery->findInfoByEmpotage($empotageId);
        foreach ($ligneEmpotage as $key => $value) {
            $stockManager = new \Stock\StockManager();
            $stockManager->updateNbStockReel($value ['produit_id'], $codeUsine, $value ['quantite']);
           // $stockManager->deleteStockEmpotagee($empotageId, $value ['produit']);
        }
        $infosColis = $this->empotageQuery->findColisageByEmpotageId($empotageId);
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
        $this->empotageQuery->annulerEmpotage($empotageId);
        return 1;
        }
    else {
     return 0;
 }
    }
public function getLastNumberEmpotage($codeUsine) {
    $lastEmpotageId=$this->empotageQuery->getLastNumberEmpotage($codeUsine);
    if($lastEmpotageId !=null){
    if(strlen($lastEmpotageId)==1) $lastEmpotageId="0000".$lastEmpotageId;
    else if(strlen($lastEmpotageId)==2) $lastEmpotageId="000".$lastEmpotageId;
    else if(strlen($lastEmpotageId)==3) $lastEmpotageId="00".$lastEmpotageId;
    else if(strlen($lastEmpotageId)==4) $lastEmpotageId="0".$lastEmpotageId;
    }
    else
        $lastEmpotageId="00001";
    return $lastEmpotageId;
}

public function findStatisticByUsine($codeUsine) {
        if ($codeUsine != null) {
            $validEmpotage = $this->empotageQuery->findValidEmpotageByUsine($codeUsine);
            $nonValidEmpotage = $this->empotageQuery->findNonValidEmpotageByUsine($codeUsine);
            $factureAnnuler = $this->empotageQuery->findEmpotageAnnulerByUsine($codeUsine);
            $factureTab = array();
                if ($validEmpotage != null)
                    $factureTab['nbValid'] = $validEmpotage;
                else
                    $factureTab['nbValid'] = 0;
                if ($nonValidEmpotage != null)
                    $factureTab['nbNonValid'] = $nonValidEmpotage;
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
            $regle = $this->empotageQuery->findRegleByUsine($codeUsine);
            $nonRegle = $this->empotageQuery->findNonRegleByUsine($codeUsine);
            $actureAnnuler = $this->empotageQuery->findARegleByUsine($codeUsine);
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
    public function findEmpotageDetails($empotageId) {
        if ($empotageId != null) {
            $facture = $this->empotageQuery->findEmpotageDetails($empotageId);
             $ligneEmpotage = $this->empotageQuery->findAllProduitByEmpotage($empotageId);
             $colis = $this->empotageQuery->findColisByEmpotage($empotageId);
             $conteneurs = $this->empotageQuery->findConteneurByEmpotage($empotageId);
            $empotageDetail = array();
            foreach ($facture as $key => $value) {
               // $factureDetail ['id'] = $value ['achat.id'];
                $empotageDetail ['numero'] = $value ['numero'];
                $empotageDetail ['dateEmpotage']  = date_format(date_create($value ['date']), 'd/m/Y');
                $empotageDetail ['nomClient']  = $value ['nom'];
                $empotageDetail ['adresse']  =  $value ['adresse'];
                $empotageDetail ['pays']  =  $value ['pays'];
                $userManager = new \Utilisateur\UtilisateurManager();
                $user = $userManager->findByLogin($value ['login'],$value ['codeUsine']);
                $empotageDetail ['user']  =  $user;
                $empotageDetail ['nbTotalColis']  =  $value ['nbTotalColis'];
                $empotageDetail ['nbTotalPoids']  =  $value ['nbTotalPoids'];
                $empotageDetail ['portDechargement']  =  $value ['portDechargement'];
                $empotageDetail['colis'] = $colis;
                $empotageDetail['ligneEmpotage'] = $ligneEmpotage;
                $empotageDetail['conteneurs'] = $conteneurs;
                
            }
            return $empotageDetail;
        }
        else
            return null;
    }
    
    public function getTotalReglementByEmpotage($factureId) {
        $som=0;
        $facture=$this->empotageQuery->getTotalReglementByEmpotage($factureId);
        if($facture['sommeAvance'] !=NULL)
            $som=$facture['sommeAvance'];
        return $som;
    }
    
    public function modifReglement($factureId, $status) {
        return $this->empotageQuery->modifReglement($factureId, $status);
    }
    /**
     * 
     * @param type $factureId
     * @return type
     * Cette fonction pernmet de recuperer les informations de l'achat pour la validation et l'ajout du stock
     */
    public function ajoutStockParAchact($factureId) {
        $facture = $this->empotageQuery->findInfoByAchact($factureId);
        foreach ($facture as $key => $value) {
            $stockManager = new \Produit\StockManager();
            $stockManager->updateNbStock($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
        }
    }
    
    public function findStatisticAnnuleByUsine($codeUsine) {
    	if ($codeUsine != null) {
    		//$validEmpotage = $this->factureQuery->findValidEmpotageByUsine($codeUsine);
    		//$nonValidEmpotage = $this->factureQuery->findNonValidEmpotageByUsine($codeUsine);
    		$factureAnnuler = $this->empotageQuery->findEmpotageAnnulerByUsine($codeUsine);
    		$factureTab = array();
    		if ($factureAnnuler != null)
    			$factureTab['nbAnnule'] = $factureAnnuler;
    		else
    			$factureTab['nbAnnule'] = 0;
    
    		 
    		return $factureTab;
    	} else
    		return 0;
    }
    
    public function getInfoInventaire($clientId,$typeEmpotage, $dateDebut, $dateFin, $codeUsine) {
    	$infosP = $this->empotageQuery->getInfoPoidsTotal($clientId,$typeEmpotage, $dateDebut, $dateFin, $codeUsine);
    	$infosM = $this->empotageQuery->getInfoMontantTotal($clientId,$typeEmpotage, $dateDebut, $dateFin, $codeUsine);
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
    
    public function retrieveEmpotageInventaire($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
    	return $this->empotageQuery->retrieveEmpotageInventaire($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function countInventaires($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $where = "") {
        return $this->empotageQuery->countInventaires($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $where);
    }
}
