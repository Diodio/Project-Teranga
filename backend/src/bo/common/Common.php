<?php



namespace Common;


class Common {
    
    
    private static $HEURE=1800; //30*60s voir /index.php et /signin.php
    
    /**
     * Reinitialise les cookies 
     * 
     * @param type $customerId
     * @param type $customerLogin
     * @param type $customercompanyName
     * @param type $customerAdress
     * @param type $customerEmail
     * @param type $customerContactName
     * @param type $customerContactPhone
     * @param type $customerLanguage
     * 
     * 
     */
    public static function setCookies($id, $customerId, $login, 
             $contactName,  $code, $profil) {
        Common::unsetCookieCustomer();
        Cookie::Set('customerId', $customerId);
        Cookie::Set('userId', $id);
        Cookie::Set('userLogin', $login);
        Cookie::Set('userContactName', $contactName);
        Cookie::Set('userLanguage', $code);
        Cookie::Set('userProfil', $profil);
    }
     public static function setBoCookies($id, $login, 
             $contactName, $profil) {
        Common::unsetCookieBoUser();
        Cookie::Set('userId', $id);
        Cookie::Set('contactName', $contactName);
        Cookie::Set('login', $login);
        Cookie::Set('userProfil', $profil);
    }
    
     public static function unsetCookieBoUser() {
        Cookie::Delete('userId');
        Cookie::Delete('contactName');
        Cookie::Delete('login');
        Cookie::Delete('userProfil');
    }
    
    public static function setPartnerCookies($partnerId, $partnerCode) {
        Common::unsetCookieCustomer();
        Cookie::Set('partnerId', $partnerId);
        Cookie::Set('partnerCode', $partnerCode);
    }
    public static function unsetCookieCustomer() {
        Cookie::Delete('customerId');
        Cookie::Delete('userId');
        Cookie::Delete('userLogin');
        Cookie::Delete('userContactName');
        Cookie::Delete('userLanguage');
        Cookie::Delete('userProfil');
    }
    
   
    
    
    
    public static function unsetCookiePartner(){
        unset($_COOKIE['partnerCode']);
        unset($_COOKIE['partnerName']);
        unset($_COOKIE['partnerTrademark']);
        unset($_COOKIE['partnerCellular']);
        unset($_COOKIE['partnerFax']);
        unset($_COOKIE['partnerTemplate']);
        unset($_COOKIE['partnerEmail']);
        unset($_COOKIE['partnerLanguage']);
    }
    public static function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            );
    }
    
   
    public static function setFormatDate(){
        
            return '%d-%m-%Y';
    }
    public static function setFormatDateTime(){
        
            return '%d-%m-%Y %T';
    }
    
    public static function setAllCookies() {
        if (isset($_COOKIE['provider']) && $_COOKIE['provider'] == 'PORTAIL') {
            if (isset($_COOKIE['userId'])) {
                Common::setCookies($_COOKIE['userId'], $_COOKIE['customerId'], $_COOKIE['userLogin'], $_COOKIE['userContactName'], $_COOKIE['userLanguage'], $_COOKIE['userProfil']);
                return 1;
            } else {
                return 0;
            }
        } else if (isset($_COOKIE['provider']) && $_COOKIE['provider'] == 'BO') {
            if (isset($_COOKIE['userId'])) {
                Common::setBoCookies($_COOKIE['userId'], $_COOKIE['login'], $_COOKIE['contactName'], $_COOKIE['userProfil']);
                return 1;
            } else {
                return 0;
            }
        }
        else
            return 0;
    }

}
