<?php

namespace Mareyeur;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="mareyeur") * */
class Mareyeur {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nom;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $adresse;
    
    /**
     * @Column(type="string", length=32, nullable=false)
     * */
    protected $telephone;
    /**
     * @Column(type="string", length=32, nullable=false)
     * */
    protected $montantFinancement;
   
    
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
    public function getMontantFinancement() {
    	return $this->montantFinancement;
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
    
    public function setMontantFinancement($montantFinancement) {
    	$this->montantFinancement = $montantFinancement;
    }
    
    

    }
