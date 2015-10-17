<?php

namespace Achat;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="achat") * */
class Achat {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $numero;
    
   /** @Column(type="datetime", nullable=true) */
    public $dateAchat;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $poidsTotal;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $montantTotal;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $modePaiement;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $numCheque;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $codeUsine;
   
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;

    /** @OneToMany(targetEntity="Achat\LigneAchat", mappedBy="produit") */
    public $produit;
    
    function getId() {
        return $this->id;
    }

    function getNumero() {
        return $this->numero;
    }

    function getDateAchat() {
        return $this->dateAchat;
    }

    function getProduit() {
        return $this->produit;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setDateAchat($dateAchat) {
        $this->dateAchat = $dateAchat;
    }

    function setProduit($produit) {
        $this->produit = $produit;
    }

    function getPoidsTotal() {
        return $this->poidsTotal;
    }

    function getMontantTotal() {
        return $this->montantTotal;
    }

    function getModePaiement() {
        return $this->modePaiement;
    }

    function getNumCheque() {
        return $this->numCheque;
    }

    function setPoidsTotal($poidsTotal) {
        $this->poidsTotal = $poidsTotal;
    }

    function setMontantTotal($montantTotal) {
        $this->montantTotal = $montantTotal;
    }

    function setModePaiement($modePaiement) {
        $this->modePaiement = $modePaiement;
    }

    function setNumCheque($numCheque) {
        $this->numCheque = $numCheque;
    }


    function getCodeUsine() {
        return $this->codeUsine;
    }

    function getLogin() {
        return $this->login;
    }

    function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

    function setLogin($login) {
        $this->login = $login;
    }



    }
