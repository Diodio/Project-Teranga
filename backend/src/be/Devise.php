<?php

namespace Devise;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="devise") * */
class Devise {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=10, nullable=false, unique=true)
     * */
    protected $devise;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=false)
     * */
    protected $montant;
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    function getId() {
        return $this->id;
    }

    function getDevise() {
        return $this->devise;
    }

    function getMontant() {
        return $this->montant;
    }

    function getCreatedDate() {
        return $this->createdDate;
    }

    function getUpdatedDate() {
        return $this->updatedDate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDevise($devise) {
        $this->devise = $devise;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }

            
/** @PrePersist */
    public function doPrePersist() {
        date_default_timezone_set('GMT');
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

    /** @PreUpdate */
    public function doPreUpdate() {
        date_default_timezone_set('GMT');
        $this->updatedDate = new \DateTime("now");
    }
    }
