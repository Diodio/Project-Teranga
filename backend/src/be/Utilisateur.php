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

namespace Utilisateur;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="utilisateur", uniqueConstraints={@UniqueConstraint(name="login_idx", columns={"login", "usine_id"})}) * */
class Utilisateur {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $password;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nomUtilisateur;
     
    //pour les utilisateurs supprimes ou pas : 0 =supprime , 1= non supprime
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $status;
    
    //activer ou desactiver um compte
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $etatCompte;
    
    //utilisateur connecte ou hors ligne : 0 hors ligne, 1 connecte
    /**
     * @Column(type="integer", nullable=true)
     * */
    protected $connected;
    
    /** @Column(type="datetime", nullable=true) */
    public $connectedDate;
    
    /** @Column(type="datetime", nullable=true) */
    public $disconnectedDate;
    
/** @ManyToOne(targetEntity="Usine\Usine", inversedBy="usine", cascade={"persist"}) */
    protected $usine;
    
    /** @ManyToOne(targetEntity="Utilisateur\Profil", inversedBy="profil", cascade={"persist"}) */
    protected $profil;
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deleteDate;
    
    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function getNomUtilisateur() {
        return $this->nomUtilisateur;
    }

    function getStatus() {
        return $this->status;
    }

    function getEtatCompte() {
        return $this->etatCompte;
    }

    function getUsine() {
        return $this->usine;
    }

    function getProfil() {
        return $this->profil;
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

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNomUtilisateur($nomUtilisateur) {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setEtatCompte($etatCompte) {
        $this->etatCompte = $etatCompte;
    }

    function setUsine($usine) {
        $this->usine = $usine;
    }

    function setProfil($profil) {
        $this->profil = $profil;
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
    function getConnected() {
        return $this->connected;
    }

    function getConnectedDate() {
        return $this->connectedDate;
    }

    function getDisconnectedDate() {
        return $this->disconnectedDate;
    }

    function setConnected($connected) {
        $this->connected = $connected;
    }

    function setConnectedDate($connectedDate) {
        $this->connectedDate = $connectedDate;
    }

    function setDisconnectedDate($disconnectedDate) {
        $this->disconnectedDate = $disconnectedDate;
    }

        
        

/** @PrePersist */
    public function doPrePersist() {
        date_default_timezone_set('GMT');
        $this->connected = 0;
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

    /** @PreUpdate */
    public function doPreUpdate() {
        date_default_timezone_set('GMT');
        $this->updatedDate = new \DateTime("now");
    }

    }
