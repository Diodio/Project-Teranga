<?php

namespace Utilisateur;
use Utilisateur\ProfilQueries as ProfilQueries;



class ProfilManager {

    private $profilQueries;

    public function __construct() {
        $this->profilQueries = new ProfilQueries();
    }
    
    public function insert($usine) {
        $this->profilQueries->insert($usine);
    	return $usine;
    }
    
    public function listAll() {
    	$this->profilQueries=$this->profilQueries->findAll();
    	return $this->profilQueries;
    }
	
    public function update($usine) {
       return $this->profilQueries->update($usine);
    }

 
    public function delete($usineId) {
        return $this->profilQueries->delete($usineId);
    }

   
    public function view($usineId) {
         return $this->profilQueries->view($usineId);
    }
    
    public function findById($usineId) {
       return $this->profilQueries->findById($usineId);
    }

    
    public function retrieveAll() {
        return $this->profilQueries->retrieveAll();
        
    }
public function retrieveTypes()
    {
        return $this->profilQueries->retrieveTypes();
    }
   
    public function count($where="") {
    }
    
     public function retrieveAllTypeProduits($offset, $rowCount, $sOrder = "", $sWhere = "") {
    }

   
    public function countAllTypeProduits($where="") {
    }
    public function findAllProduits($term){
    }

   

}
