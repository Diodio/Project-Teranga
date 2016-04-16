<?php

namespace Achat;

use Achat\AchatQueries as AchatQueries;


class AchatManager {

    private $achatQuery;

    public function __construct() {
        $this->achatQuery = new AchatQueries();
    }

    public function insert($achat) {
        $this->achatQuery->insert($achat);
        return $achat;
    }

    public function update($achat) {
        $this->achatQuery->update($achat);
        return $achat;
    }

    public function isExist($numero, $codeUsine) {
        return $this->achatQuery->isExist($numero, $codeUsine);
    }
    
    public function listAll() {
        $this->achatQuery = $this->achatQuery->findAll();
        return $this->achatQuery;
    }

    public function findById($achatId) {
        return $this->achatQuery->findById($achatId);
    }

    public function findTypeAchatById($typeproduitId) {
        return $this->achatQuery->findTypeAchatById($typeproduitId);
    }

    public function retrieveAll($typeAchat,$codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->achatQuery->retrieveAll($typeAchat,$codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }
    public function retrieveAllAchatGerant($login,$codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
    	return $this->achatQuery->retrieveAllAchatGerant($login,$codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }
    
    public function retrieveAchatInventaire($mareyeurId,$dateDebut, $dateFin, $regle, $codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->achatQuery->retrieveAchatInventaire($mareyeurId,$dateDebut, $dateFin, $regle, $codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function retrieveAllReglements($codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->achatQuery->retrieveAllReglements($codeUsine, $offset, $rowCount, $sOrder, $sWhere);
    }

    public function countAllAchatGerant($login, $codeUsine, $where = "") {
        return $this->achatQuery->countAllAchatGerant($login, $codeUsine, $where);
    }
    
    public function count($typeAchat, $codeUsine, $where = "") {
        return $this->achatQuery->count($typeAchat, $codeUsine, $where);
    }
    
    public function countInventaires($mareyeurId,$dateDebut, $dateFin, $regle, $codeUsine, $where = "") {
        return $this->achatQuery->countInventaires($mareyeurId,$dateDebut, $dateFin, $regle, $codeUsine, $where);
    }

    public function countReglement($codeUsine, $where = "") {
        return $this->achatQuery->countReglements($codeUsine, $where);
    }

    public function validAchat($achatId) {
        return $this->achatQuery->validAchat($achatId);
    }

    public function annulerAchat($achatId) {
        return $this->achatQuery->annulerAchat($achatId);
    }

    public function remove($achatId) {
        return $this->achatQuery->delete($achatId);
    }

    public function modifReglement($achatId, $status) {
        return $this->achatQuery->modifReglement($achatId, $status);
    }

    public function getLastNumberAchat($codeUsine) {
        $lastAchatId = $this->achatQuery->getLastNumberAchat($codeUsine);
        if ($lastAchatId != null) {
            if (strlen($lastAchatId) == 1)
                $lastAchatId = "0000" . $lastAchatId;
            else if (strlen($lastAchatId) == 2)
                $lastAchatId = "000" . $lastAchatId;
            else if (strlen($lastAchatId) == 3)
                $lastAchatId = "00" . $lastAchatId;
            else if (strlen($lastAchatId) == 4)
                $lastAchatId = "0" . $lastAchatId;
        } else
            $lastAchatId = "00001";
        return $lastAchatId;
    }

    public function findStatisticByUsine($login, $codeUsine) {
        if ($codeUsine != null) {
            $validAchat = $this->achatQuery->findValidAchatByUsine($codeUsine);
            $nonValidAchat = $this->achatQuery->findNonValidAchatByUsine($codeUsine);
            $achatAnnuler = $this->achatQuery->findAchatAnnulerByUsine($codeUsine);
            $achatTab = array();
            if ($validAchat != null)
                $achatTab['nbValid'] = $validAchat;
            else
                $achatTab['nbValid'] = 0;
            if ($nonValidAchat != null)
                $achatTab['nbNonValid'] = $nonValidAchat;
            else
                $achatTab['nbNonValid'] = 0;
            if ($achatAnnuler != null)
                $achatTab['nbAnnule'] = $achatAnnuler;
            else
                $achatTab['nbAnnule'] = 0;


            return $achatTab;
        } else
            return 0;
    }

    public function findStatisticReglementByUsine($codeUsine) {
        if ($codeUsine != null) {
            $regle = $this->achatQuery->findRegleByUsine($codeUsine);
            $nonRegle = $this->achatQuery->findNonRegleByUsine($codeUsine);
            $achatARegler = $this->achatQuery->findARegleByUsine($codeUsine);
            $achatTab = array();
            if ($regle != null)
                $achatTab['nbRegle'] = $regle;
            else
                $achatTab['nbRegle'] = 0;
            if ($nonRegle != null)
                $achatTab['nbNonRegle'] = $nonRegle;
            else
                $achatTab['nbNonRegle'] = 0;
            if ($achatARegler != null)
                $achatTab['nbARegler'] = $achatARegler;
            else
                $achatTab['nbARegler'] = 0;


            return $achatTab;
        } else
            return 0;
    }

    public function findAchatDetails($achatId) {
        if ($achatId != null) {
            $achat = $this->achatQuery->findAchatDetails($achatId);
            $ligneAchat = $this->achatQuery->findAllProduitByAchact($achatId);
            $reglement = $this->achatQuery->findReglementByAchat($achatId);
            $achatDetail = array();
            foreach ($achat as $key => $value) {
                // $achatDetail ['id'] = $value ['achat.id'];
                $achatDetail ['numero'] = $value ['numero'];
                $achatDetail ['dateAchat'] = date_format(date_create($value ['dateAchat']), 'd-m-Y');
                $achatDetail ['heureReception'] =  $value ['heureReception'];
                $achatDetail ['nomMareyeur'] = $value ['nom'];
                $achatDetail ['adresse'] = $value ['adresse'];
                $userManager = new \Utilisateur\UtilisateurManager();
                $user = $userManager->findByLogin($value ['login'], $value ['codeUsine']);
                $achatDetail ['user'] = $user;
                $achatDetail ['poidsTotal'] = $value ['poidsTotal'];
                $achatDetail ['montantTotal'] = $value ['montantTotal'];
                $achatDetail ['modePaiement'] = $value ['modePaiement'];
                $achatDetail ['numCheque'] = $value ['numCheque'];
                $achatDetail ['datePaiement'] = $value ['datePaiement'];
                $achatDetail ['regle'] = $value ['regle'];
                $achatDetail ['reliquat'] = $value ['reliquat'];
                $achatDetail ['transport'] = $value ['transport'];
                $achatDetail['ligneAchat'] = $ligneAchat;
                $achatDetail['reglement'] = $reglement;
            }
            return $achatDetail;
        } else
            return null;
    }

    public function getTotalReglementByAchat($achatId) {
        $som = 0;
        $achat = $this->achatQuery->getTotalReglementByAchat($achatId);
        if ($achat['sommeAvance'] != NULL)
            $som = $achat['sommeAvance'];
        return $som;
    }

    /**
     * 
     * @param type $achatId
     * @return type
     * Cette fonction pernmet de recuperer les informations de l'achat pour la validation et l'ajout du stock
     */
    public function ajoutStockParAchact($achatId) {
        $stockManager = new \Stock\StockManager();
        $StockAcheteManager = new \Stock\StockAcheteManager();
        $achat = $this->achatQuery->findInfoByAchact($achatId);
        foreach ($achat as $key => $value) {
            $stock = $stockManager->findStockProvisoireByProduitId($value ['produit_id'], $value ['codeUsine']);
            if ($stock == 0) {
                $stockProvisoire = new \Stock\StockProvisoire();
                $stockProvisoire->setCodeUsine($value ['codeUsine']);
                $stockProvisoire->setLogin($value ['login']);
                $produitManger = new \Produit\ProduitManager();
                $produit = $produitManger->findById($value ['produit_id']);
                $stockProvisoire->setProduit($produit);
                $stockProvisoire->setStock($value ['quantite']);
                $stockManager->insert($stockProvisoire);
            } else {
                $stockManager->updateNbStock($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
            }
            // $stockA = $StockAcheteManager->findStockAcheteByProduitId($value ['produit_id'], $value ['codeUsine']);
            // if ($stockA == 0) {
            $stockAchete = new \Stock\StockAchete();
            $stockAchete->setAchatId($achatId);
            $stockAchete->setProduitId($value ['produit_id']);
            $stockAchete->setQuantiteAchetee($value ['quantite']);
            $StockAcheteManager->insert($stockAchete);
            //  }
            //  else {
            // 	$StockAcheteManager->updateNbStockAchete($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
            //  }
        }
        $this->validAchat($achatId);
    }

    public function annulerStockParAchact($achatId) {
        $ach = $this->achatQuery->findById($achatId);
        if ($ach->getStatus() == 0)
            $this->annulerAchat($achatId);
        else if ($ach->getStatus() == 1) {
            $achat = $this->achatQuery->findInfoByAchact($achatId);
            if ($achat != NULL) {
                foreach ($achat as $key => $value) {
                    $stockManager = new \Stock\StockManager();
                    $StockAcheteManager = new \Stock\StockAcheteManager();
                    $stockManager->destockage($value ['produit_id'], $value ['codeUsine'], $value ['quantite']);
                    $stockId = $StockAcheteManager->findStocksAcheteById($achatId, $value ['produit_id']);
                    if($stockId !== null){
                        $stockAchete = $StockAcheteManager->findById($stockId);
                        $StockAcheteManager->delete($stockAchete);
                    }
                }
                $this->annulerAchat($achatId);
            }
        }
    }

    public function getInfoInventaire($mareyeurId,$typeAchat, $dateDebut, $dateFin, $codeUsine) {
        $infosP = $this->achatQuery->getInfoPoidsTotal($mareyeurId,$typeAchat, $dateDebut, $dateFin, $codeUsine);
        $infosM = $this->achatQuery->getInfoMontantTotal($mareyeurId,$typeAchat, $dateDebut, $dateFin, $codeUsine);
        $infosTab = array();
        if ($infosP != null && $infosM !=null) {
            if($infosM['montantTotal'] !=null)
                $infosTab['montantTotal'] = $infosM['montantTotal'];
            else
                $infosTab['montantTotal'] = 0.00;
            if($infosP['poidsTotal'] !=null)
                $infosTab['poidsTotal'] = $infosP['poidsTotal'];
            else
                $infosTab['poidsTotal'] = 0.00;
        }
        else {
            $infosTab['poidsTotal'] =0.00;
            $infosTab['montantTotal'] =0.00;
        }
        
        return $infosTab;
    }
    
    public function findStatisticByUsineGerant($login,$codeUsine) {
    	if ($codeUsine != null) {
    		$validAchat = $this->achatQuery->findValidAchatByUsineGerant($login,$codeUsine);
    		$nonValidAchat = $this->achatQuery->findNonValidAchatByUsineGerant($login,$codeUsine);
    		$achatAnnuler = $this->achatQuery->findAchatAnnulerByUsineGerant($login,$codeUsine);
    		$achatTab = array();
    		if ($validAchat != null)
    			$achatTab['nbValid'] = $validAchat;
    		else
    			$achatTab['nbValid'] = 0;
    		if ($nonValidAchat != null)
    			$achatTab['nbNonValid'] = $nonValidAchat;
    		else
    			$achatTab['nbNonValid'] = 0;
    		if ($achatAnnuler != null)
    			$achatTab['nbAnnule'] = $achatAnnuler;
    		else
    			$achatTab['nbAnnule'] = 0;
    
    
    		return $achatTab;
    	} else
    		return 0;
    }

}
