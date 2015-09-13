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
abstract class BaseController{
    protected function doSuccess($id, $actionDone){
        $array['rc'] = 0;
        $array['oId'] = $id;
        $array['action'] = $actionDone;
        echo json_encode($array);
    }

    protected function doSuccessO($object){
        $object=json_encode((array)$object);
        echo str_replace("\u0000*\u0000", "", $object); 
    }  
    
    protected function doSuccessImport($nbrContact, $nbrContactExist){
        $array=array();
        $array['contactInserted']=$nbrContact;
        $array['contactExist']=$nbrContactExist;
        echo json_encode($array);
    }
    
    protected function doStatus($messageId, $status){
        $status['messageId'] = $messageId;
        echo json_encode($status);
    }
    
    protected function doError($errorCode,$message){
       $array['rc'] = $errorCode;
       $array['error'] = $message;
       echo json_encode($array);
    }

    /**
     * Cette fonction retourne une liste d'objets sous forme de tableau
     * @param type listObject
     * @return array
     */
    protected function listObjectToArray($object){
        $array=array();
        foreach ($object as $value) {
            $array[]= (array)$value;

        }
        return $array;
    }
    protected function objectToArray($value){            
        return (array)$value;
    }

    protected function dataTableFormat($objects, $sEcho, $iTotalRecords) {
       $arraySEcho['sEcho']=$sEcho;
       $arraySEcho['iTotalRecords']=  count($objects).'';
       $arraySEcho['iTotalDisplayRecords']= $iTotalRecords.'';
       $arraySEcho['aaData']=(array) $objects;
       return $arraySEcho;
    }
}

