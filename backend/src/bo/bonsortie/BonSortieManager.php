<?php

namespace BonSortie;

use BonSortie\BonSortieQueries as BonSortieQueries;
use Stock\StockManager;
use Log\Loggers as Logger;

/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */
class BonSortieManager {

    private $bonSortieQuery;
    private $logger;

    public function __construct() {
        $this->logger = new Logger(__NAMESPACE__);
        $this->bonSortieQuery = new BonSortieQueries();
    }

    public function insert($bonSortie) {
        $this->bonSortieQuery->insert($bonSortie);
        return $bonSortie;
    }

    public function listAll() {
        $this->bonSortieQuery = $this->bonSortieQuery->findAll();
        return $this->bonSortieQuery;
    }

    public function remove($achatId) {
        return $this->bonSortieQuery->delete($achatId);
    }

    public function findById($colisageId) {
        return $this->bonSortieQuery->findById($colisageId);
    }

    public function findTypeBonSortieById($typeproduitId) {
        return $this->bonSortieQuery->findTypeBonSortieById($typeproduitId);
    }

    public function retrieveAll($status, $codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->bonSortieQuery->retrieveAll($status, $codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function retrieveAllEntree($codeUsineDest, $codeUsineOrigine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->bonSortieQuery->retrieveAllEntree($codeUsineDest, $codeUsineOrigine, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function countEntree($codeUsineDest, $codeUsineOrigine, $where = "") {
        return $this->bonSortieQuery->countEntree($codeUsineDest, $codeUsineOrigine, $where);
    }

    public function count($status, $codeUsine, $where = "") {
        return $this->bonSortieQuery->count($status, $codeUsine, $where);
    }

    public function validBonSortie($bonSortieId) {
        return $this->bonSortieQuery->validBon($bonSortieId);
    }

    public function annulerBonSortie($bonSortieId) {
        return $this->bonSortieQuery->annulerBonSortie($bonSortieId);
    }

    public function isBonSortieExist($numero, $codeUsine) {
        return $this->bonSortieQuery->isBonSortieExist($numero, $codeUsine);
    }

    public function getLastNumberBonSortie($codeUsine) {
        $lastBonSortieId = $this->bonSortieQuery->getLastNumberBonSortie($codeUsine);
        if ($lastBonSortieId != null) {
            if (strlen($lastBonSortieId) == 1)
                $lastBonSortieId = "0000" . $lastBonSortieId;
            else if (strlen($lastBonSortieId) == 2)
                $lastBonSortieId = "000" . $lastBonSortieId;
            else if (strlen($lastBonSortieId) == 3)
                $lastBonSortieId = "00" . $lastBonSortieId;
            else if (strlen($lastBonSortieId) == 4)
                $lastBonSortieId = "0" . $lastBonSortieId;
        } else
            $lastBonSortieId = "00001";
        return $lastBonSortieId;
    }

    public function findStatisticByUsine($codeUsine) {
        if ($codeUsine != null) {
            $validBonSortie = $this->bonSortieQuery->findValidBonByUsine($codeUsine);
            $nonValidBonSortie = $this->bonSortieQuery->findNonValidBonByUsine($codeUsine);
            $bonSortieAnnuler = $this->bonSortieQuery->findBonAnnulerByUsine($codeUsine);
            $bonSortieTab = array();
            if ($validBonSortie != null)
                $bonSortieTab['nbValid'] = $validBonSortie;
            else
                $bonSortieTab['nbValid'] = 0;
            if ($nonValidBonSortie != null)
                $bonSortieTab['nbNonValid'] = $nonValidBonSortie;
            else
                $bonSortieTab['nbNonValid'] = 0;
            if ($bonSortieAnnuler != null)
                $bonSortieTab['nbAnnule'] = $bonSortieAnnuler;
            else
                $bonSortieTab['nbAnnule'] = 0;


            return $bonSortieTab;
        } else
            return 0;
    }
    
    public function findStatisticByUsineAnnule($codeUsine) {
    	if ($codeUsine != null) {
    		$validBonSortie = $this->bonSortieQuery->findStatisticByUsineAnnule($codeUsine);
    		$nonValidBonSortie = $this->bonSortieQuery->findStatisticByUsineAnnule($codeUsine);
    		$bonSortieAnnuler = $this->bonSortieQuery->findStatisticByUsineAnnule($codeUsine);
    		$bonSortieTab = array();
    		if ($validBonSortie != null)
    			$bonSortieTab['nbValid'] = $validBonSortie;
    		else
    			$bonSortieTab['nbValid'] = 0;
    		if ($nonValidBonSortie != null)
    			$bonSortieTab['nbNonValid'] = $nonValidBonSortie;
    		else
    			$bonSortieTab['nbNonValid'] = 0;
    		if ($bonSortieAnnuler != null)
    			$bonSortieTab['nbAnnule'] = $bonSortieAnnuler;
    		else
    			$bonSortieTab['nbAnnule'] = 0;
    
    
    		return $bonSortieTab;
    	} else
    		return 0;
    }

    public function findQuantiteSortieByUsine() {
        $sortieDakar = $this->bonSortieQuery->findQuantiteSortieByUsine('usine_dakar');
        $sortieRufisque = $this->bonSortieQuery->findQuantiteSortieByUsine('usine_rufisque');
        $sortieStlouis = $this->bonSortieQuery->findQuantiteSortieByUsine('usine_stlouis');
        $bonSortieTab = array();
        if ($sortieDakar != null)
            $bonSortieTab['nbDakar'] = $sortieDakar;
        else
            $bonSortieTab['nbDakar'] = 0;
        if ($sortieRufisque != null)
            $bonSortieTab['nbRufisque'] = $sortieRufisque;
        else
            $bonSortieTab['nbRufisque'] = 0;
        if ($sortieStlouis != null)
            $bonSortieTab['nbStLouis'] = $sortieStlouis;
        else
            $bonSortieTab['nbStLouis'] = 0;


        return $bonSortieTab;
    }
    
    public function findQuantiteSortieAnnuleByUsine() {
    	$sortieDakar = $this->bonSortieQuery->findQuantiteSortieByUsineAnnule('usine_dakar');
    	$sortieRufisque = $this->bonSortieQuery->findQuantiteSortieByUsineAnnule('usine_rufisque');
    	$sortieStlouis = $this->bonSortieQuery->findQuantiteSortieByUsineAnnule('usine_stlouis');
    	$bonSortieTab = array();
    	if ($sortieDakar != null)
    		$bonSortieTab['nbDakar'] = $sortieDakar;
    	else
    		$bonSortieTab['nbDakar'] = 0;
    	if ($sortieRufisque != null)
    		$bonSortieTab['nbRufisque'] = $sortieRufisque;
    	else
    		$bonSortieTab['nbRufisque'] = 0;
    	if ($sortieStlouis != null)
    		$bonSortieTab['nbStLouis'] = $sortieStlouis;
    	else
    		$bonSortieTab['nbStLouis'] = 0;
    
    
    	return $bonSortieTab;
    }

    public function findQuantiteEntreeByUsine($codeUsineDest) {
        $entree = $this->bonSortieQuery->findQuantiteEntreeByUsine($codeUsineDest);
//            $sortieRufisque = $this->bonSortieQuery->findQuantiteSortieByUsine('usine_rufisque');
//            $sortieStlouis = $this->bonSortieQuery->findQuantiteSortieByUsine('usine_stlouis');
        $bonEntreeTab = array();
//                if ($sortieDakar != null)
//                    $bonSortieTab['nbDakar'] = $sortieDakar;
//                else
//                    $bonSortieTab['nbDakar'] = 0;
//                if ($sortieRufisque != null)
//                    $bonSortieTab['nbRufisque'] = $sortieRufisque;
//                else
//                    $bonSortieTab['nbRufisque']= 0;
        if ($entree != null)
            $bonEntreeTab['nbEntree'] = $entree;
        else
            $bonEntreeTab['nbEntree'] = 0;


        return $bonEntreeTab;
    }

    public function findBonSortieDetails($bonSortieId) {
        if ($bonSortieId != null) {
            $bonSortie = $this->bonSortieQuery->findBonDetails($bonSortieId);
            $ligneBonSortie = $this->bonSortieQuery->findAllProduitByBon($bonSortieId);
            $usineManager = new \Usine\UsineManager();
            $bonSortieDetail = array();
            foreach ($bonSortie as $key => $value) {
                // $bonSortieDetail ['id'] = $value ['sortie.id'];
                $bonSortieDetail ['numero'] = $value ['numeroBonSortie'];
                $bonSortieDetail ['date'] = date_format(date_create($value ['dateBonSortie']), 'd/m/Y');
                $bonSortieDetail ['heure'] = $value ['heureSortie'];
                $bonSortieDetail ['numCamion'] = $value ['numeroCamion'];
                $bonSortieDetail ['chauffeur'] = $value ['nomChauffeur'];
                $usineOrigine = $usineManager->findByCodeUsine($value ['origine']);
                $bonSortieDetail ['origine'] = $usineOrigine['nomUsine'];
                $usineDestination = $usineManager->findByCodeUsine($value ['destination']);
                $bonSortieDetail ['destination'] = $usineDestination ['nomUsine'];
                $bonSortieDetail ['totalColis'] = $value ['totalColis'];
                $bonSortieDetail ['poidsTotal'] = $value ['poidsTotal'];
                $userManager = new \Utilisateur\UtilisateurManager();
                $user = $userManager->findByLogin($value ['login'], $value ['codeUsine']);
                $bonSortieDetail ['user'] = $user;
                // $bonSortieDetail ['user']  =  $value ['login'];
                $bonSortieDetail['ligneBonSortie'] = $ligneBonSortie;
            }
            return $bonSortieDetail;
        } else
            return null;
    }

    /**
     * 
     * @param type $achatId
     * @return type
     * Cette fonction pernmet de recuperer les informations de l'achat pour la validation et la dimunition du stock
     */
    public function dimunieStockParBonSortie($sortieId) {
        $sortie = $this->bonSortieQuery->findInfoByBonSortie($sortieId);
        foreach ($sortie as $key => $value) {
            $stockManager = new \Produit\StockManager();
            $stockManager->destockage($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
        }
    }

    public function remettreStockParBonSortie($sortieId) {
        return $this->annulerBonSortie($sortieId);
    }

    public function dataValidation($jsonBonSortie, $jsonColisage, $codeUsineOrigine) {
        $test = 0;
        //$trouveColis = 0;
        $jsonBon = json_decode($jsonBonSortie, true);
        foreach ($jsonBon as $key => $ligne) {
            if (isset($ligne["produitId"])) {
                if ($ligne["produitId"] !== "" && $ligne["nombreCarton"] !== "" && $ligne["qte"] !== "") {
                    $stockManager = new \Stock\StockManager();
                    $produitId = $ligne["produitId"];
                    if ($ligne['qte'] != "")
                        $quantite = $ligne['qte'];
                    $isstock = $stockManager->findStockReelByProduitId($produitId, $codeUsineOrigine);

                    if ($isstock !== 0) {
                        $stock = $stockManager->recupereNombreStockParProduit($produitId, $codeUsineOrigine);
                        if ($stock['nbStocks'] < $quantite)
                            $test++;
                    }
                }
            }
        }
        $jsonColis = json_decode($jsonColisage, true);
        foreach ($jsonColis as $key => $ligneC) {
            if (isset($ligneC["nbColis"])) {
                if ($ligneC["nbColis"] !== "" && $ligneC["qte"] !== "") {
                    $cartonManager = new \Produit\CartonManager();
                    $produitId = $ligneC["produitId"];
                    $existColisage = $cartonManager->findCartonByProduitId($produitId, $codeUsineOrigine, $ligneC["qte"], $ligneC["nbColis"]);
                    if ($existColisage !== 0) {
                        $colis = $cartonManager->getColisage($produitId, $ligneC["qte"], $codeUsineOrigine, $ligneC["nbColis"]);
                        if ($colis['nombreCarton'] < $ligneC["nbColis"])
                            $test++;
                    }
                }
            }
        }
        return $test;
    }

    public function testAnulle($sortieId) {
        
        $test = 0;
        //$trouveColis = 0;
            $bonSortie = $this->findById($sortieId);
            $codeUsineOrigine = $bonSortie->getOrigine();
            $codeUsineDestination = $bonSortie->getDestination();
            $this->logger->log->trace('codeUsine Origine ' . $codeUsineOrigine);
            $this->logger->log->trace('codeUsine Destination ' . $codeUsineDestination);
            $this->logger->log->trace('recuperation des elements de la ligne bon de sortie ');
            $sortie = $this->bonSortieQuery->findInfoByBonSortie($sortieId);
            $this->logger->log->trace('Fin recuperation des elements de la ligne bon de sortie ');
            foreach ($sortie as $key => $value) {
                $this->logger->log->trace('traitement du produit id ' . $value ['produit_id']);
                $stockManager = new \Stock\StockManager();
                $this->logger->log->trace('recuperation de la quantite reel du produit id ' . $value ['produit_id']);
                $quantiteStock = $stockManager->findQuantiteReelByProduitId($value ['produit_id'], $codeUsineDestination);
                $this->logger->log->trace('Quantite reelle recupereree . la valeur est ' . $quantiteStock);
                $quantite = $value ['quantite'];
                $produitId = $value ['produit_id'];
                $this->logger->log->trace('Quantite stock : '. $quantiteStock);
                $this->logger->log->trace('Quantite ligne colis : '. $quantite);
                if ($quantiteStock < $quantite) {
                    $this->logger->log->trace('Quantite stock inferieur a la ligne');
                    $test++;
                }
            }
            $infosColis = $this->bonSortieQuery->findInfoColisByBonSortie($sortieId);
            foreach ($infosColis as $key => $val) {
                $produitId = $val['produit_id'];
                $quantiteParCarton = $val['quantiteParCarton'];
                $nombreCarton = $val['nombreCarton'];
                $colisageManger =new \Produit\ColisageManager();
                $nombreCartonColisage = $colisageManger->getNombreCartonColisage($produitId, $quantiteParCarton, $codeUsineDestination);
                $this->logger->log->trace('nombre de carton dans colisage  : '. $nombreCartonColisage);
                $this->logger->log->trace('nombre de carton dans  ligne colis : '. $nombreCarton);
                if($nombreCartonColisage != 0){
                    if($nombreCartonColisage < $nombreCarton)
                        $test++;
                }
                else if($nombreCartonColisage == 0)
                    $test++;
                
            }
            
        return $test;
    }

    
    public function listbonValid() {
        $sorties = $this->bonSortieQuery->listbonValid();
//        $list = array();
//        $i = 0;
//        foreach ($sorties as $key => $value) {
//            $list [$i]['value'] = $value ['id'];
//            $list [$i]['text'] = $value ['numero'];
//            $i++;
//        }
        return $sorties;
    }

    public function findInfoColisages($colisageId) {
        $colisages = $this->bonSortieQuery->findInfoColisages($colisageId);
        $list = array();
        foreach ($colisages as $key => $value) {
            $ligneBonSortie = $this->bonSortieQuery->findAllProduitByBon($value ['bid']);
            $list ['nomClient'] = $value ['nom'];
            $list ['origine'] = $value ['origine'];
            $list ['poidsTotal'] = $value ['poidsTotal'];
            $list ['ligneBonSortie'] = $ligneBonSortie;
        }
        return $list;
    }

}
