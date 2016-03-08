<?php

namespace BonSortie;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_colis_bonsortie") * */
class LigneColisBonSortie {

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
    protected $produit_id;

     /** @ManyToOne(targetEntity="BonSortie\BonSortie", inversedBy="bonSortie") 
     * @JoinColumn(name="bonSortie_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $bonSortie_id;
    

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

    function getProduit_id() {
        return $this->produit_id;
    }

    function getBonSortie_id() {
        return $this->bonSortie_id;
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

    function setProduit_id($produit_id) {
        $this->produit_id = $produit_id;
    }

    function setBonSortie_id($bonSortie_id) {
        $this->bonSortie_id = $bonSortie_id;
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
