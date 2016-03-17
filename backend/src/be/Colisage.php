<?php

namespace Produit;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="colisage"), uniqueConstraints={@UniqueConstraint(name="colisage_idx", columns={"produitId", "quantiteParCarton","codeUsine"})) * */
class Colisage {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $produitId;
    
    /**
     * @Column(type="integer", nullable=false, options={"unsigned":true})
     * */
    protected $nombreCarton;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true, options={"unsigned":true})
     * */
    protected $quantiteParCarton;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $codeUsine;
    
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

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }

    function setDeletedDate($deletedDate) {
        $this->deletedDate = $deletedDate;
    }

    function getCodeUsine() {
        return $this->codeUsine;
    }

    function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

                     /** @PrePersist */
    public function doPrePersist() {
        $this->status = 0;
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }
   

    function getProduitId() {
        return $this->produitId;
    }

    function setProduitId($produitId) {
        $this->produitId = $produitId;
    }


    }
