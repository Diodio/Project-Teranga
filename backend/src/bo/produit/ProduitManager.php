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
	//TODO:test pour savoir si customer donn� est null ou pas?
    /**
     * Mettre à jour le contact et les champs additionnels
     * @param Contact $contact l'object contact 
     * @param String $addChamp la liste des champs additionnels sous la forme IdChamp1, CodeCateg1, libelleChamp1, valeurChamp1|IdChamp2, CodeCateg2, libelleChamp2, valeurChamp2...
     * Idchamp = 0 si c'est une insertion
     */
    public function update($contact, $addChamp = null) {
       
    }

 
    public function delete($clientId) {
        return $this->produitQuery->delete($clientId);
    }

   public function findById($produitId) {
       return $this->produitQuery->findById($produitId);
    }
    public function view($produitId) {
        $produit = $this->produitQuery->view($produitId);
        return $produit;
    }
    
    
    public function findTypeProduitById($typeproduitId) {
        return $this->produitQuery->findTypeProduitById($typeproduitId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->produitQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }
public function retrieveTypes()
    {
        return $this->produitQuery->retrieveTypes();
    }
   
    public function count($where="") {
        return $this->produitQuery->count($where);
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

    public function findProduitsByName($name){
        return $this->produitQuery->findProduitsByName($name);
    }
    
    

}
