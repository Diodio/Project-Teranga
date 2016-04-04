<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;
use Log\Loggers as Logger;

class DemoulageQueries {
    /*
     *
     */

    private $entityManager;
    private $classString;
    private $logger;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
        $this->classString = 'Demoulage\Demoulage';
        $this->logger = new Logger(__NAMESPACE__);
    }

    public function insert($demoulage, $listCarton, $listColisage) {
        $this->logger->log->trace('insert contact ');
        Bootstrap::$entityManager->getConnection()->beginTransaction();
        if ($demoulage != null) {
            try {
                Bootstrap::$entityManager->persist($demoulage);
                Bootstrap::$entityManager->flush();
                if ($listCarton != null) {
                    foreach ($listCarton as $carton) {
                        Bootstrap::$entityManager->persist($carton);
                        Bootstrap::$entityManager->flush();
                    }
                }
                if ($listColisage != null) {
                    foreach ($listColisage as $colisage) {
                        if ($colisage->getId() == null)
                            Bootstrap::$entityManager->persist($colisage);
                        else
                            Bootstrap::$entityManager->merge($colisage);
                        Bootstrap::$entityManager->flush();
                    }
                }
                $produitId = $demoulage->getProduit()->getId();
                $codeUsine = $demoulage->getCodeUsine();
                $login = $demoulage->getLogin();
                $quantiteDemoulee = $demoulage->getQuantiteDemoulee();
                $connexion = Bootstrap::$entityManager->getConnection();
                $stockManager = new \Stock\StockManager();
                $idStock = $stockManager->findStockReelByProduitId($produitId, $codeUsine);
                if ($idStock == 0) {
                    $stockReel = new \Stock\StockReel();
                    $stockReel->setCodeUsine($codeUsine);
                    $stockReel->setLogin($login);
                    $produitManger = new \Produit\ProduitManager();
                    $produit = $produitManger->findById($produitId);
                    $stockReel->setProduit($produit);
                    $stockReel->setStock($quantiteDemoulee);
                    $seuil = ($quantiteDemoulee * 25) / 100;
                    $stockReel->setSeuil($seuil);
                    Bootstrap::$entityManager->persist($stockReel);
                    Bootstrap::$entityManager->flush();
                    //$this->insert($stockReel);
                } else {
                    $valueStock = $stockManager->getStockValueParProduit($produitId, $codeUsine);
                    $seuil = (($valueStock + $quantiteDemoulee) * 25 / 100);
                    $connexion->executeUpdate("UPDATE stock_reel SET stock = stock + $quantiteDemoulee, seuil=$seuil WHERE produit_id = $produitId AND codeUsine='" . $codeUsine . "'");
                    //$stockManager->updateNbStockReel($demoulage->getProduit()->getId(), $demoulage->getCodeUsine(), $quantiteDemoulee);
                    // $stockManager->updateSeuilStock($demoulage->getProduit()->getId(), $demoulage->getCodeUsine(), $seuil);
                }
                $connexion->executeUpdate("UPDATE stock_provisoire SET stock = stock - $quantiteDemoulee WHERE produit_id = $produitId AND codeUsine='" . $codeUsine . "'");
                //$this->resetStockProvisoire($demoulage->getProduit()->getId(), $demoulage->getCodeUsine(), $quantiteDemoulee);
                Bootstrap::$entityManager->getConnection()->commit();
                return $demoulage;
            } catch (\Exception $e) {
                $this->logger->log->error($e->getMessage());
                Bootstrap::$entityManager->getConnection()->rollback();
                Bootstrap::$entityManager->close();
                $b = new Bootstrap();
                Bootstrap::$entityManager = $b->getEntityManager();
                return null;
            }
        }
    }

    public function annulerDemoulageId($demoulageId,$produitId, $codeUsine, $quantiteDemoulee, $infoColis) {
        try{
            Bootstrap::$entityManager->getConnection()->beginTransaction();
            $connexion = Bootstrap::$entityManager->getConnection();
            $connexion->executeUpdate("UPDATE stock_provisoire SET stock = stock + $quantiteDemoulee WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
            $connexion->executeUpdate("UPDATE stock_reel SET stock = stock - $quantiteDemoulee WHERE produit_id = $produitId AND codeUsine='".$codeUsine."'");
            $connexion->executeUpdate("UPDATE demoulage set status=0 WHERE status=1 AND id IN( '$demoulageId')");
            foreach ($infoColis as $key => $value) {
                $nombreCarton=$value ['nombreCarton'];
                $quantiteParCarton=$value ['quantiteParCarton'];
                $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton - $nombreCarton  WHERE produitId = $produitId AND quantiteParCarton=$quantiteParCarton  AND codeUsine='$codeUsine'");
                    //$this->demoulageQueries->diminueCartonParDemoulageId($demoulageId, $value ['produitId'], $value ['nombreCarton'], $value ['quantiteParCarton'], $codeUsine);
                }
            Bootstrap::$entityManager->getConnection()->commit();
            return 1;
        }
        catch (\Exception $e) {
               // $this->logger->log->error($e->getMessage());
                Bootstrap::$entityManager->getConnection()->rollback();
                Bootstrap::$entityManager->close();
                $b = new Bootstrap();
                Bootstrap::$entityManager = $b->getEntityManager();
                return null;
            }
    }
    
    public function delete($demoulageId) {
        $demoulage = $this->findById($demoulageId);
        if ($demoulage != null && $demoulage->getStatus() == 0) {
            Bootstrap::$entityManager->remove($demoulage);
            Bootstrap::$entityManager->flush();
            return $demoulage;
        } else {
            return null;
        }
    }

    public function verifieDemoulage($produitId, $codeUsine) {
        $sql = 'SELECT id FROM demoulage where produit_id = "' . $produitId . '" and codeUsine="' . $codeUsine . '"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $demoulage = $stmt->fetchAll();
        if ($demoulage != null)
            return $demoulage[0];
        else
            return null;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function getAllColis($produitId, $codeUsine) {
        if ($codeUsine !== '*')
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM colisage c WHERE nombreCarton<>0 and c.codeUsine="' . $codeUsine . '" AND c.produitId=' . $produitId . ' GROUP BY quantiteParCarton';
        else
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM colisage c WHERE nombreCarton<>0 AND c.produit_id=' . $produitId . ' GROUP BY quantiteParCarton';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['nbCarton'];
            $arrayContact [$i] [] = $value ['quantiteParCarton'];
            $i ++;
        }
        return $arrayContact;
    }

    
    
    public function getAllColisDemoulage($demoulageId, $codeUsine) {
        if ($codeUsine !== '*')
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM carton c, demoulage d WHERE nombreCarton<>0 and d.id=c.demoulage_id AND d.codeUsine="' . $codeUsine . '" AND d.id=' . $demoulageId . ' GROUP BY quantiteParCarton';
        else
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM carton c, demoulage d WHERE nombreCarton<>0 and d.id=c.demoulage_id AND d.id=' . $demoulageId . ' GROUP BY quantiteParCarton';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['nbCarton'];
            $arrayContact [$i] [] = $value ['quantiteParCarton'];
            $i ++;
        }
        return $arrayContact;
    }

    public function getNbColis($produitId, $codeUsine) {
        $sql = 'SELECT SUM(nombreCarton) as nbCarton FROM colisage WHERE produitId=' . $produitId . ' and codeUsine="'.$codeUsine.'" ';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $demoulage = $stmt->fetchAll();
        if ($demoulage != null)
            return $demoulage;
        else
            return null;
    }
    
    
    public function verifieColisage($produitId, $nbCarton, $quantite, $codeUsine) {
        $sql = 'SELECT id FROM colisage WHERE quantiteParCarton=' . $quantite . ' AND produitId=' . $produitId . ' and nombreCarton>='.$nbCarton.' and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $demoulage = $stmt->fetch();
        if ($demoulage != null)
            return $demoulage;
        else
            return null;
    }

    public function getQuantiteColisage($produitId, $codeUsine) {
        $query = "SELECT SUM(nombreCarton) AS value, quantiteParCarton AS text FROM colisage c WHERE c.produitId='$produitId' and c.codeUsine='".$codeUsine."' and nombreCarton<>0 GROUP BY quantiteParCarton";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($query);
        $stmt->execute();
        $types = $stmt->fetchAll();
        if ($types != null)
            return $types;
        else
            return null;
    }

    public function retrieveAll($status, $codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if ($codeUsine !== "*") {
            if ($status !== "*")
                $sql = 'select distinct(d.id) as demoulageId, status, d.createdDate date, numero,p.libelle libelle, quantiteAvantDemoulage, quantiteDemoulee, codeUsine, p.id produitId, (SELECT SUM(nombreCarton) FROM carton WHERE d.id=carton.demoulage_id) as nbColis from demoulage d, produit p where d.produit_id=p.id and status<>0 and status ="' . $status . '" and d.codeUsine="' . $codeUsine . '" ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount . ' ';
            else {
                $sql = 'select distinct(d.id) as demoulageId, status, d.createdDate date, numero,p.libelle libelle, quantiteAvantDemoulage, quantiteDemoulee, codeUsine, p.id produitId, (SELECT SUM(nombreCarton) FROM carton WHERE d.id=carton.demoulage_id) as nbColis from demoulage d, produit p where d.produit_id=p.id and status<>0 and d.codeUsine="' . $codeUsine . '" ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount . ' ';
            }
        } else {
            if ($status !== "*")
                $sql = 'select distinct(d.id) as demoulageId, status, d.createdDate date, numero,p.libelle libelle, quantiteAvantDemoulage, quantiteDemoulee, codeUsine, p.id produitId, (SELECT SUM(nombreCarton) FROM carton WHERE d.id=carton.demoulage_id) as nbColis from demoulage d, produit p where d.produit_id=p.id status<>0 and  and status ="' . $status . '" ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount . ' ';
            else
                $sql = 'select distinct(d.id) as demoulageId, status, d.createdDate date, numero,p.libelle libelle, quantiteAvantDemoulage, quantiteDemoulee, codeUsine, p.id produitId, (SELECT SUM(nombreCarton) FROM carton WHERE d.id=carton.demoulage_id) as nbColis from demoulage d, produit p where status<>0 and d.produit_id=p.id ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount . ' ';
        }
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    
    public function retrieveAllAnnules($status, $codeUsine, $offset, $rowCount, $sOrder = "", $sWhere = "") {
    	if ($sWhere !== "")
    		$sWhere = " and " . $sWhere;
    	$sql = 'select distinct(d.id) as demoulageId, status, d.createdDate date, numero,p.libelle libelle, quantiteAvantDemoulage, quantiteDemoulee, codeUsine, p.id produitId, (SELECT SUM(nombreCarton) FROM carton WHERE d.id=carton.demoulage_id) as nbColis from demoulage d, produit p where d.produit_id=p.id and status =0 and d.codeUsine="' . $codeUsine . '" ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount . ' ';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$products = $stmt->fetchAll();
    	return $products;
    }

    public function countAll($status, $codeUsine, $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if ($codeUsine !== "*") {
            if ($status !== "*")
                $sql = 'select count(*) as nb from demoulage d, produit p where d.produit_id=p.id and status ="' . $status . '" and d.codeUsine="' . $codeUsine . '" ' . $sWhere . '';
            else
                $sql = 'select count(*) as nb from demoulage d, produit p where d.produit_id=p.id and d.codeUsine="' . $codeUsine . '" ' . $sWhere . '';
        }
        else {
            if ($status !== "*")
                $sql = 'select count(*) as nb from demoulage d, produit p where d.produit_id=p.id and status ="' . $status . '" ' . $sWhere . '';
            else {
                $sql = 'select count(*) as nb from demoulage d, produit p where d.produit_id=p.id ' . $sWhere . '';
            }
        }

        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nb'];
    }

    public function getLastNumber() {
        $sql = 'select max(id)+1 as last from demoulage';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastAchat = $stmt->fetch();
        return $lastAchat['last'];
    }

    public function findById($demoulageId) {
        if ($demoulageId != null) {
            return Bootstrap::$entityManager->find('Produit\Demoulage', $demoulageId);
        }
    }

    

    /*     * *
     * recuperer les infos de l'achat pour l'annuation
     */

    public function findInfoColisByDemoulage($demoulageId) {
        if ($demoulageId != null) {
            $sql = 'SELECT produitId, nombreCarton, quantiteParCarton FROM carton WHERE demoulage_id=' . $demoulageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $demou = $stmt->fetchAll();
            if ($demou != null)
                return $demou;
            else
                return null;
        }
    }

    public function diminueCartonParDemoulageId($demoulageId, $produitId, $nombreCarton, $quantiteParCarton, $codeUsine) {
        $connexion = Bootstrap::$entityManager->getConnection();
        return $connexion->executeUpdate("UPDATE carton SET nombreCarton = nombreCarton - $nombreCarton  WHERE demoulage_id=$demoulageId and produitId = $produitId AND quantiteParCarton=$quantiteParCarton  AND codeUsine='$codeUsine'  AND nombreCarton > 0");
    }

}
