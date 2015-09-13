<?php

namespace Client;
require_once '../../common/app.php';
use Client\Client as Client;
use Client\ClientQueries as ClientQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class ClientManager {

    private $clientQuery;
   

    public function __construct() {
        $this->clientQuery = new ClientQueries();
    }
    
    public function insert($client) {
        $this->clientQuery->insert($client);
    	return $client;
    }
    
    public function listAll() {
    	$this->clientQuery=$this->clientQuery->findAll();
    	return $this->clientQuery;
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
        return $this->clientQuery->delete($clientId);
    }

   
    public function view($clientId) {
        $client = $this->clientQuery->view($clientId);
        return $client;
    }
    
    
    public function findById($contactId) {
        return $this->clientQuery->findAllById($contactId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->clientQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function count($where="") {
        return $this->clientQuery->count($where);
    }

    
}
