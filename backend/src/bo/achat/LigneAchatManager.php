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
    
     public function update($ligneAchat) {
        $this->ligneAchatQuery->update($ligneAchat);
    	return $ligneAchat;
    }
    
    public function findById($ligneAchatId) {
        return $this->ligneAchatQuery->findById($ligneAchatId);
    }

}
