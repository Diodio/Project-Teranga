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
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nombreParCarton;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nombreCarton;
    
    /** @ManyToOne(targetEntity="Produit\Produit", inversedBy="produit", cascade={"persist"}) */
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

    function getNombreParCarton() {
        return $this->nombreParCarton;
    }

    function getNombreCarton() {
        return $this->nombreCarton;
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

    function setNombreParCarton($nombreParCarton) {
        $this->nombreParCarton = $nombreParCarton;
    }

    function setNombreCarton($nombreCarton) {
        $this->nombreCarton = $nombreCarton;
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

    
         /** @PrePersist */
    public function doPrePersist() {
        $this->status = 0;
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }
   


    }
