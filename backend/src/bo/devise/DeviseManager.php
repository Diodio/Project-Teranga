<?php

namespace Devise;
use Devise\DeviseQueries as DeviseQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class DeviseManager {

    private $deviseQuery;
   

    public function __construct() {
        $this->deviseQuery = new DeviseQueries();
    }
    
    public function update($devise) {
        $this->deviseQuery->update($devise);
        return $devise;
    }
    
    public function getInfoDevise() {
        $devise = $this->deviseQuery->getInfoDevise();
        $infosTab = array();
        if ($devise != NULL) {
            foreach ($devise as $key => $value) {
                if ($value['devise'] == '€')
                    $infosTab['euro'] = $value['montant'];
                else if ($value['devise'] == '‎$')
                    $infosTab['dollar'] = $value['montant'];
            }
        }

        return $infosTab;
    }

}
