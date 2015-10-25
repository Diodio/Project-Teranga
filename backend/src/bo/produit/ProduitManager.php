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

 
    public function delete($clientId) {
        return $this->produitQuery->delete($clientId);
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

    
    public function retrieveAll($produitId) {
        return $this->produitQuery->retrieveAll($produitId);
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
    
    public function retrieveAllByUsine($codeUsine){
        $produits = $this->produitQuery->retrieveAllByUsine($codeUsine);
        $list = array();
        $i = 0;
        foreach ($produits as $key => $value) {
            $list [$i]['value'] = $value ['value'];
            $list [$i]['text'] = $value ['text'].' ('.$value ['nbStock'].')';
            $i++;
        }
        return $list;
    }
    
    public function findProduitsByName($name) {
        return $this->produitQuery->findProduitsByName($name);
    }

}
