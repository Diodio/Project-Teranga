<?php

namespace Facture;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="facture_temp") * */
class FactureTemp {

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
     * @Column(type="integer", nullable=true)
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
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $avance;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $reliquat;
    
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
     * @Column(type="integer", nullable=true) 
     **/
    protected $client;
    
   /**
     * @Column(type="integer", nullable=true) 
     **/
    public $conteneur;
    
    
    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getDateFacture() {
        return $this->dateFacture;
    }

    public function getHeureFacture() {
        return $this->heureFacture;
    }

    public function getDevise() {
        return $this->devise;
    }

    public function getPortDechargement() {
        return $this->portDechargement;
    }

    public function getMontantHt() {
        return $this->montantHt;
    }

    public function getMontantTtc() {
        return $this->montantTtc;
    }

    public function getModePaiement() {
        return $this->modePaiement;
    }

    public function getNumCheque() {
        return $this->numCheque;
    }

    public function getAvance() {
        return $this->avance;
    }

    public function getReliquat() {
        return $this->reliquat;
    }

    public function getCodeUsine() {
        return $this->codeUsine;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getStatus() {
        return $this->status;
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

    public function getBonsortie() {
        return $this->bonsortie;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setDateFacture($dateFacture) {
        $this->dateFacture = $dateFacture;
    }

    public function setHeureFacture($heureFacture) {
        $this->heureFacture = $heureFacture;
    }

    public function setDevise($devise) {
        $this->devise = $devise;
    }

    public function setPortDechargement($portDechargement) {
        $this->portDechargement = $portDechargement;
    }

    public function setMontantHt($montantHt) {
        $this->montantHt = $montantHt;
    }

    public function setMontantTtc($montantTtc) {
        $this->montantTtc = $montantTtc;
    }

    public function setModePaiement($modePaiement) {
        $this->modePaiement = $modePaiement;
    }

    public function setNumCheque($numCheque) {
        $this->numCheque = $numCheque;
    }

    public function setAvance($avance) {
        $this->avance = $avance;
    }

    public function setReliquat($reliquat) {
        $this->reliquat = $reliquat;
    }

    public function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setStatus($status) {
        $this->status = $status;
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

    public function setBonsortie($bonsortie) {
        $this->bonsortie = $bonsortie;
    }


    public function getConteneur() {
        return $this->conteneur;
    }

    public function setConteneur($conteneur) {
        $this->conteneur = $conteneur;
    }

    function getNbTotalColis() {
        return $this->nbTotalColis;
    }

    function getRegle() {
        return $this->regle;
    }

    function setNbTotalColis($nbTotalColis) {
        $this->nbTotalColis = $nbTotalColis;
    }

    function setRegle($regle) {
        $this->regle = $regle;
    }

    function getClient() {
        return $this->client;
    }

    function setClient($client) {
        $this->client = $client;
    }
    function getNbTotalPoids() {
        return $this->nbTotalPoids;
    }

    function setNbTotalPoids($nbTotalPoids) {
        $this->nbTotalPoids = $nbTotalPoids;
    }





    }
