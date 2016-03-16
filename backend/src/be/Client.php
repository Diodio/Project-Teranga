<?php

namespace Client;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="client") * */
class Client {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $reference;

    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nom;

    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $adresse;

    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $pays;

    /**
     * @Column(type="string", length=32, nullable=false)
     * */
    protected $telephone;

    /** @OneToMany(targetEntity="BonSortie\BonSortie", mappedBy="bonSortie") */
    public $bonSortie;

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function getReference() {
        return $this->reference;
    }

    function getBonSortie() {
        return $this->bonSortie;
    }

    function setReference($reference) {
        $this->reference = $reference;
    }

    function setBonSortie($bonSortie) {
        $this->bonSortie = $bonSortie;
    }
    function getPays() {
        return $this->pays;
    }

    function setPays($pays) {
        $this->pays = $pays;
    }


}
