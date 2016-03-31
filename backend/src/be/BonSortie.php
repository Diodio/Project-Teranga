<?php

namespace BonSortie;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="bon_sortie", uniqueConstraints={@UniqueConstraint(name="numero_idx", columns={"numeroBonSortie", "codeUsine"})}) * */
class BonSortie {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $numeroBonSortie;
    
   /** @Column(type="datetime", nullable=true) */
    public $dateBonSortie;
    
    /** @Column(type="time", nullable=true) */
    public $heureSortie;
    
   /** @Column(type="string", length=60, nullable=true) */
    public $numeroCamion;
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $nomChauffeur;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $origine;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $destination;
    
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $codeUsine;
   
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;

    /** @OneToMany(targetEntity="BonSortie\LigneBonSortie", mappedBy="produit") */
    public $produit;
  
    /**
     * @Column(type="integer", nullable=false) 
     **/
    protected $totalColis;
    
    
   /**
     * @Column(type="decimal", scale=2, precision=10, nullable=true)
     * */
    protected $poidsTotal;
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $status;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
  
    
    public function getId() {
        return $this->id;
    }

    public function getNumeroBonSortie() {
        return $this->numeroBonSortie;
    }

    public function getDateBonSortie() {
        return $this->dateBonSortie;
    }

    public function getNumeroContainer() {
        return $this->numeroContainer;
    }

    public function getNumeroPlomb() {
        return $this->numeroPlomb;
    }

    public function getNumeroCamion() {
        return $this->numeroCamion;
    }

    public function getNomChauffeur() {
        return $this->nomChauffeur;
    }

    public function getOrigine() {
        return $this->origine;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function getCodeUsine() {
        return $this->codeUsine;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getProduit() {
        return $this->produit;
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

   

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumeroBonSortie($numeroBonSortie) {
        $this->numeroBonSortie = $numeroBonSortie;
    }

    public function setDateBonSortie($dateBonSortie) {
        $this->dateBonSortie = $dateBonSortie;
    }

    public function setNumeroContainer($numeroContainer) {
        $this->numeroContainer = $numeroContainer;
    }

    public function setNumeroPlomb($numeroPlomb) {
        $this->numeroPlomb = $numeroPlomb;
    }

    public function setNumeroCamion($numeroCamion) {
        $this->numeroCamion = $numeroCamion;
    }

    public function setNomChauffeur($nomChauffeur) {
        $this->nomChauffeur = $nomChauffeur;
    }

    public function setOrigine($origine) {
        $this->origine = $origine;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
    }

    public function setCodeUsine($codeUsine) {
        $this->codeUsine = $codeUsine;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setProduit($produit) {
        $this->produit = $produit;
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

    

    public function getPoidsTotal() {
        return $this->poidsTotal;
    }

    public function setPoidsTotal($poidsTotal) {
        $this->poidsTotal = $poidsTotal;
    }


    function getHeureSortie() {
        return $this->heureSortie;
    }

    function setHeureSortie($heureSortie) {
        $this->heureSortie = $heureSortie;
    }
    function getTotalColis() {
        return $this->totalColis;
    }

    function setTotalColis($totalColis) {
        $this->totalColis = $totalColis;
    }





    }
