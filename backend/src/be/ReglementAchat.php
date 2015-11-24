<?php

namespace Reglement;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="reglement_achat") * */
class ReglementAchat {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
   /** @Column(type="datetime", nullable=true) */
    public $datePaiement;
    
    /** @ManyToOne(targetEntity="Achat\Achat", inversedBy="achat", cascade={"persist"}) */
    protected $achat;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $montant;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $avance;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $reliquat;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    public function getId() {
        return $this->id;
    }

    public function getDatePaiement() {
        return $this->datePaiement;
    }

    public function getMareyeur() {
        return $this->mareyeur;
    }

    public function getAchat() {
        return $this->achat;
    }

    public function getMontant() {
        return $this->montant;
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

    public function setDatePaiement($datePaiement) {
        $this->datePaiement = $datePaiement;
    }

    public function setMareyeur($mareyeur) {
        $this->mareyeur = $mareyeur;
    }

    public function setAchat($achat) {
        $this->achat = $achat;
    }

    public function setMontant($montant) {
        $this->montant = $montant;
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
        $this->status = 0;
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

    }
