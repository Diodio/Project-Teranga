<?php

namespace Mareyeur;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class MareyeurQueries {
    /*
     *
     */

    private $entityManager;
    private $classString;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
        $this->classString = 'Mareyeur\Mareyeur';
    }

   
    public function insert($mareyeur) {
        if ($mareyeur != null) {
            Bootstrap::$entityManager->persist($mareyeur);
            Bootstrap::$entityManager->flush();
            return $mareyeur;
        }
    }
    
     public function update($mareyeur) {
        if ($mareyeur != null) {
            Bootstrap::$entityManager->merge($mareyeur);
            Bootstrap::$entityManager->flush();
            return $mareyeur;
        }
    }

    public function delete($mareyeurId) {
        $mareyeur = $this->findById($mareyeurId);
        if ($mareyeur != null) {
            Bootstrap::$entityManager->remove($mareyeur);
            Bootstrap::$entityManager->flush();
            return $mareyeur;
        } else {
            return null;
        }
    }

    
    
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
    public function retrieveAll($offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " where " . $sWhere;
            $sql = 'select distinct(id), nom, adresse, telephone,montantFinancement
                    from mareyeur' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayMareyeurs = array();
        $i = 0;
        foreach ($products as $key => $value) {
//             $arrayMareyeurs [$i] [] = $value ['id'];
            $arrayMareyeurs [$i] [] = $value ['nom'];
            $arrayMareyeurs [$i] [] = $value ['adresse'];
            $arrayMareyeurs [$i] [] = $value ['telephone'];
            $arrayMareyeurs [$i] [] = $value ['montantFinancement'];
            $i++;
        }
        return $arrayMareyeurs;
    }

 
  public function retrieveTypes() {
        $query = Bootstrap::$entityManager->createQuery("select t.id as value, t.libelle as text from Mareyeur\TypeMareyeur t");
        $types = $query->getResult();
        if ($types != null)
            return $types;
        else
            return null;
    }
    public function view($mareyeurId) {
        $query = B::$entityManager->createQuery('SELECT id, libelle,poidsNet, prixUnitaire, stock, seuil FROM Mareyeur\Mareyeur p WHERE p.id=' . $mareyeurId . '');
        $mareyeur = $query->getResult();
        if (count($mareyeur) != 0) {
            return $mareyeur;
        } else {
            return null;
        }
    }

    
    public function count($sWhere = "") {
       if($sWhere !== "")
            $sWhere = " where " . $sWhere;
             $sql = 'select count(id) as nbMareyeurs
                    from mareyeur ' . $sWhere . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbMareyeurs'];
    }

    public function findById($mareyeurId) {
        if ($mareyeurId != null) {
            return Bootstrap::$entityManager->find('Mareyeur\Mareyeur', $mareyeurId);
        }
    }

    public function retrieveAllTypeMareyeurs($offset, $rowCount, $sOrder = "", $sWhere = "") {
                if($sWhere !="")
                    $sWhere = " where" . $sWhere;
                $sql = 'select distinct(id),libelle
                    from type_mareyeur c  ' . $sWhere . ' group by c.id ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['libelle'];
            $i ++;
        }
        return $arrayContact;
    }

   
    public function countAllTypeMareyeurs($where="") {
        if($where !="")
                    $where = " where" . $where;
           $sql = 'select count(id) as nbTypeMareyeurs
                    from type_mareyeur c  ' . $where . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbTypeMareyeurs = $stmt->fetch();
        return $nbTypeMareyeurs['nbTypeMareyeurs'];
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function findTypeMareyeurById($typemareyeurId) {
            if ($typemareyeurId != null) {
                return Bootstrap::$entityManager->find('Mareyeur\TypeMareyeur', $typemareyeurId );
            }
        }
//    public function findAllMareyeurs($term) {
//        $sql = 'SELECT id, libelle VALUE  FROM mareyeur
//    		  where ( libelle LIKE "%' . $term . '%")';
//        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
//        $stmt->execute();
//        $mareyeurs = $stmt->fetchAll();
//        if ($mareyeurs != null)
//            return $mareyeurs;
//        else
//            return null;
//    }
   
    
     public function findMareyeursByName($name) {
        $sql = 'SELECT id  FROM mareyeur where ( id = "'. $name .'")';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $mareyeur = $stmt->fetchAll();
        if ($mareyeur != null)
            return $mareyeur;
        else
            return null;
    }
    
    public function findAllMareyeurs($userId) {
        $sql = 'select id, nom, adresse, telephone, montantFinancement from mareyeur';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $mareyeur = $stmt->fetchAll();
        if ($mareyeur != null)
            return $mareyeur;
        else
            return null;
    }
    
    public function retrieveAllMareyeur() {
        $sql = 'select m.id as value, m.nom as text from mareyeur m';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $mareyeur = $stmt->fetchAll();
        if ($mareyeur != null)
            return $mareyeur;
        else
            return null;
    }
    
    public function findInfoMareyeurs($mareyeurId) {
        $sql = 'select reference,adresse from mareyeur where id='.$mareyeurId;
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $mareyeur = $stmt->fetchAll();
        if ($mareyeur != null)
            return $mareyeur;
        else
            return null;
    }
    
    public function getLastMareyeurNumber() {
        $sql = 'select max(id)+1 as lastMareyeur from mareyeur';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastMareyeur = $stmt->fetch();
        return $lastMareyeur['lastMareyeur'];
    }
}
