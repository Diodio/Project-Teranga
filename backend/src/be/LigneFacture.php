<?php

namespace Facture;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_facture") * */
class LigneFacture {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $nbColis;
    
    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $prixUnitaire;
    
    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $quantite;
    
    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $montant;

     /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $produit;
    
      /** @ManyToOne(targetEntity="Facture\Facture", inversedBy="facture") 
     * @JoinColumn(name="facture_id", referencedColumnName="id",
      onDelete="CASCADE") */
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

    
    
        /** @PrePersist */
    public function doPrePersist() {
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
