<?php


namespace Usine;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="usine") * */
class Usine {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $code;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nomUsine;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $emplacement;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $typeUsine;
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $telephone;
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $fax;
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $codePostal;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $couleur;
    
    
    /** @OneToMany(targetEntity="Utilisateur\Utilisateur", mappedBy="utilisateur", cascade={"persist"}) */
    protected $utilisateur;
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getNomUsine() {
        return $this->nomUsine;
    }

    function getEmplacement() {
        return $this->emplacement;
    }

    function getTypeUsine() {
        return $this->typeUsine;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getFax() {
        return $this->fax;
    }

    function getCodePostal() {
        return $this->codePostal;
    }

    function getUtilisateur() {
        return $this->utilisateur;
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

    function setCode($code) {
        $this->code = $code;
    }

    function setNomUsine($nomUsine) {
        $this->nomUsine = $nomUsine;
    }

    function setEmplacement($emplacement) {
        $this->emplacement = $emplacement;
    }

    function setTypeUsine($typeUsine) {
        $this->typeUsine = $typeUsine;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setFax($fax) {
        $this->fax = $fax;
    }

    function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }

    function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
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
