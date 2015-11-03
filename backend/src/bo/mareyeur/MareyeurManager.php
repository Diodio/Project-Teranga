<?php

namespace Mareyeur;
use Mareyeur\MareyeurQueries as MareyeurQueries;



class MareyeurManager {

    private $mareyeurQuery;
   

    public function __construct() {
        $this->mareyeurQuery = new MareyeurQueries();
    }
    
    public function insert($mareyeur) {
        return $this->mareyeurQuery->insert($mareyeur);
    }
    public function update($mareyeur) {
        return $this->mareyeurQuery->insert($mareyeur);
    }
     public function findById($mareyeurId) {
         return $this->mareyeurQuery->findById($mareyeurId);
     }
    public function listAll() {
    	$this->mareyeurQuery=$this->mareyeurQuery->findAll();
    	return $this->mareyeurQuery;
    }
   

 
    public function delete($clientId) {
        return $this->mareyeurQuery->delete($clientId);
    }

   
    public function view($mareyeurId) {
        $mareyeur = $this->mareyeurQuery->view($mareyeurId);
        return $mareyeur;
    }
    
    
    public function findTypeMareyeurById($typemareyeurId) {
        return $this->mareyeurQuery->findTypeMareyeurById($typemareyeurId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->mareyeurQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }
public function retrieveTypes()
    {
        return $this->mareyeurQuery->retrieveTypes();
    }
   
    public function count($where="") {
        return $this->mareyeurQuery->count($where);
    }
    
     public function retrieveAllTypeMareyeurs($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->mareyeurQuery->retrieveAllTypeMareyeurs($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function countAllTypeMareyeurs($where="") {
        return $this->mareyeurQuery->countAllTypeMareyeurs($where);
    }
//    public function findAllMareyeurs($term){
//            return $this->mareyeurQuery->findAllMareyeurs($term);
//    }

    public function findMareyeursByName($name){
        return $this->mareyeurQuery->findMareyeursByName($name);
    }
    public function findAllMareyeurs($userId) {
        $mareyeurs = $this->mareyeurQuery->findAllMareyeurs($userId);
        $list = array();
        $i = 0;
        // $grp = new Group();
        foreach ($mareyeurs as $key => $value) {
            $list [$i]['id'] = $value ['id'];
            $list [$i]['nom'] = $value ['nom'];
            $list [$i]['adresse'] = $value ['adresse'];
            $list [$i]['telephone'] = $value ['telephone'];
            $list [$i]['montantFinancement'] = $value ['montantFinancement'];
            $i++;
        }
        return $list;
    }

    public function retrieveAllMareyeur() {
        return $this->mareyeurQuery->retrieveAllMareyeur();
    }
    
    public function findInfoMareyeurs($mareyeurId) {
        $mareyeurs = $this->mareyeurQuery->findInfoMareyeurs($mareyeurId);
        $list = array();
        foreach ($mareyeurs as $key => $value) {
            $list ['adresse'] = $value ['adresse'];
            $list ['reference'] = $value ['reference'];
        }
        return $list;
    }
    
    public function getLastMareyeurNumber() {
    $lastMareyeurId=$this->mareyeurQuery->getLastMareyeurNumber();
    if($lastMareyeurId !=null){
        $lastMareyeurId="MR".$lastMareyeurId;
    }
    else
        $lastMareyeurId="MR1";
    return $lastMareyeurId;
}
}
