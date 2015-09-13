<?php

/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Partner
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */

namespace Article;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="article") * */
class Article {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $libelle;
    /**
     * @Column(type="string", length=60, nullable=false)
     * 
     */
    protected $prixUnitaire;
    
    

    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    /** @ManyToOne(targetEntity="Article\TypeArticle", inversedBy="typeArticle", cascade={"persist"}) */
    protected $typeArticle;

    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function getCreatedDate() {
        return $this->createdDate;
    }

    function getUpdatedDate() {
        return $this->updatedDate;
    }

    function getDeleteDate() {
        return $this->deleteDate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }

    function setDeleteDate($deleteDate) {
        $this->deleteDate = $deleteDate;
    }
    function getTypeArticle() {
        return $this->typeArticle;
    }

    function setTypeArticle($typeArticle) {
        $this->typeArticle = $typeArticle;
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
