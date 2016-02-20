<?php

namespace Client;
use Client\ClientQueries as ClientQueries;



class ClientManager {

    private $ClientQuery;
   

    public function __construct() {
        $this->ClientQuery = new ClientQueries();
    }
    
    public function insert($Client) {
        return $this->ClientQuery->insert($Client);
    }
    public function update($Client) {
        return $this->ClientQuery->insert($Client);
    }
     public function findById($ClientId) {
         return $this->ClientQuery->findById($ClientId);
     }
    public function listAll() {
    	$this->ClientQuery=$this->ClientQuery->findAll();
    	return $this->ClientQuery;
    }
   
    public function findAdress($clientId) {
        $client = $this->ClientQuery->findAdress($clientId);
        $list = array();
        foreach ($client as $key => $value) {
            $list ['adresse'] = $value ['adresse'];
        }
        return $list;
    }
 
    public function delete($clientId) {
        return $this->ClientQuery->delete($clientId);
    }

   
    public function view($ClientId) {
        $Client = $this->ClientQuery->view($ClientId);
        return $Client;
    }
    
    
    public function findTypeClientById($typeClientId) {
        return $this->ClientQuery->findTypeClientById($typeClientId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->ClientQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }
public function retrieveClients()
    {
        return $this->ClientQuery->retrieveClients();
    }
   
    public function count($where="") {
        return $this->ClientQuery->count($where);
    }
    
     public function retrieveAllTypeClients($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->ClientQuery->retrieveAllTypeClients($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function countAllTypeClients($where="") {
        return $this->ClientQuery->countAllTypeClients($where);
    }
//    public function findAllClients($term){
//            return $this->ClientQuery->findAllClients($term);
//    }

    public function findClientsByName($name){
        return $this->ClientQuery->findClientsByName($name);
    }
    public function findAllClients() {
        $Clients = $this->ClientQuery->findAllClients();
        $list = array();
        $i = 0;
        // $grp = new Group();
        if($Clients !=NULL)
        foreach ($Clients as $key => $value) {
            $list [$i]['id'] = $value ['id'];
            $list [$i]['nom'] = $value ['nom'];
            $list [$i]['adresse'] = $value ['adresse'];
            $list [$i]['pays'] = $value ['pays'];
            $list [$i]['telephone'] = $value ['telephone'];
            $i++;
        }
        return $list;
    }
    
    public function findInfosClient($clientId) {
        $client = $this->ClientQuery->findInfosClient($clientId);
        $list = array();
        foreach ($client as $key => $value) {
            $list ['nom'] = $value ['nom'];
            $list ['origine'] = $value ['adresse'];
            $list ['pays'] = $value ['pays'];
            $list ['reference'] = $value ['reference'];
        }
        return $list;
    }
    
    public function findListClients() {
        $Clients = $this->ClientQuery->findAllClients();
        $list = array();
        $i = 0;
        if($Clients !=NULL)
        foreach ($Clients as $key => $value) {
            $list [$i]['value'] = $value ['id'];
            $list [$i]['text'] = $value ['nom'];
            $i++;
        }
        return $list;
    }
    
    public function getLastNumber() {
    $lastId=$this->ClientQuery->getLastNumber();
    if($lastId !=null){
        $lastId="CLI".$lastId;
    }
    else
        $lastId="CLI1";
    return $lastId;
}

}
