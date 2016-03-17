<?php

namespace Produit;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="produit") * */
class Produit {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=120, nullable=false, unique=true)
     * */
    protected $libelle;
    
    /**
     * @Column(type="string", length=120, nullable=true)
     * */
    protected $libelleFacture;
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    /** @OneToMany(targetEntity="Achat\LigneAchat", mappedBy="achat", cascade={"persist"}) */
    protected $achat;
    
    /** @OneToMany(targetEntity="Stock\StockProvisoire", mappedBy="stockProvisoire", cascade={"persist"}) */
    protected $stockProvisoire;
    
    /** @OneToMany(targetEntity="Stock\StockReel", mappedBy="stockReel", cascade={"persist"}) */
    protected $stockReel;
    
    /** @OneToMany(targetEntity="BonSortie\LigneBonSortie", mappedBy="bonSortie", cascade={"persist"}) */
    protected $bonSortie;
    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
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
   

    public function getAchat() {
        return $this->achat;
    }

    public function getBonSortie() {
        return $this->bonSortie;
    }

    public function setAchat($achat) {
        $this->achat = $achat;
    }

    public function setBonSortie($bonSortie) {
        $this->bonSortie = $bonSortie;
    }

    
    function getStockProvisoire() {
        return $this->stockProvisoire;
    }

    function getStockReel() {
        return $this->stockReel;
    }

    function setStockProvisoire($stockProvisoire) {
        $this->stockProvisoire = $stockProvisoire;
    }

    function setStockReel($stockReel) {
        $this->stockReel = $stockReel;
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
    function getLibelleFacture() {
        return $this->libelleFacture;
    }

    function setLibelleFacture($libelleFacture) {
        $this->libelleFacture = $libelleFacture;
    }



    }
