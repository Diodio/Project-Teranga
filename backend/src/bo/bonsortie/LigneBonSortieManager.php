<?php

namespace BonSortie;
use BonSortie\LigneBonSortieQueries as LigneBonSortieQueries;



class LigneBonSortieManager {

    private $ligneBonSortieQuery;
   

    public function __construct() {
        $this->ligneBonSortieQuery = new LigneBonSortieQueries();
    }
    
    public function insert($ligneSortie) {
        $this->ligneBonSortieQuery->insert($ligneSortie);
    	return $ligneSortie;
    }
    
    

}
