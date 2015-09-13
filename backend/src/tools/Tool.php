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

namespace tools;

class Tool {
	
	/**
	 * verif_alphaNum
	 * 
	 *  permet de verifier si le test ecrit est alphanumerique ou non
	 *  
	 * @param string $str
	 * @return boolean
	 */
	static function verif_alphaNum($str){
		preg_match("/([^A-Za-z0-9])/",$str,$result);
		//On cherche tt les caract�res autre que [A-Za-z] ou [0-9]
		if(!empty($result)){//si on trouve des caract�re autre que A-Za-z ou 0-9
			return false;
		}
		return true;
	}
	
	
	/**
	 * Character Limiter
	 *
	 * Limits the string based on the character count.  Preserves complete words
	 * so the character count may not be exactly as specified.
	 *
	 * @access	public
	 * @param	string
	 * @param	integer 
	 * @return	string
	 */
	static function character_limiter($str, $n)
	{
		if (strlen($str) < $n)
		{
			return $str;
		}
	
		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
	
		if (strlen($str) <= $n)
		{
			return $str;
		}
		 
	}
        
        static function extractNum($chaine) {
            $id = "";
            $ref = " 1234567890";
            for ($i = 0; $i < strlen($chaine); $i++) {
                $car = substr($chaine, $i, 1);
                if (strpos($ref, $car) == true) {
                    $id = $id . $car;
                }
            }
            return $id;
        }
        
        static function multipleExplode ($string) {
            $delimiters=array(",",";","|");
            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);
            return  $launch;
        }
        
        function extractDateFormat($date){
            $time = strtotime($date);
            return date('Y-m-d', $time);
        }
        
        static function isLocal($indic, $num)
        {
            $isLoc="INT";
            if(substr($num,0,strlen($indic))==$indic) $isLoc="LOC";
            return $isLoc;
        }
}
