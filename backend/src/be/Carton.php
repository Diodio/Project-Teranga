<?php

namespace Produit;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="carton") * */
class Carton {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $nombreCarton;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $quantiteParCarton;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $total;
    
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $status;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    /** @ManyToOne(targetEntity="Produit\Demoulage", inversedBy="demoulage", cascade={"persist"}) */
    protected $demoulage;
    
    function getId() {
        return $this->id;
    }

    function getNombreCarton() {
        return $this->nombreCarton;
    }

    function getQuantiteParCarton() {
        return $this->quantiteParCarton;
    }

    function getStatus() {
        return $this->status;
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

    function setNombreCarton($nombreCarton) {
        $this->nombreCarton = $nombreCarton;
    }

    function setQuantiteParCarton($quantiteParCarton) {
        $this->quantiteParCarton = $quantiteParCarton;
    }

    function setStatus($status) {
        $this->status = $status;
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

    function getDemoulage() {
        return $this->demoulage;
    }

    function setDemoulage($demoulage) {
        $this->demoulage = $demoulage;
    }

    function getTotal() {
        return $this->total;
    }

    function setTotal($total) {
        $this->total = $total;
    }

                 /** @PrePersist */
    public function doPrePersist() {
        $this->status = 0;
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }
   


    }