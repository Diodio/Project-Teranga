<?php
namespace Bo;
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

interface BaseManager {
    function insert($object, $supp=null);

    function update($object, $supp=null);

    function remove($listId, $supp=null);

    function view($id, $supp=null);

}
