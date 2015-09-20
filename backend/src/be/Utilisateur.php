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
 * @Table(name="utilisateur") * */
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
     
    //pour les utilisateurs connectes
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $status;
    
    //activer ou desactiver um compte
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $etatCompte;
    
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
