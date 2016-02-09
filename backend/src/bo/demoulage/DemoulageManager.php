<?php

namespace Produit;
use Produit\DemoulageQueries as DemoulageQueries;



class DemoulageManager {

    private $demoulageQueries;

    public function __construct() {
        $this->demoulageQueries = new DemoulageQueries();
    }
        
    
public function verifieDemoulage($produitId, $codeUsine) {
      $demoulage=$this->demoulageQueries->verifieDemoulage($produitId, $codeUsine);
      if($demoulage!=null)
        return $demoulage['id'];
    return 0;
  }
    public function insert($demoulage) {
        $this->demoulageQueries->insert($demoulage);
    	return $demoulage;
    }
    public function getAllColis($produitId, $codeUsine) {
        return $this->demoulageQueries->getAllColis($produitId, $codeUsine);
    }
    
    public function getAllColisDemoulage($demoulageId, $codeUsine) {
        return $this->demoulageQueries->getAllColisDemoulage($demoulageId, $codeUsine);
    }
     public function getQuantiteColisage($produitId) {
        return $this->demoulageQueries->getQuantiteColisage($produitId);
    }
    
public function verificationColis($produitId, $nbCarton, $quantite) {
        $res = 0;
        $carton = $this->demoulageQueries->verifieCarton($produitId, $quantite);
        if ($carton != null) {
            foreach ($carton as $key => $value) {
                if ($value ['nbCarton'] >= $nbCarton)
                    $res = 1;
                else {
                    $res = 0;
                }
            }
        }
        else
            $res=0;

        return $res;
    }

    public function retrieveAll($status,$codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
    	$demoulage = $this->demoulageQueries->retrieveAll($status,$codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    	$arrayDemoulages = array();
    	$i = 0;
    	foreach ($demoulage as $key => $value) {
            $arrayDemoulages [$i] [] = $value ['demoulageId'];
            $arrayDemoulages [$i] [] = $value ['status'];
            $arrayDemoulages [$i] [] = $value ['date'];
            $arrayDemoulages [$i] [] = $value ['numero'];
            $arrayDemoulages [$i] [] = $value ['libelle'];
            $arrayDemoulages [$i] [] = $value ['quantiteAdemouler'];
            $arrayDemoulages [$i] [] = $value ['quantiteDemoulee'];
            if($value ['nbColis'] !=null)
                $arrayDemoulages [$i] [] = $value ['nbColis'];
            else $arrayDemoulages [$i] [] = 0;
            $arrayDemoulages [$i] [] = $value ['demoulageId'];
//    		$colis=$this->demoulageQueries->getAllColis($value ['produitId'], $value ['codeUsine']);
//    		$arrayDemoulages [$i] []=$colis;
    		
    		$i++;
    	}
    	return $arrayDemoulages;
    }
    public function getLastNumber() {
    $lastNumero=$this->demoulageQueries->getLastNumber();
    if($lastNumero !=null){
    if(strlen($lastNumero)==1) $lastNumero="0000".$lastNumero;
    else if(strlen($lastNumero)==2) $lastNumero="000".$lastNumero;
    else if(strlen($lastNumero)==3) $lastNumero="00".$lastNumero;
    else if(strlen($lastNumero)==4) $lastNumero="0".$lastNumero;
    }
    else
        $lastNumero="00001";
    return $lastNumero;
}
    public function countAll($codeUsine,$where="") {
    	return $this->demoulageQueries->countAll($codeUsine,$where);
    }

    public function remove($demoulageId) {
        return $this->demoulageQueries->delete($demoulageId);
    }
    public function annulerDemoulageId($demoulageId) {
        return $this->demoulageQueries->annulerDemoulageId($demoulageId);
    }
    
    public function annulerParDemoulagId($demoulageId) {
        $stockManager = new \Stock\StockManager();
        $demou = $this->demoulageQueries->findById($demoulageId);
        if ($demou->getStatus() == 1) {
            $codeUsine=$demou->getCodeUsine();
            $produitId=$demou->getProduit()->getId();
            $quantiteAdemouler=$demou->getQuantiteAdemouler();
            $quantiteDemoulee=$demou->getQuantiteDemoulee();
            if($produitId!==NULL && $quantiteAdemouler!==NULL && $quantiteDemoulee!==NULL){
            $stockManager->updateNbStock($produitId, $codeUsine, $quantiteAdemouler);
            $stockManager->destockageReel($produitId, $codeUsine, $quantiteDemoulee);
            //$infoStocks = $this->demoulageQueries->findInfoStockByDemoulage($demoulageId);
            $infoColis = $this->demoulageQueries->findInfoColisByDemoulage($demoulageId);
            if ($infoColis != NULL) {
                foreach ($infoColis as $key => $value) {
                    $this->demoulageQueries->diminueCartonParDemoulageId($value ['produitId'], $value ['nombreCarton'], $value ['quantiteParCarton']);
                }
                
                
            }
            }
            $this->annulerDemoulageId($demoulageId);
        }
    }
}
