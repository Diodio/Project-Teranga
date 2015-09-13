<?php

namespace Article;
require_once '../../common/app.php';
use Article\TypeArticleQueries as TypeArticleQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class TypeArticleManager {

    private $typeArticleQuery;
   

    public function __construct() {
        $this->typeArticleQuery = new TypeArticleQueries();
    }
    
    public function insert($typeArticle) {
        $this->typeArticleQuery->insert($typeArticle);
    	return $typeArticle;
    }
    
    public function listAll() {
    	$this->typeArticleQuery=$this->typeArticleQuery->findAll();
    	return $this->typeArticleQuery;
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

 
    public function delete($typeArticleId) {
        return $this->typeArticleQuery->delete($typeArticleId);
    }

   
    public function view($typeArticleId) {
        $client = $this->typeArticleQuery->view($typeArticleId);
        return $client;
    }
    
    
    
    
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->typeArticleQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }

   
    public function count($where="") {
        return $this->typeArticleQuery->count($where);
    }
    public function retrieveAllTypes()
    {   $groups = $this->typeArticleQuery->retrieveAllTypes();
        $list = array();
        $i = 0;
        foreach ($groups as $key => $value) {
            $list [$i]['value'] = $value ['value'];
            $list [$i]['text'] = $value ['text'];
             $i++;
            }
        
        return $list;
        
    }

    
}
