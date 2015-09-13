<?php

/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Partner
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */

namespace Produit;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="produit") * */
class Produit {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $libelle;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $quantite;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $prixUnitaire;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $seuil;
    

    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function getSeuil() {
        return $this->seuil;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setSeuil($seuil) {
        $this->seuil = $seuil;
    }


/** @PrePersist */
    public function doPrePersist() {
        date_default_timezone_set('GMT');
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

    /** @PreUpdate */
    public function doPreUpdate() {
        date_default_timezone_set('GMT');
        $this->updatedDate = new \DateTime("now");
    }

    }
