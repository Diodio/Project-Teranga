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
    public function insert($demoulage, $jsonCarton) {
        $listCarton=null;
        $listColisage=null;
        if($demoulage !=null){
        if($jsonCarton!=NULL){
           
                foreach ($jsonCarton as $key => $ligneCarton) {
                    if (isset($ligneCarton["nbCarton"])) {
                        $carton = new \Produit\Carton();
                        $carton->setDemoulage($demoulage);
                        $carton->setCodeUsine($demoulage->getCodeUsine());
                        $carton->setNombreCarton($ligneCarton['nbCarton']);
                        $carton->setQuantiteParCarton($ligneCarton['qte']);
                        $carton->setTotal($ligneCarton['total']);
                        $carton->setProduitId($demoulage->getProduit()->getId());
                        $listCarton[]=$carton;
                        $colisageManager=new ColisageManager();
                        
                        $colisageId=$colisageManager->verifieColisage($demoulage->getProduit()->getId(), $ligneCarton['qte'], $demoulage->getCodeUsine());
                        
                        $colisage = new \Produit\Colisage(); 
                        
                        if($colisageId!=0){
                            $colisage=$colisageManager->findById($colisageId);
                            $colisage->setId($colisageId);
                            $nb=$colisage->getNombreCarton();
                            $nombreCarton=$ligneCarton['nbCarton']+$nb;
                        }
                        else {
                           $nombreCarton=$ligneCarton['nbCarton'];
                        }
                        $colisage->setNombreCarton($nombreCarton);
                        $colisage->setProduitId($demoulage->getProduit()->getId());
                        $colisage->setQuantiteParCarton($ligneCarton['qte']);
                        $colisage->setCodeUsine($demoulage->getCodeUsine());
                        $listColisage[]=$colisage;
                    }
        }
        return $this->demoulageQueries->insert($demoulage, $listCarton, $listColisage);
        }
        }
    	return NULL;
    }
    public function getAllColis($produitId, $codeUsine) {
        return $this->demoulageQueries->getAllColis($produitId, $codeUsine);
    }
    
   
    
    public function getAllColisDemoulage($demoulageId, $codeUsine) {
        return $this->demoulageQueries->getAllColisDemoulage($demoulageId, $codeUsine);
    }
     public function getQuantiteColisage($produitId, $codeUsine) {
        return $this->demoulageQueries->getQuantiteColisage($produitId, $codeUsine);
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
    
    public function getNbColis($produitId, $codeUsine) {
        return $this->demoulageQueries->getNbColis($produitId, $codeUsine);
    }
    
    public function verificationColisage($produitId, $nbCarton, $quantite, $codeUsine) {
        $res = 0;
        $carton = $this->demoulageQueries->verifieColisage($produitId, $nbCarton, $quantite, $codeUsine);
        if ($carton != null) {
            $res = 1;
        }
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
            $arrayDemoulages [$i] [] = $value ['quantiteAvantDemoulage'] ;
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
    
    public function retrieveAllAnnules($status,$codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
    	$demoulage = $this->demoulageQueries->retrieveAllAnnules($status,$codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    	$arrayDemoulages = array();
    	$i = 0;
    	foreach ($demoulage as $key => $value) {
    		$arrayDemoulages [$i] [] = $value ['demoulageId'];
    		$arrayDemoulages [$i] [] = $value ['status'];
    		$arrayDemoulages [$i] [] = $value ['date'];
    		$arrayDemoulages [$i] [] = $value ['numero'];
    		$arrayDemoulages [$i] [] = $value ['libelle'];
    		$arrayDemoulages [$i] [] = $value ['quantiteAvantDemoulage'] ;
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
    
    
    public function annulerParDemoulagId($demoulageId) {
        $stockManager = new \Stock\StockManager();
        $demou = $this->demoulageQueries->findById($demoulageId);
        if ($demou->getStatus() == 1) {
            $codeUsine=$demou->getCodeUsine();
            $produitId=$demou->getProduit()->getId();
            $quantiteDemoulee=$demou->getQuantiteDemoulee();
            if($produitId!==NULL && $quantiteDemoulee!==NULL){
           // $stockManager->updateNbStock($produitId, $codeUsine, $quantiteDemoulee);
           // $stockManager->destockageReel($produitId, $codeUsine, $quantiteDemoulee);
            //$infoStocks = $this->demoulageQueries->findInfoStockByDemoulage($demoulageId);
            
            $infoColis = $this->demoulageQueries->findInfoColisByDemoulage($demoulageId);
            $demou = $this->annulerDemoulageId($demoulageId,$produitId, $codeUsine, $quantiteDemoulee, $infoColis);
//            if ($infoColis != NULL) {
//                foreach ($infoColis as $key => $value) {
//                    $this->demoulageQueries->diminueCartonParDemoulageId($demoulageId, $value ['produitId'], $value ['nombreCarton'], $value ['quantiteParCarton'], $codeUsine);
//                }
//            }
            }
            //$this->annulerDemoulageId($demoulageId);
        }
        return $demou;
    }
    public function annulerDemoulageId($demoulageId,$produitId, $codeUsine, $quantiteDemoulee, $infoColis) {
        return $this->demoulageQueries->annulerDemoulageId($demoulageId,$produitId, $codeUsine, $quantiteDemoulee, $infoColis);
    }
}
