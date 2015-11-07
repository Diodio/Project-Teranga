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
                    $bonSortieTab['nb'] = $validBonSortie;
                else
                    $bonSortieTab['nb'] = 0;
                if ($nonValidBonSortie != null)
                    $bonSortieTab['nb'] = $nonValidBonSortie;
                else
                    $bonSortieTab['nb']= 0;
                if ($bonSortieAnnuler != null)
                    $bonSortieTab['nb'] = $bonSortieAnnuler;
                else
                    $bonSortieTab['nb'] = 0;
                
               
            return $bonSortieTab;
        } else
            return 0;
    }
    
    public function findBonSortieDetails($bonSortieId) {
        if ($bonSortieId != null) {
            $bonSortie = $this->bonSortieQuery->findBonSortieDetails($bonSortieId);
            $ligneBonSortie = $this->bonSortieQuery->findAllProduitByAchact($bonSortieId);
            $bonSortieDetail = array();
            foreach ($bonSortie as $key => $value) {
               // $bonSortieDetail ['id'] = $value ['sortie.id'];
                $bonSortieDetail ['numero'] = $value ['numero'];
                $bonSortieDetail ['dateBonSortie']  = date_format(date_create($value ['dateBonSortie']), 'd/m/Y');
                $bonSortieDetail ['nomMareyeur']  = $value ['nom'];
                $bonSortieDetail ['adresse']  =  $value ['adresse'];
                $bonSortieDetail ['user']  =  $value ['login'];
                $bonSortieDetail ['poidsTotal']  =  $value ['poidsTotal'];
                $bonSortieDetail ['montantTotal']  =  $value ['montantTotal'];
                $bonSortieDetail['ligneBonSortie'] = $ligneBonSortie;
            }
            return $bonSortieDetail;
        }
        else
            return null;
    }
}
