<?php

namespace Empotage;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="conteneur_temp") * */
class ConteneurTemp {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
  
    /** @ManyToOne(targetEntity="Facture\Facture", inversedBy="facture", cascade={"persist"}) */
    protected $empotage_id;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $numConteneur;
    
    /**
     * @Column(type="string", length=60, nullable=true)
     * */
    protected $numPlomb;
    
    
    function getId() {
        return $this->id;
    }

    function getEmpotage_id() {
        return $this->empotage_id;
    }

    function getNumConteneur() {
        return $this->numConteneur;
    }

    function getNumPlomb() {
        return $this->numPlomb;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmpotage_id($empotage_id) {
        $this->empotage_id = $empotage_id;
    }

    function setNumConteneur($numConteneur) {
        $this->numConteneur = $numConteneur;
    }

    function setNumPlomb($numPlomb) {
        $this->numPlomb = $numPlomb;
    }





    }
