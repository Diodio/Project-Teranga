<?php

namespace Empotage;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class EmpotageQueries {
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
        $this->classString = 'Empotage\Empotage';
    }

   
    public function insert($empotage,$listConteneur,$jsonProduit,$jsonColis) {
        Bootstrap::$entityManager->getConnection()->beginTransaction();
        if ($empotage != null) {
            try {
                Bootstrap::$entityManager->persist($empotage);
                Bootstrap::$entityManager->flush();
                if ($listConteneur != null) {
                    foreach ($listConteneur as $conteneur) {
                        Bootstrap::$entityManager->persist($conteneur);
                        Bootstrap::$entityManager->flush();
                    }
                }
                
                foreach ($jsonProduit as $key => $ligne) {
                        if (isset($ligne["nColis"])) {
                            if ($ligne["nColis"] !== "" && $ligne["designation"] !== "") {
                                $ligneEmpotage = new \Empotage\LigneEmpotage;
                                $ligneEmpotage->setEmpotage($empotage);
                                $ligneEmpotage->setNbColis($ligne["nColis"]);
                                $ligneEmpotage->setProduit_id($ligne["produitId"]);
                                $ligneEmpotage->setQuantite($ligne["pnet"]);
                                Bootstrap::$entityManager->persist($ligneEmpotage);
                                Bootstrap::$entityManager->flush();
//                                if ($inserted->getId() != null) {
//                                    $stockEmpotagee = new \Stock\StockEmpotage();
//                                    $stockEmpotagee->setEmpotageId($empotageAdded->getId());
//                                    $stockEmpotagee->setProduitId($ligne["produitId"]);
//                                    $stockEmpotagee->setQuantiteEmpotagee($ligne["pnet"]);
//                                    $stockManager = new \Stock\StockManager();
//                                    $stockManager->insert($stockEmpotagee);
                                   // $stockManager->destockageReel($ligne["produitId"], $request['codeUsine'], $ligne["pnet"]);
                                $nbStock=$ligne["pnet"];
                                $produitId=$ligne["produitId"];
                                $codeUsine=$empotage->getCodeUsine();
                                $connexion=Bootstrap::$entityManager->getConnection();
                                $connexion->executeUpdate("UPDATE stock_reel SET stock = stock - $nbStock WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
                              //  }
                            }
                        }
                    }
                $jsonColis = json_decode($_POST['jsonColis'], true);
                    foreach ($jsonColis as $key => $ligneC) {
                        if (isset($ligneC["nbColis"])) {
                            if ($ligneC["nbColis"] !== "" && $ligneC["qte"] !== "") {
                                $colis = new \Empotage\LigneColis();
                                $colis->setNombreCarton($ligneC["nbColis"]);
                                $colis->setQuantiteParCarton($ligneC["qte"]);
                                $colis->setProduitId($ligneC["produitId"]);
                                $colis->setEmpotage_id($empotage->getId());
                                //$ligneColisManager = new \Empotage\LigneColisManager;
                                Bootstrap::$entityManager->persist($colis);
                                Bootstrap::$entityManager->flush();
                               // if ($inserted->getId() != null) {
                               //     $ligneColisManager->dimunieColisEmpotagee($ligneC["produitId"], $ligneC["qte"], $ligneC["nbColis"], $request['codeUsine']);
                                $connexion=Bootstrap::$entityManager->getConnection();
                                $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton - ".$ligneC["nbColis"]." WHERE produitId = ".$ligneC["produitId"]." AND quantiteParCarton=".$ligneC["qte"]." and codeUsine='".$empotage->getCodeUsine()."'");

                              //  }
                            }
                        }
                    }
                Bootstrap::$entityManager->getConnection()->commit();
                return $empotage;
            } catch (\Exception $e) {
                //$this->logger->log->error($e->getMessage());
                Bootstrap::$entityManager->getConnection()->rollback();
                Bootstrap::$entityManager->close();
                $b = new Bootstrap();
                Bootstrap::$entityManager = $b->getEntityManager();
                return null;
            }
        }
    }

    public function update($empotage, $listLigneEmpotage) {
        Bootstrap::$entityManager->getConnection()->beginTransaction();
        if ($empotage != null) {
            try {
                Bootstrap::$entityManager->merge($empotage);
                Bootstrap::$entityManager->flush();
                if ($listLigneEmpotage != null) {
                    foreach ($listLigneEmpotage as $ligneEmpotage) {
                        Bootstrap::$entityManager->merge($ligneEmpotage);
                        Bootstrap::$entityManager->flush();
                    }
                }
                Bootstrap::$entityManager->getConnection()->commit();
                return $empotage;
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

   
    public function retrieveAll($codeUsine,$etat,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            
            $sql = 'SELECT empotage.id, empotage.status, date, numero, nom FROM empotage, client WHERE status<>0 and etat="'.$etat.'"  and empotage.client_id =client.id  AND empotage.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'SELECT empotage.id, empotage.status, date, numero, nom FROM empotage, client WHERE status<>0 and etat="'.$etat.'" and empotage.client_id =client.id ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayEmpotages = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayEmpotages [$i] [] = $value ['id'];
            $arrayEmpotages [$i] [] = $value ['status'];
            $arrayEmpotages [$i] [] = $value ['date'];
            $arrayEmpotages [$i] [] = $value ['numero'];
            $arrayEmpotages [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayEmpotages;
    }
    
    public function retrieveAllEmpotageAnnules($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
    	if($sWhere !== "")
    		$sWhere = " and " . $sWhere;
    	$sql = 'SELECT empotage.id, empotage.status, date, numero, nom FROM empotage, client WHERE status=0 and  empotage.client_id =client.id  AND empotage.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    	$sql = str_replace("`", "", $sql);
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$products = $stmt->fetchAll();
    	$arrayEmpotages = array();
    	$i = 0;
    	foreach ($products as $key => $value) {
    		$arrayEmpotages [$i] [] = $value ['id'];
    		$arrayEmpotages [$i] [] = $value ['status'];
    		$arrayEmpotages [$i] [] = $value ['date'];
    		$arrayEmpotages [$i] [] = $value ['numero'];
    		$arrayEmpotages [$i] [] = $value ['nom'];
    		$i++;
    	}
    	return $arrayEmpotages;
    }

 
    public function retrieveAllReglements($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            
            $sql = 'SELECT empotage.id, empotage.regle, date, numero, nom FROM empotage, client WHERE empotage.client_id = client.id AND empotage.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'SELECT empotage.id, empotage.regle, date, numero, nom FROM empotage,client WHERE empotage.client_id = client.id ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
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
            $arrayAchats [$i] [] = $value ['date'];
            $arrayAchats [$i] [] = $value ['numero'];
            $arrayAchats [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayAchats;
    }

     public function findById($empotageId) {
            if ($empotageId != null) {
                    return Bootstrap::$entityManager->find('Empotage\Empotage', $empotageId);
            }
    }
    public function count($codeUsine, $etat, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'SELECT count(*) as nbEmpotages FROM empotage, client WHERE empotage.client_id =client.id and etat="'.$etat.'" AND empotage.codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'SELECT count(*) as nbEmpotages  FROM empotage, client WHERE and etat="'.$etat.'" and empotage.client_id = client.id ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbEmpotages'];
    }
    
    
    public function countEmpotageAnnules($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'SELECT count(*) as nbEmpotages FROM empotage, client WHERE empotage.client_id =client.id and empotage.status=0 AND empotage.codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'SELECT count(*) as nbEmpotages  FROM empotage, client WHERE empotage.client_id = client.id and empotage.status=0 ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbEmpotages'];
    }
    
    public function getLastNumberEmpotage($codeUsine) {
        $sql = 'select max(id)+1 as last from empotage where codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastEmpotage = $stmt->fetch();
        return $lastEmpotage['last'];
    }
    
    public function validEmpotage($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Empotage\Empotage a set a.status=1 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function annulerEmpotage($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Empotage\Empotage a set a.status=0 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function findValidEmpotageByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM empotage WHERE STATUS=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Empotage = $stmt->fetch();
        return $Empotage['nb'];
    }
    
    public function findNonValidEmpotageByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM empotage WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Empotage = $stmt->fetch();
        return $Empotage['nb'];
    }
    public function findEmpotageAnnulerByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM empotage WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Empotage = $stmt->fetch();
        return $Empotage['nb'];
    }
     public function findRegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM empotage WHERE regle=2 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findNonRegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM empotage WHERE regle=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findARegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM empotage WHERE regle=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
     public function findEmpotageDetails($empotageId) {
        if ($empotageId != null) {
            $sql = 'SELECT * from empotage, client where empotage.client_id =client.id and empotage.id=' . $empotageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $empotage = $stmt->fetchAll();
            if ($empotage != null)
                return $empotage;
            else
                return null;
        }
    }
    
    public function findAllProduitByEmpotage($empotageId) {
        if ($empotageId != null) {
            $sql = 'SELECT lf.id, nbColis, libelle, prixUnitaire, quantite, montant FROM ligne_empotage lf, empotage f,produit p WHERE f.id=lf.empotage_id AND p.id = lf.produit_id AND f.id=' . $empotageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $empotage = $stmt->fetchAll();
            if ($empotage != null)
                return $empotage;
            else
                return null;
        }
    }
     public function findColisByEmpotage($empotageId) {
        if ($empotageId != null) {
            $sql = 'SELECT libelle,nombreCarton, quantiteParCarton FROM ligne_colis,produit WHERE produitId=produit.id AND empotage_id=' . $empotageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $colis = $stmt->fetchAll();
            if ($colis != null)
                return $colis;
            else
                return null;
        }
    }
    public function findReglementByEmpotage($empotageId) {
        if ($empotageId != null) {
            $sql = 'SELECT datePaiement, avance FROM reglement_empotage WHERE empotage_id=' . $empotageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $empotage = $stmt->fetchAll();
            if ($empotage != null)
                return $empotage;
            else
                return null;
        }
    }
    
     public function findConteneurByEmpotage($empotageId) {
        if ($empotageId != null) {
            $sql = 'SELECT numConteneur, numPlomb FROM conteneur WHERE empotage_id=' . $empotageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $conteneur = $stmt->fetchAll();
            if ($conteneur != null)
                return $conteneur;
            else
                return null;
        }
    }
    
    public function getTotalReglementByEmpotage($empotageId) {
        if ($empotageId != null) {
            $sql = 'SELECT SUM(avance) sommeAvance FROM reglement_empotage WHERE empotage_id=' . $empotageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $empotage = $stmt->fetchAll();
            return $empotage[0];
        }
    }
    public function modifReglement($empotageId, $status) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Empotage\Empotage f set f.regle=$status WHERE f.id IN( '$empotageId')");
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
    
    public function findInfoByEmpotage($facturId) {
        if ($facturId != null) {
            $sql = 'SELECT produit_id,quantite FROM ligne_empotage WHERE empotage_id=' . $facturId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    public function findColisageByEmpotageId($empotageId) {
        if ($empotageId != null) {
            $sql = 'SELECT produitId, nombreCarton, quantiteParCarton FROM ligne_colis WHERE empotage_id=' . $empotageId;
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
    	$Empotage = $stmt->fetch();
    	return $Empotage['nb'];
    }
    
    public function getInfoMontantTotal($clientId,$typeEmpotage, $dateDebut, $dateFin, $codeUsine) {
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
    	if($typeEmpotage=='*')
    		$sql = 'SELECT SUM(montantHt * d.montant) montantTotal FROM empotage f, devise d WHERE f.devise=d.devise and status=1 and montantHt<>0.00 AND nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'" '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ';
    	else
    		$sql = 'SELECT SUM(montantHt  * d.montant) montantTotal FROM empotage f, devise d WHERE  f.devise=d.devise and status=1 AND regle='.$typeEmpotage.' and montantHt<>0.00 AND nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'"  '.$sqlClients.'  and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$infos = $stmt->fetch();
    	return $infos;
    }
    
    public function getInfoPoidsTotal($clientId,$typeEmpotage, $dateDebut, $dateFin, $codeUsine) {
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
    	if($typeEmpotage=='*'){
    		$sql = 'SELECT SUM(nbTotalPoids) poidsTotal FROM empotage WHERE status=1 and montantHt<>0.00 and  nbTotalPoids<>0.00 and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'"';
        } else   
    		$sql = 'SELECT SUM(nbTotalPoids) poidsTotal FROM empotage WHERE status=1 and montantHt<>0.00  AND nbTotalPoids<>0.00 and regle='.$typeEmpotage.' and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'"';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$infos = $stmt->fetch();
    	return $infos;
    }
    
    public function retrieveEmpotageInventaire($clientId,$dateDebut, $dateFin, $regle,$codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
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
    			$sql = 'select empotage.id,date_format(date, "'.\Common\Common::setFormatDate().'") as date, numero, nom,nbTotalPoids, montantHt montantTotal, regle, devise
                    from empotage, client where status=1 and client.id=empotage.client_id and montantHt<>0.00 AND nbTotalPoids<>0.00 and regle='.$regle.'  and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    		}
    		else {
                     $sql = 'select empotage.id,date_format(date, "'.\Common\Common::setFormatDate().'") as date, numero, nom,nbTotalPoids, montantHt montantTotal, regle, devise
                     from empotage, client where status=1 and client.id=empotage.client_id and montantHt<>0.00 AND nbTotalPoids<>0.00  and codeUsine="'.$codeUsine.'"  '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    		}
    	}
    	else {
    		if($regle !=='*'){
    			$sql = 'select empotage.id,date_format(date, "'.\Common\Common::setFormatDate().'") as date, numero, nom,nbTotalPoids, montantHt montantTotal, regle, devise
                    from empotage, client where status=1 and client.id=empotage.client_id and regle='.$regle.' and empotage.id=empotage_id and montantHt<>0.00 AND nbTotalPoids<>0.00  '.$sqlClients.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere .  ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
    		}
    		else {
    			$sql = 'select empotage.id, date_format(date, "'.\Common\Common::setFormatDate().'") as date, numero, nom,nbTotalPoids,montantHt montantTotal , regle, devise
                    from empotage, client where status=1 and client.id=empotage.client_id  and montantHt<>0.00 AND nbTotalPoids<>0.00  '.$sqlClients.' and date(dateAchat) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere .  ' group by numero ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
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
    		$reglement = $this->getTotalReglementByEmpotage($value ['id']);
    		$arrayAchats [$i] [] = $value ['regle'];
    		$arrayAchats [$i] [] = $value ['numero'];
    		$arrayAchats [$i] [] = $value ['date'];
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
                $sql = 'select count(empotage.id) as nbEmpotage
                    from empotage, client where status=1 and client.id=empotage.client_id and regle=' . $regle . ' and codeUsine="' . $codeUsine . '" and montantHt<>0.00 AND nbTotalPoids<>0.00 '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' ';
            } else {
                $sql = 'select count(empotage.id) as nbEmpotage
                    from empotage, client where status=1 and client.id=empotage.client_id and codeUsine="' . $codeUsine . '" AND montantHt<>0.00 AND nbTotalPoids<>0.00 '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . ' ';
            }
        } else {
            if ($regle !== '*') {
                $sql = 'select count(empotage.id) as nbEmpotage
                    from empotage, client where status=1 and client.id=empotage.client_id and regle=' . $regle . ' and montantHt<>0.00 AND nbTotalPoids<>0.00 '.$sqlClients.' and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . '  ';
            } else {
                $sql = 'select count(empotage.id) as nbEmpotage
                    from empotage, client where status=1 and client.id=empotage.client_id and montantHt<>0.00 AND nbTotalPoids<>0.00  '.$sqlClients.'  and date(date) between "'.$dateDebut.'" and "'.$dateFin.'" ' . $sWhere . '';
            }
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbEmpotage'];
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
