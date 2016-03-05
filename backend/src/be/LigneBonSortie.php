<?php

namespace BonSortie;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_bonsortie") * */
class LigneBonSortie {

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
    protected $quantite;
    
   

    /**
     *  @ManyToOne(targetEntity="Produit\Produit", inversedBy="produit") 
     * @JoinColumn(name="produit_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $produit;

    /** @ManyToOne(targetEntity="BonSortie\BonSortie", inversedBy="bonSortie") 
     * @JoinColumn(name="bonSortie_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $bonSortie;

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

    public function getProduit() {
        return $this->produit;
    }

    public function getBonSortie() {
        return $this->bonSortie;
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

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function setProduit($produit) {
        $this->produit = $produit;
    }

    public function setBonSortie($bonSortie) {
        $this->bonSortie = $bonSortie;
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

    function getNombreCarton() {
        return $this->nombreCarton;
    }

    function setNombreCarton($nombreCarton) {
        $this->nombreCarton = $nombreCarton;
    }

        
        /** @PrePersist */
    public function doPrePersist() {
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
