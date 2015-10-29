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

   
    public function count($codeUsine,$where="") {
        return $this->achatQuery->count($codeUsine,$where);
    }
    public function validAchat($achatId) {
        $this->achatQuery->pause($achatId);
    }
    
public function getLastNumberAchat() {
    $lastAchatId=$this->achatQuery->getLastNumberAchat();
    if(strlen($lastAchatId)==1) $lastAchatId="0000".$lastAchatId;
    else if(strlen($lastAchatId)==2) $lastAchatId="000".$lastAchatId;
    else if(strlen($lastAchatId)==3) $lastAchatId="00".$lastAchatId;
    else if(strlen($lastAchatId)==4) $lastAchatId="0".$lastAchatId;
    return $lastAchatId;
}

}
