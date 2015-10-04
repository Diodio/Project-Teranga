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
     * @Column(type="integer", nullable=false)
     * */
    protected $poidsBrut;
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $poidsNet;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $prixUnitaire;
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $stock;
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $seuil;
    
/** @ManyToOne(targetEntity="Produit\FamilleProduit", inversedBy="familleProduit", cascade={"persist"}) */
    protected $familleProduit;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nomUsine;
   
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $utilisateur;
   
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

    function getPoidsNet() {
        return $this->poidsNet;
    }

    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function getStock() {
        return $this->stock;
    }

    function getSeuil() {
        return $this->seuil;
    }

    function getCreatedDate() {
        return $this->createdDate;
    }

    function getUpdatedDate() {
        return $this->updatedDate;
    }

    function getDeleteDate() {
        return $this->deleteDate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setPoidsNet($poidsNet) {
        $this->poidsNet = $poidsNet;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function setSeuil($seuil) {
        $this->seuil = $seuil;
    }

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }

    function setDeleteDate($deleteDate) {
        $this->deleteDate = $deleteDate;
    }
    function getFamilleProduit() {
        return $this->familleProduit;
    }

    function setFamilleProduit($familleProduit) {
        $this->familleProduit = $familleProduit;
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
