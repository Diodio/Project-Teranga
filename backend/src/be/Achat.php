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




    }
