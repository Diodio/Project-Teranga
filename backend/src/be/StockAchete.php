<?php

namespace Stock;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="stock_achete") * */
class StockAchete {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer",nullable=true)
     * */
    protected $achatId;
    
    /**
     * @Column(type="integer",nullable=true)
     * */
    protected $produitId;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    public $quantiteAchetee;
    
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    function getId() {
        return $this->id;
    }

    function getAchatId() {
        return $this->achatId;
    }

    function getProduitId() {
        return $this->produitId;
    }

    function getQuantiteAchetee() {
        return $this->quantiteAchetee;
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

    function setAchatId($achatId) {
        $this->achatId = $achatId;
    }

    function setProduitId($produitId) {
        $this->produitId = $produitId;
    }

    function setQuantiteAchetee($quantiteAchetee) {
        $this->quantiteAchetee = $quantiteAchetee;
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
