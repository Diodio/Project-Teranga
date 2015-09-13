<?php

namespace Article;
require_once '../../common/app.php';
use Article\ArticleQueries as ArticleQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class ArticleManager {

    private $articleQuery;
   

    public function __construct() {
        $this->articleQuery = new ArticleQueries();
    }
    
    public function insert($article) {
        $this->articleQuery->insert($article);
    	return $article;
    }
    
    public function listAll() {
    	$this->articleQuery=$this->articleQuery->findAll();
    	return $this->articleQuery;
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
        return $this->articleQuery->delete($clientId);
    }

   
    public function view($clientId) {
        $client = $this->articleQuery->view($clientId);
        return $client;
    }
    
    
    public function findTypeProduitById($typeproduitId) {
        return $this->articleQuery->findTypeProduitById($typeproduitId);
    }

    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->articleQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }
public function retrieveTypes()
    {
        return $this->articleQuery->retrieveTypes();
    }
   
    public function count($where="") {
        return $this->articleQuery->count($where);
    }
    
     public function retrieveAllTypeProduits($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->articleQuery->retrieveAllTypeProduits($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function countAllTypeProduits($where="") {
        return $this->articleQuery->countAllTypeProduits($where);
    }
    public function findAllProduits($term){
            return $this->articleQuery->findAllProduits($term);
    }

    
}
