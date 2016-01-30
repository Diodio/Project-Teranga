<?php

namespace Utilisateur;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ProfilQueries {
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
        $this->classString = 'Utilisateur\Profil';
    }

    public function insert($profil) {
        if ($profil != null) {
            Bootstrap::$entityManager->persist($profil);
            Bootstrap::$entityManager->flush();
            return $profil;
        }
    }

    public function update($profil) {
        if ($profil != null) {
            Bootstrap::$entityManager->merge($profil);
            Bootstrap::$entityManager->flush();
            return $profil;
        }
    }

    public function delete($profilId) {
        $profil = $this->findById($profilId);
        if ($profil != null) {
            Bootstrap::$entityManager->remove($profil);
            Bootstrap::$entityManager->flush();
            return $profil;
        } else {
            return null;
        }
    }

    public function findById($profilId) {
        $query = Bootstrap::$entityManager->createQuery("select p from Utilisateur\Profil p where p.id = :profilId");
        $query->setParameter('profilId', $profilId);
        $profil = $query->getResult();
        if ($profil != null)
            return $profil[0];
        else
            return null;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

}
