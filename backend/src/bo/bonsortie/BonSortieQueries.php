<?php

namespace BonSortie;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;
use Log\Loggers as Logger;

class BonSortieQueries {
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
        $this->logger = new Logger(__NAMESPACE__);
    }

    public function insert($sortie) {
        if ($sortie != null) {
            Bootstrap::$entityManager->persist($sortie);
            Bootstrap::$entityManager->flush();
            return $sortie;
        }
    }

    public function delete($bonId) {
        $bon = $this->findById($bonId);
        if ($bon != null && $bon->getStatus() == 2) {
            Bootstrap::$entityManager->remove($bon);
            Bootstrap::$entityManager->flush();
            return $bon;
        } else {
            return null;
        }
    }

    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

    public function retrieveAll($status, $codeUsine, $offset, $rowCount, $orderBy = "", $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if ($codeUsine !== '*') {
            $sql = 'SELECT bon_sortie.id,status,dateBonSortie, numeroBonSortie,totalColis, poidsTotal FROM bon_sortie WHERE status='.$status.' and codeUsine="' . $codeUsine . '" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount . '';
        } else {

            $sql = 'SELECT bon_sortie.id,status,dateBonSortie, numeroBonSortie,totalColis, poidsTotal FROM bon_sortie where status='.$status.' ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount . '';
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
            $arrayAchats [$i] [] = $value ['dateBonSortie'];
            $arrayAchats [$i] [] = $value ['numeroBonSortie'];
            $arrayAchats [$i] [] = $value ['totalColis'];
            $arrayAchats [$i] [] = $value ['poidsTotal'];
            $i++;
        }
        return $arrayAchats;
    }

    public function retrieveAllEntree($codeUsineDest, $codeUsineOrigine, $offset, $rowCount, $orderBy = "", $sWhere = "") {

        if ($codeUsineOrigine !== '*') {
            $sql = 'SELECT bon_sortie.id,status,dateBonSortie, numeroBonSortie,totalColis, poidsTotal FROM bon_sortie WHERE destination="' . $codeUsineDest . '" and origine="' . $codeUsineOrigine . '" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount . '';
        } else {
            if ($sWhere !== "")
                $sWhere = " where " . $sWhere;
            $sql = 'SELECT bon_sortie.id,status,dateBonSortie, numeroBonSortie,totalColis, poidsTotal FROM bon_sortie where destination="' . $codeUsineDest . '"  ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount . '';
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
            $arrayAchats [$i] [] = $value ['dateBonSortie'];
            $arrayAchats [$i] [] = $value ['numeroBonSortie'];
            $arrayAchats [$i] [] = $value ['totalColis'];
            $arrayAchats [$i] [] = $value ['poidsTotal'];
            $i++;
        }
        return $arrayAchats;
    }

    public function countEntree($codeUsineDest, $codeUsineOrigine, $sWhere = "") {

        if ($codeUsineOrigine !== '*') {
            $sql = 'select count(bon_sortie.id) as nb
                    from bon_sortie where destination="' . $codeUsineDest . '" and origine="' . $codeUsineOrigine . '" ' . $sWhere . '';
        } else {
            if ($sWhere !== "")
                $sWhere = " where " . $sWhere;
            $sql = 'select count(bon_sortie.id) as nb
                    from bon_sortie where destination="' . $codeUsineDest . '"  ' . $sWhere . '';
        }

        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbBon = $stmt->fetch();
        return $nbBon['nb'];
    }

    public function findById($bonId) {
        $query = Bootstrap::$entityManager->createQuery("select b from BonSortie\BonSortie b where b.id = :bonSortieId");
        $query->setParameter('bonSortieId', $bonId);
        $bonSortie = $query->getResult();
        if ($bonSortie != null)
            return $bonSortie[0];
        else
            return null;
    }

    public function count($status, $codeUsine, $sWhere = "") {
        if ($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if ($codeUsine !== '*') {
            $sql = 'select count(bon_sortie.id) as nb
                    from bon_sortie where codeUsine="' . $codeUsine . '"  and status='.$status.' '  . $sWhere . '';
        } else {
//             if($sWhere !== "")
//            $sWhere = " where " . $sWhere;
            $sql = 'select count(bon_sortie.id) as nb
                    from bon_sortie where status='.$status.' ' . $sWhere . '';
        }

        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbBon = $stmt->fetch();
        return $nbBon['nb'];
    }

    public function getLastNumberBonSortie($codeUsine) {
        $sql = 'select max(id)+1 as lastNumber from bon_sortie where codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastNumber = $stmt->fetch();
        return $lastNumber['lastNumber'];
    }

    public function validBon($sortieId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE BonSortie\BonSortie a set a.status=1 WHERE a.id IN( '$sortieId')");
        return $query->getResult();
    }

    public function annulerBonSortie($sortieId) {
        $this->logger->log->trace('debut annulation bon de sortie ');
        Bootstrap::$entityManager->getConnection()->beginTransaction();
        try {
            $this->logger->log->trace('recuperation des elements du bon de sortie ');
            $bonSortie = $this->findById($sortieId);
            $this->logger->log->trace('Fin recuperation des elements du bon de sortie ');
            $codeUsineOrigine = $bonSortie->getOrigine();
            $codeUsineDestination = $bonSortie->getDestination();
            $this->logger->log->trace('codeUsine Origine ' . $codeUsineOrigine);
            $this->logger->log->trace('codeUsine Destination ' . $codeUsineDestination);
            $this->logger->log->trace('recuperation des elements de la ligne bon de sortie ');
            $sortie = $this->findInfoByBonSortie($sortieId);
            $this->logger->log->trace('Fin recuperation des elements de la ligne bon de sortie ');
            $connexion = Bootstrap::$entityManager->getConnection();
            foreach ($sortie as $key => $value) {
                $this->logger->log->trace('traitement du produit id ' . $value ['produit_id']);
                $stockManager = new \Stock\StockManager();
                $this->logger->log->trace('recuperation de la quantite reel du produit id ' . $value ['produit_id']);
                $quantiteReel = $stockManager->findQuantiteReelByProduitId($value ['produit_id'], $codeUsineDestination);
                $this->logger->log->trace('Quantite reelle recupereree . la valeur est ' . $quantiteReel);
                /// if ($quantiteReel !== 0) {
                $this->logger->log->trace('Quantite reel different de 0');
                $quantite = $value ['quantite'];
                $produitId = $value ['produit_id'];
                $this->logger->log->trace(' debut destockage du produit id ' . $value ['produit_id']);
                $connexion->executeUpdate("UPDATE stock_reel SET stock = stock - $quantite WHERE produit_id = $produitId AND codeUsine='" . $codeUsineDestination . "'");
                $this->logger->log->trace(' fin destockage du produit id ' . $value ['produit_id']);
                $this->logger->log->trace(' debut stockage du produit id ' . $value ['produit_id']);
                $connexion->executeUpdate("UPDATE stock_reel SET stock = stock + $quantite WHERE produit_id = $produitId AND codeUsine='" . $codeUsineOrigine . "'");
                $this->logger->log->trace(' fin stockage du produit id ' . $value ['produit_id']);
            }
            $infosColis = $this->findInfoColisByBonSortie($sortieId);
            foreach ($infosColis as $key => $val) {
                $produitId = $val['produit_id'];
                $quantiteParCarton = $val['quantiteParCarton'];
                $nombreCarton = $val['nombreCarton'];
                $this->logger->log->trace('traitement colisage du produit id ' . $val ['produit_id']);
                $this->logger->log->trace(' debut suppression stock sortie du produit id ' . $value ['produit_id']);
                $connexion->executeUpdate('delete  FROM stock_sortie where produitId = "' . $produitId . '" and sortieId="' . $sortieId . '"');
                $this->logger->log->trace(' fin suppression stock sortie du produit id ' . $value ['produit_id']);
                $this->logger->log->trace(' debut suppression stock entree du produit id ' . $value ['produit_id']);
                $connexion->executeUpdate('delete  FROM stock_entree where produitId = "' . $produitId . '" and sortieId="' . $sortieId . '"');
                $this->logger->log->trace(' fin suppression stock entree du produit id ' . $value ['produit_id']);
                $this->logger->log->trace(' debut dimunition colisage du produit id ' . $value ['produit_id']);
                $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton - $nombreCarton WHERE produitId = $produitId AND quantiteParCarton=$quantiteParCarton and codeUsine='$codeUsineDestination'");
                $this->logger->log->trace(' fin dimunition colisage du produit id ' . $value ['produit_id']);
                $this->logger->log->trace(' debut mis a jour colisage du produit id ' . $value ['produit_id']);
                $connexion->executeUpdate("UPDATE colisage SET nombreCarton = nombreCarton + $nombreCarton WHERE produitId = $produitId AND quantiteParCarton=$quantiteParCarton and codeUsine='$codeUsineOrigine'");
                $this->logger->log->trace(' fin mis a jour colisage du produit id ' . $value ['produit_id']);
            }
            $this->logger->log->trace(' debut annulation du bon sortie ' . $sortieId);
            $connexion->executeUpdate("UPDATE bon_sortie set status=2 WHERE status=1 and id IN( '$sortieId')");
            $this->logger->log->trace(' fin annulation du bon sortie  ' . $sortieId);
            Bootstrap::$entityManager->getConnection()->commit();
            return 1;
        } catch (\Exception $e) {
            $this->logger->log->error($e->getMessage());
            Bootstrap::$entityManager->getConnection()->rollback();
            Bootstrap::$entityManager->close();
            $b = new Bootstrap();
            Bootstrap::$entityManager = $b->getEntityManager();
            return null;
        }
    }

    public function findValidBonByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM bon_sortie WHERE STATUS=1 AND codeUsine="' . $codeUsine . '"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }

    public function findNonValidBonByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM bon_sortie WHERE STATUS=0 AND codeUsine="' . $codeUsine . '"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }

    public function findBonAnnulerByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM bon_sortie WHERE STATUS=2 AND codeUsine="' . $codeUsine . '"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }

    public function findQuantiteSortieByUsine($codeUsineOrigine) {
        $sql = 'SELECT SUM(poidsTotal) AS nb FROM bon_sortie WHERE STATUS=1 and origine="' . $codeUsineOrigine . '"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    public function findQuantiteSortieByUsineAnnule($codeUsineOrigine) {
    	$sql = 'SELECT SUM(poidsTotal) AS nb FROM bon_sortie WHERE STATUS=2 and origine="' . $codeUsineOrigine . '"';
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$Achat = $stmt->fetch();
    	return $Achat['nb'];
    }

    public function findQuantiteEntreeByUsine($codeUsineDest) {
        $sql = 'SELECT SUM(poidsTotal) AS nb FROM bon_sortie WHERE STATUS=1 and destination="' . $codeUsineDest . '" ';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }

    public function findBonDetails($sortieId) {
        if ($sortieId != null) {
            $sql = 'SELECT * from bon_sortie where bon_sortie.id=' . $sortieId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $sortie = $stmt->fetchAll();
            if ($sortie != null)
                return $sortie;
            else
                return null;
        }
    }

    public function findAllProduitByBon($sortieId) {
        if ($sortieId != null) {
            $sql = 'SELECT p.id, p.libelle designation, al.quantite quantite FROM bon_sortie a, ligne_bonsortie al, produit p WHERE a.id=al.bonsortie_id AND al.produit_id=p.id AND a.id=' . $sortieId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $sortie = $stmt->fetchAll();
            if ($sortie != null)
                return $sortie;
            else
                return null;
        }
    }

    /*     * *
     * recuperer les infos de l'achat pour la validation
     */

    public function findInfoByBonSortie($sortieId) {
        if ($sortieId != null) {
            $sql = 'SELECT produit_id, codeUsine,quantite FROM ligne_bonsortie lb, bon_sortie b WHERE b.id=bonsortie_id  AND b.id=' . $sortieId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }

    public function isBonSortieExist($numero, $codeUsine) {
        $sql = 'SELECT * FROM bon_sortie WHERE numeroBonSortie=' . $numero. ' and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $bon = $stmt->fetchAll();
        if ($bon != null)
            return $bon;
        else
            return null;
    }

    public function findInfoColisByBonSortie($sortieId) {
        if ($sortieId != null) {
            $sql = 'SELECT produit_id, nombreCarton,quantiteParCarton FROM ligne_colis_bonsortie WHERE bonsortie_id=' . $sortieId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }

    public function listbonValid() {
        $query = Bootstrap::$entityManager->createQuery("select b.id as value, b.numeroBonSortie as text from BonSortie\BonSortie b where b.status=1");
        $types = $query->getResult();
        if ($types != null)
            return $types;
        else
            return null;
    }

    public function findInfoColisages($colisageId) {
        $sql = 'SELECT b.id as bid, nom, origine, poidsTotal FROM bon_sortie b, CLIENT c WHERE b.client_id=c.id AND b.id=' . $colisageId;
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colisages = $stmt->fetchAll();
        if ($colisages != null)
            return $colisages;
        else
            return null;
    }

    public function retrouveInfoProduitParBon($colisageId) {
        $sql = 'SELECT b.id as bid, nom, origine FROM bon_sortie b, CLIENT c WHERE b.client_id=c.id AND b.id=' . $colisageId;
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colisages = $stmt->fetchAll();
        if ($colisages != null)
            return $colisages;
        else
            return null;
    }

}
