<?php

namespace Facture;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_facture_temp") * */
class LigneFactureTemp {

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
    protected $prixUnitaire;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $quantite;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $montant;

    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $produit;
    
     /**
     * @Column(type="integer", nullable=true) 
     **/
    protected $facture;

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

    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getMontant() {
        return $this->montant;
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

    function setNbColis($nbColis) {
        $this->nbColis = $nbColis;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setMontant($montant) {
        $this->montant = $montant;
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
    function getFacture() {
        return $this->facture;
    }

    function setFacture($facture) {
        $this->facture = $facture;
    }

        
    
        /** @PrePersist */
    public function doPrePersist() {
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
