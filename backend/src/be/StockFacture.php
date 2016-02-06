<?php

namespace Stock;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="stock_facture") * */
class StockFacture {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $numeroFacture;
    
    /**
     * @Column(type="integer",nullable=true)
     * */
    protected $produitId;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    public $quantiteFacturee;
    
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
  

        
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
