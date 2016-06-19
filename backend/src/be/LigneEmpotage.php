<?php

namespace Empotage;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_empotage") * */
class LigneEmpotage {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $nbColis;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $quantite;
    
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $prixUnitaire;
   
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $montant;

    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $produit_id;
    
      /** @ManyToOne(targetEntity="Empotage\Empotage", inversedBy="empotage") 
     * @JoinColumn(name="empotage_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $empotage;

    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;

    function getId() {
        return $this->id;
    }

    function getNbColis() {
        return $this->nbColis;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getProduit_id() {
        return $this->produit_id;
    }

    function getEmpotage() {
        return $this->empotage;
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

    function setNbColis($nbColis) {
        $this->nbColis = $nbColis;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setProduit_id($produit_id) {
        $this->produit_id = $produit_id;
    }

    function setEmpotage($empotage) {
        $this->empotage = $empotage;
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

    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function getMontant() {
        return $this->montant;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    
    
        /** @PrePersist */
    public function doPrePersist() {
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
