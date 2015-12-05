<?php

namespace Achat;
use Achat\AchatQueries as AchatQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class AchatManager {

    private $achatQuery;
   

    public function __construct() {
        $this->achatQuery = new AchatQueries();
    }
    
    public function insert($achat) {
        $this->achatQuery->insert($achat);
    	return $achat;
    }
    
    public function listAll() {
    	$this->achatQuery=$this->achatQuery->findAll();
    	return $this->achatQuery;
    }


   public function findById($produitId) {
       return $this->achatQuery->findById($produitId);
    }
   
    
    public function findTypeAchatById($typeproduitId) {
        return $this->achatQuery->findTypeAchatById($typeproduitId);
    }

    
    public function retrieveAll($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->achatQuery->retrieveAll($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }

    
    public function retrieveAllReglements($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->achatQuery->retrieveAllReglements($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function count($codeUsine,$where="") {
        return $this->achatQuery->count($codeUsine,$where);
    }

   
    public function countReglement($codeUsine,$where="") {
        return $this->achatQuery->countReglements($codeUsine,$where);
    }
    
    public function validAchat($achatId) {
        return $this->achatQuery->validAchat($achatId);
    }
    public function annulerAchat($achatId) {
        return $this->achatQuery->annulerAchat($achatId);
    }
public function getLastNumberAchat() {
    $lastAchatId=$this->achatQuery->getLastNumberAchat();
    if($lastAchatId !=null){
    if(strlen($lastAchatId)==1) $lastAchatId="0000".$lastAchatId;
    else if(strlen($lastAchatId)==2) $lastAchatId="000".$lastAchatId;
    else if(strlen($lastAchatId)==3) $lastAchatId="00".$lastAchatId;
    else if(strlen($lastAchatId)==4) $lastAchatId="0".$lastAchatId;
    }
    else
        $lastAchatId="00001";
    return $lastAchatId;
}

public function findStatisticByUsine($codeUsine) {
        if ($codeUsine != null) {
            $validAchat = $this->achatQuery->findValidAchatByUsine($codeUsine);
            $nonValidAchat = $this->achatQuery->findNonValidAchatByUsine($codeUsine);
            $achatAnnuler = $this->achatQuery->findAchatAnnulerByUsine($codeUsine);
            $achatTab = array();
                if ($validAchat != null)
                    $achatTab['nbValid'] = $validAchat;
                else
                    $achatTab['nbValid'] = 0;
                if ($nonValidAchat != null)
                    $achatTab['nbNonValid'] = $nonValidAchat;
                else
                    $achatTab['nbNonValid']= 0;
                if ($achatAnnuler != null)
                    $achatTab['nbAnnule'] = $achatAnnuler;
                else
                    $achatTab['nbAnnule'] = 0;
                
               
            return $achatTab;
        } else
            return 0;
    }
    
    public function findStatisticReglementByUsine($codeUsine) {
        if ($codeUsine != null) {
            $regle = $this->achatQuery->findRegleByUsine($codeUsine);
            $nonRegle = $this->achatQuery->findNonRegleByUsine($codeUsine);
            $achatAnnuler = $this->achatQuery->findRegleAnnuleByUsine($codeUsine);
            $achatTab = array();
                if ($regle != null)
                    $achatTab['nbRegle'] = $regle;
                else
                    $achatTab['nbRegle'] = 0;
                if ($nonRegle != null)
                    $achatTab['nbNonRegle'] = $nonRegle;
                else
                    $achatTab['nbNonRegle']= 0;
                if ($achatAnnuler != null)
                    $achatTab['nbAnnule'] = $achatAnnuler;
                else
                    $achatTab['nbAnnule'] = 0;
                
               
            return $achatTab;
        } else
            return 0;
    }
    
    public function findAchatDetails($achatId) {
        if ($achatId != null) {
            $achat = $this->achatQuery->findAchatDetails($achatId);
            $ligneAchat = $this->achatQuery->findAllProduitByAchact($achatId);
            $achatDetail = array();
            foreach ($achat as $key => $value) {
               // $achatDetail ['id'] = $value ['achat.id'];
                $achatDetail ['numero'] = $value ['numero'];
                $achatDetail ['dateAchat']  = date_format(date_create($value ['dateAchat']), 'd/m/Y');
                $achatDetail ['nomMareyeur']  = $value ['nom'];
                $achatDetail ['adresse']  =  $value ['adresse'];
                $achatDetail ['user']  =  $value ['login'];
                $achatDetail ['poidsTotal']  =  $value ['poidsTotal'];
                $achatDetail ['montantTotal']  =  $value ['montantTotal'];
                $achatDetail ['regle']  =  $value ['regle'];
                $achatDetail ['reliquat']  =  $value ['reliquat'];
                $achatDetail['ligneAchat'] = $ligneAchat;
            }
            return $achatDetail;
        }
        else
            return null;
    }
    /**
     * 
     * @param type $achatId
     * @return type
     * Cette fonction pernmet de recuperer les informations de l'achat pour la validation et l'ajout du stock
     */
    public function ajoutStockParAchact($achatId) {
        $achat = $this->achatQuery->findInfoByAchact($achatId);
        foreach ($achat as $key => $value) {
            $stockManager = new \Produit\StockManager();
            $stockManager->updateNbStock($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
        }
    }
    
    public function annulerStockParAchact($achatId) {
        $achat = $this->achatQuery->findInfoByAchact($achatId);
        foreach ($achat as $key => $value) {
            $stockManager = new \Produit\StockManager();
            $stockManager->destockage($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
        }
    }

}
