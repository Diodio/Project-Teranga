<?php

namespace Stock;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="stock_reel") * */
class StockReel {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true, options={"unsigned":true})
     * */
    protected $stock;
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $seuil;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $codeUsine;
   
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;
   
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    /** @ManyToOne(targetEntity="Produit\Produit", inversedBy="produit") 
        @JoinColumn(name="produit_id", referencedColumnName="id",
      onDelete="CASCADE")
     *      */
    protected $produit;
    
    function getId() {
        return $this->id;
    }

    function getStock() {
        return $this->stock;
    }

    function getSeuil() {
        return $this->seuil;
    }

    function getCodeUsine() {
        return $this->codeUsine;
    }

    function getLogin() {
        return $this->login;
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

    function setStock($stock) {
        $this->stock = $stock;
    }

    function setSeuil($seuil) {
        $this->seuil = $seuil;
    }

    function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

    function setLogin($login) {
        $this->login = $login;
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
    function getProduit() {
        return $this->produit;
    }

    function setProduit($produit) {
        $this->produit = $produit;
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
