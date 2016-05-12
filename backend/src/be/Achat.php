<?php

namespace Achat;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="achat", uniqueConstraints={@UniqueConstraint(name="numero_idx", columns={"numero", "codeUsine"})}) * */
class Achat {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $numero;
    
   /** @Column(type="date", nullable=true) */
    public $dateAchat;
    
    
   /** @Column(type="time", nullable=true) */
    public $heureReception;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $poidsTotal;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $montantTotal;
    
    /**
     * @Column(type="decimal", scale=2, precision=10,nullable=true)
     * */
    protected $reliquat;
    
    /**
     * @Column(type="decimal", scale=2, precision=10,nullable=true)
     * */
    protected $transport;
    
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
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $codeUsine;
   
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;

    /** @OneToMany(targetEntity="Achat\LigneAchat", mappedBy="produit") */
    public $produit;
    
    /** @OneToMany(targetEntity="Reglement\ReglementAchat", mappedBy="reglement") */
    public $reglement;
    
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
    
    /** @ManyToOne(targetEntity="Mareyeur\Mareyeur", inversedBy="mareyeur") */
    protected $mareyeur;
    
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

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
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

     /** @PrePersist */
    public function doPrePersist() {
        $this->status = 0;
        $this->regle = 0;
        $this->modePaiement="ESPECES";
       $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }
    public function getPaiement() {
        return $this->paiement;
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

    public function getMareyeur() {
        return $this->mareyeur;
    }

    public function setPaiement($paiement) {
        $this->paiement = $paiement;
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

    public function setMareyeur($mareyeur) {
        $this->mareyeur = $mareyeur;
    }
    public function getHeureReception() {
        return $this->heureReception;
    }

    public function setHeureReception($heureReception) {
        $this->heureReception = $heureReception;
    }
    public function getRegle() {
        return $this->regle;
    }

    public function setRegle($regle) {
        $this->regle = $regle;
    }
    public function getReliquat() {
        return $this->reliquat;
    }

    public function getReglement() {
        return $this->reglement;
    }

    public function setReliquat($reliquat) {
        $this->reliquat = $reliquat;
    }

    public function setReglement($reglement) {
        $this->reglement = $reglement;
    }
    function getDatePaiement() {
        return $this->datePaiement;
    }

    function setDatePaiement($datePaiement) {
        $this->datePaiement = $datePaiement;
    }

    function getTransport() {
        return $this->transport;
    }

    function setTransport($transport) {
        $this->transport = $transport;
    }





    }
