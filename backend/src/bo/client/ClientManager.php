<?php

namespace Client;
require_once '../../common/app.php';
use Client\ClientQueries as ClientQueries;



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
    public function update($contact, $addChamp = null) {
       
    }

 
    public function delete($clientId) {
        return $this->clientQuery->delete($clientId);
    }

   
    public function view($clientId) {
        $client = $this->clientQuery->view($clientId);
        return $client;
    }
    
    
    public function findTypeClientById($typeclientId) {
        return $this->clientQuery->findTypeClientById($typeclientId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->clientQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }
public function retrieveTypes()
    {
        return $this->clientQuery->retrieveTypes();
    }
   
    public function count($where="") {
        return $this->clientQuery->count($where);
    }
    
     public function retrieveAllTypeClients($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->clientQuery->retrieveAllTypeClients($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function countAllTypeClients($where="") {
        return $this->clientQuery->countAllTypeClients($where);
    }
    public function findAllClients($term){
            return $this->clientQuery->findAllClients($term);
    }

    public function findClientsByName($name){
        return $this->clientQuery->findClientsByName($name);
    }

}
