<?php

namespace Produit;
use Produit\ProduitQueries as ProduitQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class ProduitManager {

    private $produitQuery;
   

    public function __construct() {
        $this->produitQuery = new ProduitQueries();
    }
    
    public function insert($produit) {
        $this->produitQuery->insert($produit);
    	return $produit;
    }
    
    public function listAll() {
    	$this->produitQuery=$this->produitQuery->findAll();
    	return $this->produitQuery;
    }
	
    public function update($produit) {
       return $this->produitQuery->update($produit);
    }

 
    public function delete($produitId) {
        return $this->produitQuery->delete($produitId);
    }

   public function findById($produitId) {
       return $this->produitQuery->findById($produitId);
    }
    public function view($produitId) {
        $produit = $this->produitQuery->view($produitId);
        $produitTab =  array();
            $produitTab ['id'] = $produit['id'];
            $produitTab ['libelle'] = $produit['libelle'];
            $produitTab ['prixUnitaire'] = $produit['prixUnitaire'];
        return $produitTab;
    }
    
    
    public function findTypeProduitById($typeproduitId) {
        return $this->produitQuery->findTypeProduitById($typeproduitId);
    }

    
    public function retrieveAll($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        $produits = $this->produitQuery->retrieveAllProduits($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
        $arrayProduits = array();
        $i = 0;
        foreach ($produits as $key => $value) {
            $arrayProduits [$i] [] = $value ['id'];
            $arrayProduits [$i] [] = $value ['libelle'];
            $stockProvisoire =  $this->produitQuery->retrieveStockProvisoire($value ['id']);
            if($stockProvisoire !=null)
                $arrayProduits [$i] [] = $stockProvisoire ['stock'];
            else
                $arrayProduits [$i] [] = 0;
            $stockReel =  $this->produitQuery->retrieveStockReel($value ['id']);
            if($stockReel !=null)
                $arrayProduits [$i] [] = $stockReel['stock'];
            else
                $arrayProduits [$i] [] = 0;
            
            $arrayProduits [$i] [] = $value ['id'];
            $i++;
        }
        return $arrayProduits;
    }
    
    public function retrieveDetailProduit($produitId, $codeUsine) {
        $produits = $this->produitQuery->retrieveDetailProduit($produitId, $codeUsine);
        $arrayProduits = array();
        $i = 0;
        foreach ($produits as $key => $value) {
            $arrayProduits ['id'] = $value ['id'];
            if ($value ['stock'] != null)
                $arrayProduits ['stockProvisoire'] = $value ['stock'];
            else
                $arrayProduits ['stockProvisoire'] = 0;
            $arrayProduits ['designation'] = $value ['libelle'];
        }
        return $arrayProduits;
    }

    public function retrieveAllDemoulages($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        $produits = $this->produitQuery->retrieveAllDemoulages($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
        $arrayProduits = array();
        $i = 0;
        foreach ($produits as $key => $value) {
            $arrayProduits [$i] [] = $value ['id'];
            $arrayProduits [$i] [] = $value ['libelle'];
            $arrayProduits [$i] [] = $value ['stock'];
            $stockFinal=$this->produitQuery->retrieveStockReelParUsine($value ['id'], $codeUsine);
            if($stockFinal !=null)
                $arrayProduits [$i] []= $stockFinal['stock'];
            else
                $arrayProduits [$i] [] = 0;
            $i++;
        }
        return $arrayProduits;
    }
     public function retrieveAllProduitsDemoulages($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        $produits = $this->produitQuery->retrieveAllProduitsDemoules($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
        $arrayProduits = array();
        $i = 0;
        foreach ($produits as $key => $value) {
            $arrayProduits [$i] [] = $value ['id'];
            $arrayProduits [$i] [] = $value ['libelle'];
            $arrayProduits [$i] [] = $value ['stock'];
            if($value ['nbColis'] !=null)
                $arrayProduits [$i] [] = $value ['nbColis'];
            else $arrayProduits [$i] [] = 0;
            $arrayProduits [$i] [] = $value ['id'];
            
            $i++;
        }
        return $arrayProduits;
    }
    public function countAllDemoulages($codeUsine,$where="") {
        return $this->produitQuery->countAllDemoulages($codeUsine,$where);
    }
    
      public function countAllProduitsDemoulages($codeUsine,$where="") {
        return $this->produitQuery->countAllDemoulages($codeUsine,$where);
    }
public function retrieveTypes()
    {
        return $this->produitQuery->retrieveTypes();
    }
   
    public function count($produitId,$where="") {
        return $this->produitQuery->count($produitId,$where);
    }
    
     public function retrieveAllTypeProduits($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->produitQuery->retrieveAllTypeProduits($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function countAllTypeProduits($where="") {
        return $this->produitQuery->countAllTypeProduits($where);
    }
    public function findAllProduits($term){
            return $this->produitQuery->findAllProduits($term);
    }

    public function findPrixById($produitId){
        $produit = $this->produitQuery->findPrixById($produitId);
        return $produit['prixUnitaire'];
    }
    
    public function retrieveAllByUsine(){
        $produits = $this->produitQuery->retrieveAllByUsine();
        $list = array();
        $i = 0;
        if($produits!=null)
        foreach ($produits as $key => $value) {
            $list [$i]['value'] = $value ['value'];
            $list [$i]['text'] = $value ['text']; 
            $i++;
        }
        return $list;
    }
    // pour bon de sortie
    public function listByUsine($codeUsine){
        $produits = $this->produitQuery->retrieveAllByUsine();
        $list = array();
        $i = 0;
        if($produits!=null)
        foreach ($produits as $key => $value) {
            $stockFinal = 0;
            $list [$i]['value'] = $value ['value'];
            $stock = $this->produitQuery->retrieveStockReelParUsine($value ['value'], $codeUsine);
            if($stock !=null)
              $stockFinal = $stock ['stock']; 
            $list [$i]['text'] = $value ['text'] . '(' .$stockFinal . ')'; 
            $i++;
        }
        return $list;
    }
    
   
    public function findProduitsByName($name) {
        return $this->produitQuery->findProduitsByName($name);
    }
    
    public function retrieveConsultDetailProduit($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
    	$produits = $this->produitQuery->retrieveAllProduits($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    	$arrayProduits = array();
    	$i = 0;
        $stockManager = new \Stock\StockManager();
    	foreach ($produits as $key => $value) {
    		$arrayProduits [$i] [] = $value ['id'];
    		$arrayProduits [$i] [] = $value ['libelle'];
               //var_dump($value ['id']);
                $stockPro = $stockManager->recupereNbStockProvisoire($value ['id'], $codeUsine);
                $quantiteAchetee = $stockManager->recupereQuantiteAchete($value ['id'], $codeUsine);
                $quantiteDemoulee = $stockManager->recupereQuantiteDemoulee($value ['id'], $codeUsine);
                $quantiteFacturee = $stockManager->recupereQuantiteFacturee($value ['id'], $codeUsine);
                $stockReel = $stockManager->recupereStockReel($value ['id'], $codeUsine);
    		$arrayProduits [$i] [] = $stockPro;
    		$arrayProduits [$i] [] = $quantiteAchetee;
    		$arrayProduits [$i] [] = $quantiteDemoulee;
    		$arrayProduits [$i] [] = $quantiteFacturee;
    		$arrayProduits [$i] [] = $stockReel;
//    		$arrayProduits [$i] [] = $value ['stockReel'];
//    		if($value ['nbColis'] !=null)
//    			$arrayProduits [$i] [] = $value ['nbColis'];
//    		else $arrayProduits [$i] [] = 0;
    		$arrayProduits [$i] [] = $value ['id'];
    
    		$i++;
    	}
    	return $arrayProduits;
    }
    
     public function countAllProduits($codeUsine,$where="") {
        return $this->produitQuery->countAllProduits($codeUsine,$where);
    }
}
