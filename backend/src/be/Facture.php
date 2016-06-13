<?php

namespace Facture;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="facture") * */
class Facture {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $numero;
    
   /** @Column(type="datetime", nullable=true) */
    public $dateFacture;
    
   /** @Column(type="time", nullable=true) */
    public $heureFacture;
    
   /** @Column(type="string", length=60, nullable=true) */
    public $devise;
    
    
   /** @Column(type="string", length=60, nullable=true) */
    public $portDechargement;
    
   /**
     * @Column(type="integer",  nullable=true)
     * */
    public $nbTotalColis;
    
   /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    public $nbTotalPoids;
    
    
   /** @Column(type="decimal", scale=2, precision=10, nullable=true) */
    public $montantHt;
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=false)
     * */
    protected $montantTtc;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $modePaiement;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $numCheque;
    
   /** @Column(type="datetime", nullable=true) */
    public $datePaiement;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $avance;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $reliquat;
    
    
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $inconterm;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $codeUsine;
   
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;

    
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $status;
    
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $regle;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    /**
     * @OneToOne(targetEntity="Empotage\Empotage")
     * @JoinColumn(name="empotage_id", referencedColumnName="id")
     **/
    
    private $empotage;
    
    function getId() {
        return $this->id;
    }

    function getNumero() {
        return $this->numero;
    }

    function getDateFacture() {
        return $this->dateFacture;
    }

    function getHeureFacture() {
        return $this->heureFacture;
    }

    function getDevise() {
        return $this->devise;
    }

    function getPortDechargement() {
        return $this->portDechargement;
    }

    function getNbTotalColis() {
        return $this->nbTotalColis;
    }

    function getNbTotalPoids() {
        return $this->nbTotalPoids;
    }

    function getMontantHt() {
        return $this->montantHt;
    }

    function getMontantTtc() {
        return $this->montantTtc;
    }

    function getModePaiement() {
        return $this->modePaiement;
    }

    function getNumCheque() {
        return $this->numCheque;
    }

    function getDatePaiement() {
        return $this->datePaiement;
    }

    function getAvance() {
        return $this->avance;
    }

    function getReliquat() {
        return $this->reliquat;
    }

    function getInconterm() {
        return $this->inconterm;
    }

    function getCodeUsine() {
        return $this->codeUsine;
    }

    function getLogin() {
        return $this->login;
    }

    function getStatus() {
        return $this->status;
    }

    function getRegle() {
        return $this->regle;
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

    function getEmpotage() {
        return $this->empotage;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setDateFacture($dateFacture) {
        $this->dateFacture = $dateFacture;
    }

    function setHeureFacture($heureFacture) {
        $this->heureFacture = $heureFacture;
    }

    function setDevise($devise) {
        $this->devise = $devise;
    }

    function setPortDechargement($portDechargement) {
        $this->portDechargement = $portDechargement;
    }

    function setNbTotalColis($nbTotalColis) {
        $this->nbTotalColis = $nbTotalColis;
    }

    function setNbTotalPoids($nbTotalPoids) {
        $this->nbTotalPoids = $nbTotalPoids;
    }

    function setMontantHt($montantHt) {
        $this->montantHt = $montantHt;
    }

    function setMontantTtc($montantTtc) {
        $this->montantTtc = $montantTtc;
    }

    function setModePaiement($modePaiement) {
        $this->modePaiement = $modePaiement;
    }

    function setNumCheque($numCheque) {
        $this->numCheque = $numCheque;
    }

    function setDatePaiement($datePaiement) {
        $this->datePaiement = $datePaiement;
    }

    function setAvance($avance) {
        $this->avance = $avance;
    }

    function setReliquat($reliquat) {
        $this->reliquat = $reliquat;
    }

    function setInconterm($inconterm) {
        $this->inconterm = $inconterm;
    }

    function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setRegle($regle) {
        $this->regle = $regle;
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

    function setEmpotage($empotage) {
        $this->empotage = $empotage;
    }


    }
