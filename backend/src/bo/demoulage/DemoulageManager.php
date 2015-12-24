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
    public function insert($demoulage) {
        $this->demoulageQueries->insert($demoulage);
    	return $demoulage;
    }
    public function getAllColis($produitId) {
        return $this->demoulageQueries->getAllColis($produitId);
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

   

}
