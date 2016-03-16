<?php

namespace Produit;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="demoulage") * */
class Demoulage {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
     
    /**
     * @Column(type="string", length=60, nullable=true, unique=true)
     * */
    protected $numero;
    
     /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    public $quantiteAvantDemoulage;
    
     /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    public $quantiteDemoulee;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $codeUsine;
    
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $status;
   
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;
    
    /** @OneToMany(targetEntity="Produit\Carton", mappedBy="carton") */
    public $carton;
    
    /** @ManyToOne(targetEntity="Produit\Produit", inversedBy="produit", cascade={"persist"}) 
    @JoinColumn(name="produit_id", referencedColumnName="id",
      onDelete="CASCADE")   */
    protected $produit;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    function getId() {
        return $this->id;
    }

    function getCodeUsine() {
        return $this->codeUsine;
    }

    function getLogin() {
        return $this->login;
    }

    function getProduit() {
        return $this->produit;
    }

    function getCreatedDate() {
        return $this->createdDate;
    }

    function getUpdatedDate() {
        return $this->updatedDate;
    }

    function getDeletedDate() {
        return $this->deletedDate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setProduit($produit) {
        $this->produit = $produit;
    }

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }

    function setDeletedDate($deletedDate) {
        $this->deletedDate = $deletedDate;
    }
    function getCarton() {
        return $this->carton;
    }

    function setCarton($carton) {
        $this->carton = $carton;
    }

    function getNumero() {
        return $this->numero;
    }

    function getQuantiteDemoulee() {
        return $this->quantiteDemoulee;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setQuantiteDemoulee($quantiteDemoulee) {
        $this->quantiteDemoulee = $quantiteDemoulee;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    function getQuantiteAvantDemoulage() {
        return $this->quantiteAvantDemoulage;
    }

    function setQuantiteAvantDemoulage($quantiteAvantDemoulage) {
        $this->quantiteAvantDemoulage = $quantiteAvantDemoulage;
    }

        
                 /** @PrePersist */
    public function doPrePersist() {
        $this->status = 1;
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }
   


    }
