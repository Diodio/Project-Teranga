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
     * @Column(type="decimal", scale=2, precision=10,nullable=true)
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

    public function getId() {
        return $this->id;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getMontant() {
        return $this->montant;
    }

    public function getProduit() {
        return $this->produit;
    }

    public function getAchat() {
        return $this->achat;
    }

    public function getCreatedDate() {
        return $this->createdDate;
    }

    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    public function getDeletedDate() {
        return $this->deletedDate;
    }

    public function setId($id) {
        $this->id = $id;
    }
    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

        public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

   

    public function setMontant($montant) {
        $this->montant = $montant;
    }

    public function setProduit($produit) {
        $this->produit = $produit;
    }

    public function setAchat($achat) {
        $this->achat = $achat;
    }

    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    public function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }

    public function setDeletedDate($deletedDate) {
        $this->deletedDate = $deletedDate;
    }

    
        /** @PrePersist */
    public function doPrePersist() {
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
