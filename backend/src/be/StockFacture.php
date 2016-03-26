<?php

namespace Stock;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="stock_facture") * */
class StockFacture {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer",nullable=true)
     * */
    protected $factureId;
    
    /**
     * @Column(type="integer",nullable=true)
     * */
    protected $produitId;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $quantiteFacturee;
    
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
  

        
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
   
    function getId() {
        return $this->id;
    }

    function getFactureId() {
        return $this->factureId;
    }

    function getProduitId() {
        return $this->produitId;
    }

    function getQuantiteFacturee() {
        return $this->quantiteFacturee;
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

    function setFactureId($factureId) {
        $this->factureId = $factureId;
    }

    function setProduitId($produitId) {
        $this->produitId = $produitId;
    }

    function setQuantiteFacturee($quantiteFacturee) {
        $this->quantiteFacturee = $quantiteFacturee;
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


    }
