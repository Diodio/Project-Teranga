<?php

namespace Usine;
use Usine\UsineQueries as UsineQueries;



class UsineManager {

    private $usineQueries;

    public function __construct() {
        $this->usineQueries = new UsineQueries();
    }
    
    public function insert($usine) {
        $this->usineQueries->insert($usine);
    	return $usine;
    }
    
    public function listAll() {
    	$this->usineQueries=$this->usineQueries->findAll();
    	return $this->usineQueries;
    }
	
    public function update($usine) {
       return $this->usineQueries->update($usine);
    }

 
    public function delete($usineId) {
        return $this->usineQueries->delete($usineId);
    }

   
    public function view($usineId) {
         return $this->usineQueries->view($usineId);
    }
    
    public function findById($usineId) {
       return $this->usineQueries->findById($usineId);
    }

    
    public function retrieveAll() {
        return $this->usineQueries->retrieveAll();
        
    }
    public function retrieveAllByUsine($codeUsine) {
        return $this->usineQueries->retrieveAllByUsine($codeUsine);
        
    }
    
public function retrieveTypes()
    {
        return $this->usineQueries->retrieveTypes();
    }
   
   public function findByCodeUsine($codeUsine) {
       return $this->usineQueries->findByCodeUsine($codeUsine);
   }
   

}
