<?php

namespace Empotage;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="conteneur") * */
class Conteneur {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
  
    /** @ManyToOne(targetEntity="Empotage\Empotage", inversedBy="empotage", cascade={"persist"}) */
    protected $empotage;
    
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

    function getEmpotage() {
        return $this->empotage;
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

    function setEmpotage($empotage) {
        $this->empotage = $empotage;
    }

    function setNumConteneur($numConteneur) {
        $this->numConteneur = $numConteneur;
    }

    function setNumPlomb($numPlomb) {
        $this->numPlomb = $numPlomb;
    }




    }
