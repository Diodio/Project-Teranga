<?php

namespace Achat;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class AchatQueries {
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
        $this->classString = 'Achat\Achat';
    }

   
    public function insert($achat) {
        if ($achat != null) {
            Bootstrap::$entityManager->persist($achat);
            Bootstrap::$entityManager->flush();
            return $achat;
        }
    }
    
     public function update($achat) {
        if ($achat != null) {
            Bootstrap::$entityManager->merge($achat);
            Bootstrap::$entityManager->flush();
            return $achat;
        }
    }
    
    public function isExist($numero, $codeUsine) {
        $sql = 'SELECT * FROM achat WHERE numero="' . $numero .'" and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $bon = $stmt->fetchAll();
        if ($bon != null)
            return $bon;
        else
            return null;
    }
    
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   public function retrieveAll($typeAchat,$codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            if($typeAchat !=='*'){
                $sql = 'select achat.id,status, dateAchat, numero, nom
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status='.$typeAchat.' and codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
            else {
            $sql = 'select achat.id,status,dateAchat, numero, nom
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status<>2 and codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
        }
        else {
            if($typeAchat !=='*'){
                $sql = 'select achat.id, status,dateAchat, numero, nom
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status='.$typeAchat.' ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
            else {
            $sql = 'select achat.id, status, dateAchat, numero, nom
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status<>2 ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
            }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayAchats = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayAchats [$i] [] = $value ['id'];
            $arrayAchats [$i] [] = $value ['status'];
            $arrayAchats [$i] [] = $value ['dateAchat'];
            $arrayAchats [$i] [] = $value ['numero'];
            $arrayAchats [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayAchats;
    }
    
    public function retrieveAchatInventaire($mareyeurId,$dateDebut, $dateFin, $regle,$codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        $sqlMareyeur="";
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($dateDebut=='')
            $dateDebut="1900-01-01";
        if($dateFin=='')
            $dateFin="2900-01-01";
        if($dateDebut=='')
            $dateDebut="1900-01-01";
        if($dateFin=='')
            $dateFin="2900-01-01";
        if($mareyeurId!="*"){
            $sqlMareyeur.=" and mareyeur.id=$mareyeurId";
        }
        if($codeUsine !=='*') {
            if($regle !=='*'){
                $sql = 'select achat.id,date_format(dateAchat, "'.\Common\Common::setFormatDate().'") as dateAchat, numero, nom,poidsTotal,montantTotal, regle
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and montantTotal<>0.00 and regle='.$regle.'  and codeUsine="'.$codeUsine.'" '.$sqlMareyeur.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
            else {
            $sql = 'select achat.id,date_format(dateAchat, "'.\Common\Common::setFormatDate().'") as dateAchat, numero, nom,poidsTotal, montantTotal, regle
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and montantTotal<>0.00  '.$sqlMareyeur.'  and codeUsine="'.$codeUsine.'" and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
        }
        else {
            if($regle !=='*'){
                $sql = 'select achat.id,date_format(dateAchat, "'.\Common\Common::setFormatDate().'") as dateAchat, numero, nom,poidsTotal, montantTotal, regle
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and regle='.$regle.' and montantTotal<>0.00 '.$sqlMareyeur.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere .  ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
            else {
            $sql = 'select achat.id, date_format(dateAchat, "'.\Common\Common::setFormatDate().'") as dateAchat, numero, nom,poidsTotal,montantTotal , regle
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id  and montantTotal<>0.00 '.$sqlMareyeur.'  and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere .  ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            }
            }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayAchats = array();
        $i = 0;
        foreach ($products as $key => $value) {
           // $arrayAchats [$i] [] = $value ['id'];
            $reglement = $this->getTotalReglementByAchat($value ['id']);
            $arrayAchats [$i] [] = $value ['regle'];
            $arrayAchats [$i] [] = $value ['numero'];
            $arrayAchats [$i] [] = $value ['dateAchat'];
            $arrayAchats [$i] [] = $value ['nom'];
            $arrayAchats [$i] [] = $value ['poidsTotal'];
            $arrayAchats [$i] [] = $value ['montantTotal'];
            $reliquat = floatval($value ['montantTotal']) - floatval($reglement);
            $arrayAchats [$i] [] = $reliquat;
            $i++;
        }
        return $arrayAchats;
    }

 
    public function retrieveAllReglements($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            
            $sql = 'select achat.id,regle,dateAchat, numero, nom
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'select achat.id, regle,dateAchat, numero, nom
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayAchats = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayAchats [$i] [] = $value ['id'];
            $arrayAchats [$i] [] = $value ['regle'];
            $arrayAchats [$i] [] = $value ['dateAchat'];
            $arrayAchats [$i] [] = $value ['numero'];
            $arrayAchats [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayAchats;
    }

  

     public function findById($achatId) {
            if ($achatId != null) {
                    return Bootstrap::$entityManager->find('Achat\Achat', $achatId);
            }
	}
        
        public function count($typeAchat, $codeUsine, $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if ($codeUsine !== '*') {
            if ($typeAchat !== '*') {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status=' . $typeAchat . ' and codeUsine="' . $codeUsine . '" ' . $sWhere . '';
            } else {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and codeUsine="' . $codeUsine . '" ' . $sWhere . '';
            }
        } else {
            if ($typeAchat !== '*') {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status=' . $typeAchat . ' ' . $sWhere . '';
            } else {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id ' . $sWhere . '';
            }
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbAchats'];
    }
        
          public function countInventaires($mareyeurId,$dateDebut, $dateFin, $regle, $codeUsine, $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($dateDebut=='')
            $dateDebut="1900-01-01";
        if($dateFin=="")
            $dateFin="2900-01-01";
        if($dateDebut=="")
            $dateDebut="1900-01-01";
        if($dateFin=="")
            $dateFin="2900-01-01";
        $sqlMareyeur="";
        if($mareyeurId!="*"){
            $sqlMareyeur.=" and mareyeur.id=$mareyeurId";
        }
        if ($codeUsine !== '*') {
            if ($regle !== '*') {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id  and regle=' . $regle . ' and codeUsine="' . $codeUsine . '" and montantTotal<>0.00  '.$sqlMareyeur.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' ';
            } else {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and codeUsine="' . $codeUsine . '" '.$sqlMareyeur.' and  montantTotal<>0.00 and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' ';
            }
        } else {
            if ($regle !== '*') {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and regle=' . $regle . ' and  montantTotal<>0.00 '.$sqlMareyeur.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . '  ';
            } else {
                $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id '.$sqlMareyeur.' and  montantTotal<>0.00 and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . '';
            }
        }

        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbAchats'];
    }

    public function countReglements($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status=1 and codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur where mareyeur.id=achat.mareyeur_id and status=1 ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbAchats'];
    }
    
    
    public function getLastNumberAchat($codeUsine) {
        $sql = 'select max(id)+1 as lastAchats from achat where codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastAchat = $stmt->fetch();
        return $lastAchat['lastAchats'];
    }
    
    public function validAchat($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Achat\Achat a set a.status=1 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function annulerAchat($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Achat\Achat a set a.status=2 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function modifReglement($achatId, $status) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Achat\Achat a set a.regle=$status WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function findValidAchatByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    public function findValidAchatByUsineGerant($login,$codeUsine) {
    	$sql = 'SELECT COUNT(achat.status) AS nb FROM achat,mareyeur, utilisateur WHERE achat.login=utilisateur.login and utilisateur.profil_id=4
    			          and achat.login="' . $login . '"  and mareyeur.id=mareyeur_id and achat.status=1 AND codeUsine="'.$codeUsine.'"';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$Achat = $stmt->fetch();
    	return $Achat['nb'];
    }
    
    public function findNonValidAchatByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat,mareyeur WHERE mareyeur.id=mareyeur_id and STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    public function findNonValidAchatByUsineGerant($login,$codeUsine) {
    	$sql = 'SELECT COUNT(achat.status) AS nb FROM achat,mareyeur, utilisateur WHERE achat.login=utilisateur.login and utilisateur.profil_id=4  
    			          and achat.login="' . $login . '"  and mareyeur.id=mareyeur_id and achat.status=0 AND codeUsine="'.$codeUsine.'"';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$Achat = $stmt->fetch();
    	return $Achat['nb'];
    }
    public function findAchatAnnulerByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat,mareyeur WHERE mareyeur.id=mareyeur_id and STATUS=2 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findAchatAnnulerByUsineGerant($login,$codeUsine) {
    	$sql = 'SELECT COUNT(achat.status) AS nb FROM achat,mareyeur, utilisateur WHERE achat.login=utilisateur.login and utilisateur.profil_id=4
    			          and achat.login="' . $login . '"  and mareyeur.id=mareyeur_id and achat.status=2 AND codeUsine="'.$codeUsine.'"';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$Achat = $stmt->fetch();
    	return $Achat['nb'];
    }
    public function findRegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM achat,mareyeur WHERE mareyeur.id=mareyeur_id and regle=2 AND status=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findNonRegleByUsine($codeUsine) {
            $sql = 'SELECT COUNT(regle) AS nb FROM achat WHERE regle=0 AND status=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findARegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM achat WHERE regle=1 AND status=1 AND  codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findReglementByAchat($achatId) {
        if ($achatId != null) {
            $sql = 'SELECT datePaiement, avance FROM reglement_achat WHERE achat_id=' . $achatId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    public function getTotalReglementByAchat($achatId) {
        if ($achatId != null) {
            $sql = 'SELECT SUM(avance) sommeAvance FROM reglement_achat WHERE achat_id=' . $achatId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            return $achat[0];
        }
    }
    
     public function findAchatDetails($achatId) {
        if ($achatId != null) {
            $sql = 'SELECT * from achat, mareyeur where mareyeur.id=achat.mareyeur_id and achat.id=' . $achatId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    public function findAllProduitByAchact($achatId) {
        if ($achatId != null) {
            $sql = 'SELECT la.id, p.libelle designation,la.prixUnitaire prixUnitaire,la.quantite quantite,la.montant montant FROM achat a, ligne_achat la, produit p WHERE a.id=la.achat_id AND la.produit_id=p.id AND a.id=' . $achatId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    /***
     * recuperer les infos de l'achat pour la validation
     */
    public function findInfoByAchact($achatId) {
        if ($achatId != null) {
            $sql = 'SELECT produit_id, codeUsine,quantite, login FROM ligne_achat, achat WHERE achat.id=achat_id AND achat.id=' . $achatId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    public function delete($achatId) {
        $achat = $this->findById($achatId);
        if ($achat != null && $achat->getStatus()==2) {
            Bootstrap::$entityManager->remove($achat);
            Bootstrap::$entityManager->flush();
            return $achat;
        } else {
            return null;
        }
    }
    
    public function getInfoMontantTotal($mareyeurId, $typeAchat, $dateDebut, $dateFin, $codeUsine) {
        if($dateDebut=='')
            $dateDebut="1900-01-01";
        if($dateFin=="")
            $dateFin="2900-01-01";
        if($dateDebut=="")
            $dateDebut="1900-01-01";
        if($dateFin=="")
            $dateFin="2900-01-01";
        $sqlMareyeur="";
        if($mareyeurId!="*"){
            $sqlMareyeur.=" and mareyeur_id=$mareyeurId";
        }
        if($typeAchat=='*')
            $sql = 'SELECT SUM(montantTotal) montantTotal FROM achat a WHERE montantTotal<>0.00 '.$sqlMareyeur.' and codeUsine="'.$codeUsine.'"  and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ';
        else
            $sql = 'SELECT SUM(montantTotal) montantTotal FROM achat a WHERE regle='.$typeAchat.' and  montantTotal<>0.00 '.$sqlMareyeur.' and codeUsine="'.$codeUsine.'"  and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $infos = $stmt->fetch();
        return $infos;
    }
    
    public function getInfoPoidsTotal($mareyeurId, $typeAchat, $dateDebut, $dateFin, $codeUsine) {
        if($dateDebut=='')
            $dateDebut="1900-01-01";
        if($dateFin=="")
            $dateFin="2900-01-01";
        if($dateDebut=="")
            $dateDebut="1900-01-01";
        if($dateFin=="")
            $dateFin="2900-01-01";
        $sqlMareyeur="";
        if($mareyeurId!="*"){
            $sqlMareyeur.=" and mareyeur_id=$mareyeurId";
        }
        if($typeAchat=='*') {
            $sql = 'SELECT SUM(poidsTotal) poidsTotal FROM achat WHERE status=1 AND poidsTotal<>0.00 and montantTotal<>0.00 and codeUsine="'.$codeUsine.'" '.$sqlMareyeur.'  and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'"';
        }else {
             $sql ='SELECT SUM(poidsTotal) poidsTotal FROM achat WHERE STATUS=1 AND regle='.$typeAchat.'
							      AND poidsTotal<>0.00 and montantTotal<>0.00  and codeUsine="'.$codeUsine.'" '.$sqlMareyeur.'  and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'"';
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$infos = $stmt->fetch();
    	return $infos;
    }
    
    
    public function retrieveAllAchatGerant($login, $codeUsine, $offset, $rowCount, $orderBy = "", $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if ($codeUsine !== '*') {

            $sql = 'select distinct achat.id,achat.status, dateAchat, numero, nom
                    from achat, mareyeur, utilisateur WHERE achat.login=utilisateur.login and utilisateur.profil_id=4  and achat.login="' . $login . '"
                     and mareyeur.id=achat.mareyeur_id and codeUsine="' . $codeUsine . '" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount . '';
        } else {

            $sql = 'select distinct achat.id, status, dateAchat, numero, nom
                    from achat, mareyeur, utilisateur WHERE mareyeur.id=achat.mareyeur_id  and achat.login=utilisateur.login and utilisateur.profil_id=4 and achat.login="' . $login . '"' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount . '';
        }
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayAchats = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayAchats [$i] [] = $value ['id'];
            $arrayAchats [$i] [] = $value ['status'];
            $arrayAchats [$i] [] = $value ['dateAchat'];
            $arrayAchats [$i] [] = $value ['numero'];
            $arrayAchats [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayAchats;
    }
    
     public function countAllAchatGerant($login, $codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'select count(distinct achat.id) as nbAchats
                    from achat, mareyeur, utilisateur WHERE mareyeur.id=achat.mareyeur_id and achat.login=utilisateur.login and utilisateur.profil_id=4  and achat.login="' . $login . '" and codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'select count(achat.id) as nbAchats
                    from achat, mareyeur, utilisateur WHERE mareyeur.id=achat.mareyeur_id and achat.login=utilisateur.login and utilisateur.profil_id=4  and achat.login="' . $login . '" ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbAchats'];
    }

}
