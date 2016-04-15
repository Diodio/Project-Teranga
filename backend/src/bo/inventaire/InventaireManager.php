<?php

namespace Inventaire;
use Inventaire\InventaireQueries as InventaireQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class InventaireManager {

    private $inventaireQuery;
   

    public function __construct() {
        $this->inventaireQuery = new InventaireQueries();
    }
    
    public function getInfoInventaire($dateDebut, $dateFin, $codeUsine) {
        $achatQueries = new \Achat\AchatQueries();
        $infosAchat = $achatQueries->getInfoMontantTotal('*', '*', $dateDebut, $dateFin, $codeUsine);
        $factureQueries = new \Facture\FactureQueries();
        $infosFacture = $factureQueries->getInfoMontantTotal('*', '*', $dateDebut, $dateFin, $codeUsine);
        $infosFactureImpayees = $factureQueries->getInfoMontantTotal('*', '0', $dateDebut, $dateFin, $codeUsine);
        $infosTab = array();
        if ($infosAchat['montantTotal'] != null)
            $infosTab['sommeAchat'] = $infosAchat['montantTotal'];
        else
            $infosTab['sommeAchat'] = 0.00;
        if ($infosFacture['montantTotal'] != null)
            $infosTab['sommeVente'] = $infosFacture['montantTotal'];
        else
            $infosTab['sommeVente'] = 0.00;
        $beneficeGlobal = floatval($infosFacture['montantTotal']) - floatval($infosAchat['montantTotal']);
        $infosTab['beneficeGlobal'] = $beneficeGlobal;
        $beneficeActuel = floatval($beneficeGlobal) - floatval($infosFactureImpayees['montantTotal']);
        $infosTab['beneficeActuel'] = $beneficeActuel;

        return $infosTab;
    }

}
