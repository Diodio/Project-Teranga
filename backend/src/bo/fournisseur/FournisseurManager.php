<?php

namespace Fournisseur;
require_once '../../common/app.php';
use Fournisseur\FournisseurQueries as FournisseurQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class FournisseurManager {

    private $fournisseurQuery;
   

    public function __construct() {
        $this->fournisseurQuery = new FournisseurQueries();
    }
    
    public function insert($fournisseur) {
        $this->fournisseurQuery->insert($fournisseur);
    	return $fournisseur;
    }
    
    public function listAll() {
    	$this->fournisseurQuery=$this->fournisseurQuery->findAll();
    	return $this->fournisseurQuery;
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
        return $this->fournisseurQuery->delete($clientId);
    }

   
    public function view($clientId) {
        $client = $this->fournisseurQuery->view($clientId);
        return $client;
    }
    
    
    public function findById($contactId) {
        return $this->fournisseurQuery->findAllById($contactId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->fournisseurQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function count($where="") {
        return $this->fournisseurQuery->count($where);
    }

    
}
