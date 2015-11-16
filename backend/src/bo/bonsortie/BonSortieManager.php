<?php

namespace BonSortie;
use BonSortie\BonSortieQueries as BonSortieQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class BonSortieManager {

    private $bonSortieQuery;
   

    public function __construct() {
        $this->bonSortieQuery = new BonSortieQueries();
    }
    
    public function insert($bonSortie) {
        $this->bonSortieQuery->insert($bonSortie);
    	return $bonSortie;
    }
    
    public function listAll() {
    	$this->bonSortieQuery=$this->bonSortieQuery->findAll();
    	return $this->bonSortieQuery;
    }


   public function findById($produitId) {
       return $this->bonSortieQuery->findById($produitId);
    }
   
    
    public function findTypeBonSortieById($typeproduitId) {
        return $this->bonSortieQuery->findTypeBonSortieById($typeproduitId);
    }

    
    public function retrieveAll($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->bonSortieQuery->retrieveAll($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function count($codeUsine,$where="") {
        return $this->bonSortieQuery->count($codeUsine,$where);
    }
    public function validBonSortie($bonSortieId) {
        return $this->bonSortieQuery->validBon($bonSortieId);
    }
    public function annulerBonSortie($bonSortieId) {
        return $this->bonSortieQuery->annulerBon($bonSortieId);
    }
public function getLastNumberBonSortie() {
    $lastBonSortieId=$this->bonSortieQuery->getLastNumberBonSortie();
    if($lastBonSortieId !=null){
    if(strlen($lastBonSortieId)==1) $lastBonSortieId="0000".$lastBonSortieId;
    else if(strlen($lastBonSortieId)==2) $lastBonSortieId="000".$lastBonSortieId;
    else if(strlen($lastBonSortieId)==3) $lastBonSortieId="00".$lastBonSortieId;
    else if(strlen($lastBonSortieId)==4) $lastBonSortieId="0".$lastBonSortieId;
    }
    else
        $lastBonSortieId="00001";
    return $lastBonSortieId;
}

public function findStatisticByUsine($codeUsine) {
        if ($codeUsine != null) {
            $validBonSortie = $this->bonSortieQuery->findValidBonByUsine($codeUsine);
            $nonValidBonSortie = $this->bonSortieQuery->findNonValidBonByUsine($codeUsine);
            $bonSortieAnnuler = $this->bonSortieQuery->findBonAnnulerByUsine($codeUsine);
            $bonSortieTab = array();
                if ($validBonSortie != null)
                    $bonSortieTab['nbValid'] = $validBonSortie;
                else
                    $bonSortieTab['nbValid'] = 0;
                if ($nonValidBonSortie != null)
                    $bonSortieTab['nbNonValid'] = $nonValidBonSortie;
                else
                    $bonSortieTab['nbNonValid']= 0;
                if ($bonSortieAnnuler != null)
                    $bonSortieTab['nbAnnule'] = $bonSortieAnnuler;
                else
                    $bonSortieTab['nbAnnule'] = 0;
                
               
            return $bonSortieTab;
        } else
            return 0;
    }
    
    public function findBonSortieDetails($bonSortieId) {
        if ($bonSortieId != null) {
            $bonSortie = $this->bonSortieQuery->findBonDetails($bonSortieId);
            $ligneBonSortie = $this->bonSortieQuery->findAllProduitByBon($bonSortieId);
            $bonSortieDetail = array();
            foreach ($bonSortie as $key => $value) {
               // $bonSortieDetail ['id'] = $value ['sortie.id'];
                $bonSortieDetail ['numero'] = $value ['numeroBonSortie'];
                $bonSortieDetail ['date']  = date_format(date_create($value ['dateBonSortie']), 'd/m/Y');
                $bonSortieDetail ['nomClient']  = $value ['nom'];
                $bonSortieDetail ['numContainer']  =  $value ['numeroContainer'];
                $bonSortieDetail ['numPlomb']  =  $value ['numeroPlomb'];
                $bonSortieDetail ['numCamion']  =  $value ['numeroCamion'];
                $bonSortieDetail ['chauffeur']  =  $value ['nomChauffeur'];
                $bonSortieDetail ['origine']  =  $value ['origine'];
                $bonSortieDetail ['destination']  =  $value ['destination'];
                $bonSortieDetail ['poidsTotal']  =  $value ['poidsTotal'];
                $bonSortieDetail ['user']  =  $value ['login'];
                $bonSortieDetail['ligneBonSortie'] = $ligneBonSortie;
            }
            return $bonSortieDetail;
        }
        else
            return null;
    }
    
     /**
     * 
     * @param type $achatId
     * @return type
     * Cette fonction pernmet de recuperer les informations de l'achat pour la validation et la dimunition du stock
     */
    public function dimunieStockParBonSortie($sortieId) {
        $sortie = $this->bonSortieQuery->findInfoByBonSortie($sortieId);
        foreach ($sortie as $key => $value) {
            $stockManager = new \Produit\StockManager();
            $stockManager->destockage($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
        }
    }
    
    public function listbonValid() {
        $sorties = $this->bonSortieQuery->listbonValid();
//        $list = array();
//        $i = 0;
//        foreach ($sorties as $key => $value) {
//            $list [$i]['value'] = $value ['id'];
//            $list [$i]['text'] = $value ['numero'];
//            $i++;
//        }
        return $sorties;
    }
    
     public function findInfoColisages($colisageId) {
        $colisages = $this->bonSortieQuery->findInfoColisages($colisageId);
        $list = array();
        foreach ($colisages as $key => $value) {
            $ligneBonSortie = $this->bonSortieQuery->findAllProduitByBon($value ['bid']);
            $list ['nomClient'] = $value ['nom'];
            $list ['origine'] = $value ['origine'];
            $list ['poidsTotal'] = $value ['poidsTotal'];
            $list ['ligneBonSortie'] = $ligneBonSortie;
        }
        return $list;
    }
}
