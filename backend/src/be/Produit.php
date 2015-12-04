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
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $libelle;
    
/** @ManyToOne(targetEntity="Produit\FamilleProduit", inversedBy="familleProduit", cascade={"persist"}) */
    protected $familleProduit;
    
    
   
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    /** @OneToMany(targetEntity="Achat\LigneAchat", mappedBy="achat", cascade={"persist"}) */
    protected $achat;
    
    /** @OneToMany(targetEntity="Stock\StockInitial", mappedBy="stockInitial", cascade={"persist"}) */
    protected $stockInitial;
    
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

    

    function getStockInitial() {
        return $this->stockInitial;
    }

    function setStockInitial($stockInitial) {
        $this->stockInitial = $stockInitial;
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
