<?php

namespace Reglement;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="reglement_facture") * */
class ReglementFacture {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
   /** @Column(type="date", nullable=true) */
    public $datePaiement;
    
    /** @ManyToOne(targetEntity="Facture\Facture", inversedBy="facture") */
    protected $facture;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $avance;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    function getId() {
        return $this->id;
    }

    function getDatePaiement() {
        return $this->datePaiement;
    }

    function getFacture() {
        return $this->facture;
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

    function setDatePaiement($datePaiement) {
        $this->datePaiement = $datePaiement;
    }

    function setFacture($facture) {
        $this->facture = $facture;
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
    public function getAvance() {
        return $this->avance;
    }

    public function setAvance($avance) {
        $this->avance = $avance;
    }


    }
