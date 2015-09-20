<?php

namespace Produit;
require_once '../../common/app.php';
use Produit\FamilleProduitQueries as FamilleProduitQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class FamilleProduitManager {

    private $familleProduitQueries;

    public function __construct() {
        $this->familleProduitQueries = new FamilleProduitQueries();
    }
    
    public function insert($familleProduit) {
        $this->familleProduitQueries->insert($familleProduit);
    	return $familleProduit;
    }
    
    public function listAll() {
    	$this->familleProduitQueries=$this->familleProduitQueries->findAll();
    	return $this->familleProduitQueries;
    }
	//TODO:test pour savoir si customer donn� est null ou pas?
    /**
     * Mettre à jour le contact et les champs additionnels
     * @param Contact $contact l'object contact 
     * @param String $addChamp la liste des champs additionnels sous la forme IdChamp1, CodeCateg1, libelleChamp1, valeurChamp1|IdChamp2, CodeCateg2, libelleChamp2, valeurChamp2...
     * Idchamp = 0 si c'est une insertion
     */
    public function update($famille) {
       return $this->familleProduitQueries->update($famille);
    }

 
    public function delete($familleId) {
        return $this->familleProduitQueries->delete($familleId);
    }

   
    public function view($familleId) {
         return $this->familleProduitQueries->view($familleId);
    }
    
    public function findById($familleId) {
       return $this->familleProduitQueries->findById($familleId);
    }
    public function findTypeProduitById($familleproduitId) {
        return $this->familleProduitQueries->findTypeProduitById($familleproduitId);
    }

    
    public function retrieveAll() {
        return $this->familleProduitQueries->retrieveAll();
        
    }
public function retrieveTypes()
    {
        return $this->familleProduitQueries->retrieveTypes();
    }
   
    public function count($where="") {
    }
    
     public function retrieveAllTypeProduits($offset, $rowCount, $sOrder = "", $sWhere = "") {
    }

   
    public function countAllTypeProduits($where="") {
    }
    public function findAllProduits($term){
    }

   

}
