<?php

namespace Achat;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_achat") * */
class LigneAchat {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $quantite;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $montant;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $poidsTotal;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $montantTotal;

    /**
     *  @ManyToOne(targetEntity="Produit\Produit", inversedBy="produit") 
     * @JoinColumn(name="produit_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $produit;

    /** @ManyToOne(targetEntity="Achat\Achat", inversedBy="achat") 
     * @JoinColumn(name="achat_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $achat;

    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;

    function getId() {
        return $this->id;
    }

    function getProduit() {
        return $this->produit;
    }

    function getAchat() {
        return $this->achat;
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

    function setProduit($produit) {
        $this->produit = $produit;
    }

    function setAchat($achat) {
        $this->achat = $achat;
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

    function getQuantite() {
        return $this->quantite;
    }

    function getMontant() {
        return $this->montant;
    }

    function getPoidsTotal() {
        return $this->poidsTotal;
    }

    function getMontantTotal() {
        return $this->montantTotal;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    function setPoidsTotal($poidsTotal) {
        $this->poidsTotal = $poidsTotal;
    }

    function setMontantTotal($montantTotal) {
        $this->montantTotal = $montantTotal;
    }

        /** @PrePersist */
    public function doPrePersist() {
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
