<?php

/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Group
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */

namespace Exceptions;

/**
 * Exception lancée quand la longueur du numéro dépasse celle autorisée dans un pays
 *
 * @author ssi
 */
class ConstraintException extends \Exception{
    
    function __construct($message) {
        parent::__construct($message);
    }

}
