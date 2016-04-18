<?php

namespace Facture;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class FactureQueries {
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
        $this->classString = 'Facture\Facture';
    }

   
    public function insert($achat) {
        if ($achat != null) {
            Bootstrap::$entityManager->persist($achat);
            Bootstrap::$entityManager->flush();
            return $achat;
        }
    }

    public function update($facture, $listLigneFacture) {
        Bootstrap::$entityManager->getConnection()->beginTransaction();
        if ($facture != null) {
            try {
                Bootstrap::$entityManager->merge($facture);
                Bootstrap::$entityManager->flush();
                if ($listLigneFacture != null) {
                    foreach ($listLigneFacture as $ligneFacture) {
                        Bootstrap::$entityManager->merge($ligneFacture);
                        Bootstrap::$entityManager->flush();
                    }
                }
                Bootstrap::$entityManager->getConnection()->commit();
                return $facture;
            } catch (\Exception $e) {
                Bootstrap::$entityManager->getConnection()->rollback();
                Bootstrap::$entityManager->close();
                $b = new Bootstrap();
                Bootstrap::$entityManager = $b->getEntityManager();
                return null;
            }
        }
    }
    
    
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
    public function retrieveAll($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            
            $sql = 'SELECT facture.id, facture.status, dateFacture, numero, nom FROM facture, client WHERE status<>0 and  facture.client_id =client.id  AND facture.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'SELECT facture.id, facture.status, dateFacture, numero, nom FROM facture, client WHERE status<>0 and facture.client_id =client.id ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayFactures = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayFactures [$i] [] = $value ['id'];
            $arrayFactures [$i] [] = $value ['status'];
            $arrayFactures [$i] [] = $value ['dateFacture'];
            $arrayFactures [$i] [] = $value ['numero'];
            $arrayFactures [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayFactures;
    }
    
    public function retrieveAllFactureAnnules($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
    	if($sWhere !== "")
    		$sWhere = " and " . $sWhere;
    	$sql = 'SELECT facture.id, facture.status, dateFacture, numero, nom FROM facture, client WHERE status=0 and  facture.client_id =client.id  AND facture.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    	$sql = str_replace("`", "", $sql);
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$products = $stmt->fetchAll();
    	$arrayFactures = array();
    	$i = 0;
    	foreach ($products as $key => $value) {
    		$arrayFactures [$i] [] = $value ['id'];
    		$arrayFactures [$i] [] = $value ['status'];
    		$arrayFactures [$i] [] = $value ['dateFacture'];
    		$arrayFactures [$i] [] = $value ['numero'];
    		$arrayFactures [$i] [] = $value ['nom'];
    		$i++;
    	}
    	return $arrayFactures;
    }

 
    public function retrieveAllReglements($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            
            $sql = 'SELECT facture.id, facture.regle, dateFacture, numero, nom FROM facture, client WHERE facture.client_id = client.id AND facture.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'SELECT facture.id, facture.regle, dateFacture, numero, nom FROM facture,client WHERE facture.client_id = client.id ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
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
            $arrayAchats [$i] [] = $value ['dateFacture'];
            $arrayAchats [$i] [] = $value ['numero'];
            $arrayAchats [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayAchats;
    }

     public function findById($factureId) {
            if ($factureId != null) {
                    return Bootstrap::$entityManager->find('Facture\Facture', $factureId);
            }
    }
    public function count($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'SELECT count(*) as nbFactures FROM facture, client WHERE facture.client_id =client.id  AND facture.codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'SELECT count(*) as nbFactures  FROM facture, client WHERE facture.client_id = client.id ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbFactures'];
    }
    
    
    public function countFactureAnnules($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'SELECT count(*) as nbFactures FROM facture, client WHERE facture.client_id =client.id and facture.status=0 AND facture.codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'SELECT count(*) as nbFactures  FROM facture, client WHERE facture.client_id = client.id and facture.status=0 ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbFactures'];
    }
    
    public function getLastNumberFacture() {
        $sql = 'select max(id)+1 as last from facture';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastFacture = $stmt->fetch();
        return $lastFacture['last'];
    }
    
    public function validFacture($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Facture\Facture a set a.status=1 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function annulerFacture($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Facture\Facture a set a.status=0 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function findValidFactureByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM facture WHERE STATUS=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Facture = $stmt->fetch();
        return $Facture['nb'];
    }
    
    public function findNonValidFactureByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM facture WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Facture = $stmt->fetch();
        return $Facture['nb'];
    }
    public function findFactureAnnulerByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM facture WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Facture = $stmt->fetch();
        return $Facture['nb'];
    }
     public function findRegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM facture WHERE regle=2 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findNonRegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM facture WHERE regle=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findARegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM facture WHERE regle=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
     public function findFactureDetails($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT * from facture, client where facture.client_id =client.id and facture.id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $facture = $stmt->fetchAll();
            if ($facture != null)
                return $facture;
            else
                return null;
        }
    }
    
    public function findAllProduitByFacture($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT lf.id, nbColis, libelle produit, quantite,prixUnitaire,montant FROM ligne_facture lf, facture f,produit p WHERE f.id=lf.facture_id AND p.id = lf.produit AND f.id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $facture = $stmt->fetchAll();
            if ($facture != null)
                return $facture;
            else
                return null;
        }
    }
     public function findColisByFacture($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT libelle,nombreCarton, quantiteParCarton FROM ligne_colis,produit WHERE produitId=produit.id AND factureId=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $colis = $stmt->fetchAll();
            if ($colis != null)
                return $colis;
            else
                return null;
        }
    }
    public function findReglementByFacture($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT datePaiement, avance FROM reglement_facture WHERE facture_id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $facture = $stmt->fetchAll();
            if ($facture != null)
                return $facture;
            else
                return null;
        }
    }
    
     public function findConteneurByFacture($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT numConteneur, numPlomb FROM conteneur WHERE facture_id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $conteneur = $stmt->fetchAll();
            if ($conteneur != null)
                return $conteneur;
            else
                return null;
        }
    }
    
    public function getTotalReglementByFacture($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT SUM(avance) sommeAvance FROM reglement_facture WHERE facture_id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $facture = $stmt->fetchAll();
            return $facture[0];
        }
    }
    public function modifReglement($factureId, $status) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Facture\Facture f set f.regle=$status WHERE f.id IN( '$factureId')");
        return $query->getResult();
    }
    /***
     * recuperer les infos de l'achat pour la validation
     */
    public function findInfoByAchact($achatId) {
        if ($achatId != null) {
            $sql = 'SELECT produit_id, codeUsine,quantite FROM ligne_achat, achat WHERE achat.id=achat_id AND achat.id=' . $achatId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    public function findInfoByFacture($facturId) {
        if ($facturId != null) {
            $sql = 'SELECT produit,quantite FROM ligne_facture WHERE facture_id=' . $facturId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    public function findColisageByFactureId($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT produitId, nombreCarton, quantiteParCarton FROM ligne_colis WHERE factureId=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $colis = $stmt->fetchAll();
            if ($colis != null)
                return $colis;
            else
                return null;
        }
    }
    
    public function findStatisticAnnuleByUsine($codeUsine) {
    	$sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$Facture = $stmt->fetch();
    	return $Facture['nb'];
    }
    
    public function getInfoMontantTotal($clientId,$typeFacture, $dateDebut, $dateFin, $codeUsine) {
    	if($dateDebut=='')
    		$dateDebut="1900-01-01";
    	if($dateFin=="")
    		$dateFin="2900-01-01";
    	if($dateDebut=="")
    		$dateDebut="1900-01-01";
    	if($dateFin=="")
    		$dateFin="2900-01-01";
         $sqlClients="";
        if($clientId!="*"){
            $sqlClients.=" and client_id=$clientId";
        }
    	if($typeFacture=='*')
    		$sql = 'SELECT SUM(montantHt * d.montant) montantTotal FROM facture f, devise d WHERE f.devise=d.devise and status=1 and montantHt<>0.00 AND nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'" '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ';
    	else
    		$sql = 'SELECT SUM(montantHt  * d.montant) montantTotal FROM facture f, devise d WHERE  f.devise=d.devise and status=1 AND regle='.$typeFacture.' and montantHt<>0.00 AND nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'"  '.$sqlClients.'  and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$infos = $stmt->fetch();
    	return $infos;
    }
    
    public function getInfoPoidsTotal($clientId,$typeFacture, $dateDebut, $dateFin, $codeUsine) {
    	if($dateDebut=='')
    		$dateDebut="1900-01-01";
    	if($dateFin=="")
    		$dateFin="2900-01-01";
    	if($dateDebut=="")
    		$dateDebut="1900-01-01";
    	if($dateFin=="")
    		$dateFin="2900-01-01";
         $sqlClients="";
        if($clientId!="*"){
            $sqlClients.=" and client_id=$clientId";
        }
    	if($typeFacture=='*'){
    		$sql = 'SELECT SUM(nbTotalPoids) poidsTotal FROM facture WHERE status=1 and montantHt<>0.00 and  nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'"';
        } else   
    		$sql = 'SELECT SUM(nbTotalPoids) poidsTotal FROM facture WHERE status=1 and montantHt<>0.00  AND nbTotalPoids<>0.00 and regle='.$typeFacture.' and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'"';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$infos = $stmt->fetch();
    	return $infos;
    }
    
    public function retrieveFactureInventaire($clientId,$dateDebut, $dateFin, $regle,$codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
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
        
         $sqlClients="";
        if($clientId!="*"){
            $sqlClients.=" and client_id=$clientId";
        }
    	if($codeUsine !=='*') {
    		if($regle !=='*'){
    			$sql = 'select facture.id,date_format(dateFacture, "'.\Common\Common::setFormatDate().'") as dateFacture, numero, nom,nbTotalPoids, montantHt montantTotal, regle, devise
                    from facture, client where status=1 and client.id=facture.client_id and montantHt<>0.00 AND nbTotalPoids<>0.00 and regle='.$regle.'  and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    		}
    		else {
                     $sql = 'select facture.id,date_format(dateFacture, "'.\Common\Common::setFormatDate().'") as dateFacture, numero, nom,nbTotalPoids, montantHt montantTotal, regle, devise
                     from facture, client where status=1 and client.id=facture.client_id and montantHt<>0.00 AND nbTotalPoids<>0.00  and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    		}
    	}
    	else {
    		if($regle !=='*'){
    			$sql = 'select facture.id,date_format(dateFacture, "'.\Common\Common::setFormatDate().'") as dateFacture, numero, nom,nbTotalPoids, montantHt montantTotal, regle, devise
                    from facture, client where status=1 and client.id=facture.client_id and regle='.$regle.' and facture.id=facture_id and montantHt<>0.00 AND nbTotalPoids<>0.00  '.$sqlClients.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere .  ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    		}
    		else {
    			$sql = 'select facture.id, date_format(dateFacture, "'.\Common\Common::setFormatDate().'") as dateFacture, numero, nom,nbTotalPoids,montantHt montantTotal , regle, devise
                    from facture, client where status=1 and client.id=facture.client_id  and montantHt<>0.00 AND nbTotalPoids<>0.00  '.$sqlClients.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere .  ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
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
    		$reglement = $this->getTotalReglementByFacture($value ['id']);
    		$arrayAchats [$i] [] = $value ['regle'];
    		$arrayAchats [$i] [] = $value ['numero'];
    		$arrayAchats [$i] [] = $value ['dateFacture'];
    		$arrayAchats [$i] [] = $value ['nom'];
    		$arrayAchats [$i] [] = $value ['nbTotalPoids'];
                $montantDevise=$this->getMontantDevise($value['devise']);
    		$arrayAchats [$i] [] = floatval($value ['montantTotal']) * floatval($montantDevise);
    		$reliquat = floatval($value ['montantTotal']) - floatval($reglement);
    		$arrayAchats [$i] [] = $reliquat;
    		$i++;
    	}
    	return $arrayAchats;
    }
    
    public function countInventaires($clientId,$dateDebut, $dateFin, $regle, $codeUsine, $sWhere = "") {
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
         $sqlClients="";
        if($clientId!="*"){
            $sqlClients.=" and client_id=$clientId";
        }
        if ($codeUsine !== '*') {
            if ($regle !== '*') {
                $sql = 'select count(facture.id) as nbFacture
                    from facture, client where status=1 and client.id=facture.client_id and regle=' . $regle . ' and codeUsine="' . $codeUsine . '" and montantHt<>0.00 AND nbTotalPoids<>0.00 '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' ';
            } else {
                $sql = 'select count(facture.id) as nbFacture
                    from facture, client where status=1 and client.id=facture.client_id and codeUsine="' . $codeUsine . '" AND montantHt<>0.00 AND nbTotalPoids<>0.00 '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' ';
            }
        } else {
            if ($regle !== '*') {
                $sql = 'select count(facture.id) as nbFacture
                    from facture, client where status=1 and client.id=facture.client_id and regle=' . $regle . ' and montantHt<>0.00 AND nbTotalPoids<>0.00 '.$sqlClients.' and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . '  ';
            } else {
                $sql = 'select count(facture.id) as nbFacture
                    from facture, client where status=1 and client.id=facture.client_id and montantHt<>0.00 AND nbTotalPoids<>0.00  '.$sqlClients.'  and date(dateFacture) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . '';
            }
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbFacture'];
    }
    
    public function getMontantDevise($devise) {
    	$sql = 'SELECT montant FROM devise WHERE devise="'.$devise.'" ';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$devise = $stmt->fetch();
        if($devise!=null)
            return $devise['montant'];
        return null;
    }
}
