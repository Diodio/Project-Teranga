<?php

namespace BonSortie;
use Sortie\LigneSortieQueries as LigneSortieQueries;



class LigneSortieManager {

    private $ligneSortieQuery;
   

    public function __construct() {
        $this->ligneSortieQuery = new LigneSortieQueries();
    }
    
    public function insert($ligneSortie) {
        $this->ligneSortieQuery->insert($ligneSortie);
    	return $ligneSortie;
    }
    
    

}
