<?php

namespace Empotage;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="empotage") * */
class Empotage {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $numero;
    
   /** @Column(type="datetime", nullable=true) */
    public $date;
    
   /** @Column(type="time", nullable=true) */
    public $heure;
    
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
    
    //Facture ou pas
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $etat;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    /** @ManyToOne(targetEntity="Client\Client", inversedBy="client") */
    protected $client;
    
   /** @OneToMany(targetEntity="Empotage\Conteneur", mappedBy="conteneur") */
    public $conteneur;
    
    
    function getId() {
        return $this->id;
    }

    function getNumero() {
        return $this->numero;
    }

    function getDate() {
        return $this->date;
    }

    function getHeure() {
        return $this->heure;
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

    function getCodeUsine() {
        return $this->codeUsine;
    }

    function getLogin() {
        return $this->login;
    }

    function getStatus() {
        return $this->status;
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

    function getClient() {
        return $this->client;
    }

    function getConteneur() {
        return $this->conteneur;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setHeure($heure) {
        $this->heure = $heure;
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

    function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setStatus($status) {
        $this->status = $status;
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

    function setClient($client) {
        $this->client = $client;
    }

    function setConteneur($conteneur) {
        $this->conteneur = $conteneur;
    }

    function getEtat() {
        return $this->etat;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

        
        /** @PrePersist */
    public function doPrePersist() {
        $this->etat=0;
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }




    }
