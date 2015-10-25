<?php

namespace Achat;
use Achat\LigneAchatQueries as LigneAchatQueries;



class LigneAchatManager {

    private $ligneAchatQuery;
   

    public function __construct() {
        $this->ligneAchatQuery = new LigneAchatQueries();
    }
    
    public function insert($ligneAchat) {
        $this->ligneAchatQuery->insert($ligneAchat);
    	return $ligneAchat;
    }
    
    

}
