<?php

namespace Empotage;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_colis") * */
class LigneColis {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
     /**
     * @Column(type="integer", nullable=false)
     * */
    protected $nombreCarton;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $quantiteParCarton;

     /**
     * @Column(type="integer", nullable=false)
     * */
    protected $produitId;

     /**
     * @Column(type="integer", nullable=false)
     * */
    protected $empotage_id;
    

    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;

    function getId() {
        return $this->id;
    }

    function getNombreCarton() {
        return $this->nombreCarton;
    }

    function getQuantiteParCarton() {
        return $this->quantiteParCarton;
    }

    function getProduitId() {
        return $this->produitId;
    }

    function getEmpotage_id() {
        return $this->empotage_id;
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

    function setProduitId($produitId) {
        $this->produitId = $produitId;
    }

    function setEmpotage_id($empotage_id) {
        $this->empotage_id = $empotage_id;
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
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
