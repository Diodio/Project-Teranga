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
class App
{
    const APP_ROOT='websms';
    const BO='src/bo';
    const FILE_PARAMETERS="parameters.ini";
    const FILE_PARAMETERS_IN_PROCESSINGMANAGER="../../../../portail/config/parameters.ini";
    const LANG = "../../lang";
    const I18N_CLASS = "../../../lib/i18n/class/l18n.class.php";
    const AUTOLOAD = "../../../../lib/doctrine/vendor/autoload.php";
    const MAILER = "../../../../lib/mail/class.phpmailer.php";
    const XLSXCLASS = "../../../../lib/pexcel/simplexlsx.class.php";
    const EXCELREADER = "../../../../lib/pexcel/excel_reader.php";
    const UPLOADFILE="../../../../upload/";
     // Application actions
     const ACTION_INSERT='INSERT';
     const ACTION_UPDATE='UPDATE';
     const ACTION_VIEW='VIEW';
     const ACTION_LIST='LIST';
     const ACTION_LIST_GERANT='LIST_GERANT';
     const ACTION_LOADDEFAULT='LOADEMAIL';
     const ACTION_NOTALERTMAIL='NOTALERTMAIL';
     const ACTION_SAVEMAIL='SAVEMAIL';
     const ACTION_ALERTMAIL='ALERTMAIL';
     const ACTION_INSERT_VALIDATED='INSERT_VALIDATED';
     const ACTION_REMOVEFROMBACKOFFICE='REMOVEFROMBACKOFFICE';
     const ACTION_REMOVE_FROM_BACKEND='REMOVE_FROM_BACKEND';
     const ACTION_VIEW_FROM_BACKEND='VIEW_FROM_BACKEND';
     const ACTION_LIST_FROM_BACKEND='LIST_FROM_BACKEND';
     const ACTION_UPDATE_FROM_BACKEND='UPDATE_FROM_BACKEND';
     const ACTION_INSERT_FROM_BACKEND='INSERT_FROM_BACKEND';
     const ACTION_LIST_HISTORIES_SIGNATURES='LIST_HISTORIES_SIGNATURES';
     const ACTION_LIST_SIGNATURES_A_VALIDER='LIST_SIGNATURES_A_VALIDER';
     const ACTION_APPROVED_SIGNATURE='APPROVED_SIGNATURE';
     const ACTION_BLOCKED_SIGNATURE='BLOCKED_SIGNATURE';
     const ACTION_REMOVE='REMOVE';
     const ACTION_DELETE='DELETE';
     const ACTION_REVOKE='REVOKE';
     const ACTION_COPY='COPY';
     const ACTION_MOVE='MOVE';
     const ACTION_RESTORE='RESTORE';
     const ACTION_IMPORT='IMPORT';
     const ACTION_EXPORT='EXPORT';
     const ACTION_SEND='SEND';
     const ACTION_SEARCH='SEARCH';//Autocompletion dans destinataire
     const ACTION_INSERT_TEMPLATE='INSERT_TEMPLATE'; 
     const ACTION_LIST_VALID='LIST_VALID';
     const ACTION_DRAFT='DRAFT';
     const ACTION_STAT='STAT';
     const ACTION_STAT_ANNULE='STAT_ANNULE';
     const ACTION_STAT_FAMILLE='STAT_FAMILLE';
     const ACTION_VIEW_DETAILS='VIEW_DETAILS';
     const ACTION_SAVE='SAVE';
     const ACTION_START='START';
     const ACTION_PAUSE='PAUSE';
     const ACTION_RESUME='RESUME';
     const ACTION_STOP='STOP';
     const ACTION_PLAN='PLAN';
     const ACTION_POSTPONE='POSTPONE';
     const ACTION_COUNT='COUNT';
     const ACTION_LIST_DETAILS='LIST_DETAILS';
     const ACTION_LIST_RECIPIENTS='LIST_RECIPIENTS';
     const ACTION_COUNT_RECIPIENTS='COUNT_RECIPIENTS';
     const ACTION_LIST_GROUP='LIST_GROUP';
     const ACTION_LIST_PROFIL='LIST_PROFIL';
     const ACTION_SIGNIN='SIGNIN';
     const ACTION_SIGNOUT='SIGNOUT';
     const ACTION_ACTIVER='ACTIVER';
     const ACTION_DESACTIVER='DESACTIVER';
     const ACTION_DELETE_CONTACTADD='DELETE_CONTACTADD';
     const ACTION_GET_PASSWORD='GET_PASSWORD';
     const ACTION_SET_PASSWORD='SET_PASSWORD';
     const ACTION_SET_PRIORITY='SET_PRIORITY';
     const ACTION_TEST_CAMPAGNE='TEST_CAMPAGNE';
     const ACTION_GET_CUSTOMER_CONTACT='GET_CUSTOMER_CONTACT';
     const ACTION_GET_ONE_CUSTOMER_CONTACT='GET_ONE_CUSTOMER_CONTACT';
     const ACTION_INSERT_CUSTOMER_CONTACT='INSERT_CUSTOMER_CONTACT';
     const ACTION_UPDATE_CUSTOMER_CONTACT='UPDATE_CUSTOMER_CONTACT';
     const ACTION_LIST_SIGNATURE_PERIOD='LIST_SIGNATURE_PERIOD';
     const ACTION_LIST_CUSTOMER='LIST_CUSTOMER';
     const ACTION_LIST_COUNT_SIGNATURE='LIST_COUNT_SIGNATURE';
     const ACTION_COUNT_PENDING_SIGNATURE='COUNT_PENDING_SIGNATURE';
     const TIMEOUT='3600';
     const ACTION_GET_SUBSCRIPTIONTYPE='GET_SUBSCRIPTIONTYPE';
     const ACTION_GET_PRODUCT='GET_PRODUCT';
     const ACTION_GET_PRODUCT_EXPIRATION='GET_PRODUCT_EXPIRATION';
     const ACTION_GET_CUSTOMER_ACCOUNT='GET_CUSTOMER_ACCOUNT';
     const ACTION_UPDATE_CUSTOMER_ACCOUNT='UPDATE_CUSTOMER_ACCOUNT';
     const ACTION_ACTIVE_BIRTHDAY='ACTIVE_BIRTHDAY';
     const ACTION_DESACTIVE_BIRTHDAY='DESACTIVE_BIRTHDAY';
     const ACTION_GET_STATUS_BIRTHDAY='GET_STATUS_BIRTHDAY';
     const ACTION_GET_CONTACTS_BIRTHDAY='UPDATE_CUSTOMER_ACCOUNT';
     const ACTION_SAVE_BIRTHDAY='SAVE_BIRTHDAY';
     const ACTION_GET_ALL_CUSTOMERS_LOGINS='GET_ALL_CUSTOMERS_LOGINS';
     const ACTION_LIST_TRAFIC='LIST_TRAFIC';
     const ACTION_LIST_DETAILS_TRAFIC='LIST_DETAILS_TRAFIC';
     const ACTION_LIST_DETAILS_TRAFIC_BY_CUSTOMER='LIST_DETAILS_TRAFIC_BY_CUSTOMER';
     const ACTION_LIST_NUMBER_TRAFIC='LIST_NUMBER_TRAFIC';
     const ACTION_INSERT_BIRTHDAY_PARAMETRE='INSERT_BIRTHDAY_PARAMETRE';
     const ACTION_GET_ALL_CUSTOMERS_COMPANYNAME='ACTION_GET_ALL_CUSTOMERS_COMPANYNAME';
     const ACTION_GET_DETAILS_TRAFIC_BY_CUSTOMER='GET_DETAILS_TRAFIC_BY_CUSTOMER';
      const ACTION_GET_CUSTOMER_NAME='ACTION_GET_CUSTOMER_NAME';
     const ACTION_LIST_PENDING_MESSAGE='LIST_PENDING_MESSAGE';
     const ACTION_LIST_PAR_USINE='LIST_PAR_USINE';
     const ACTION_GET_LAST_NUMBER='GET_LAST_NUMBER';
     const ACTION_GET_MAREYEURS='GET_MAREYEURS';
     const ACTION_GET_COLISAGES='GET_COLISAGES';
     const ACTION_LIST_REGLEMENTS='LIST_REGLEMENTS';
     const ACTION_STAT_REGLEMENTS='STAT_REGLEMENTS';
     const ACTION_GET_INFOS='GET_INFOS';
     const ACTION_LIST_DEMOULAGES='LIST_DEMOULAGES';
     const ACTION_GET_COLIS='GET_COLIS';
     const ACTION_LIST_REEL_PAR_USINE='LIST_REEL_PAR_USINE';
     const ACTION_GET_INFO_CLIENT='GET_INFO_CLIENT';
     const ACTION_GET_STOCK='GET_STOCK';
     const ACTION_LIST_PRODUITS='LIST_PRODUITS';
     const ACTION_INSERT_TEMP='INSERT_TEMP';
     const ACTION_INSERT_FACTURE='INSERT_FACTURE';
     const ACTION_LIST_DEMOULE='LIST_DEMOULE';
     const ACTION_LIST_DEMOULE_ANNULE='LIST_DEMOULE_ANNULE';
     const ACTION_GET_COLIS_DEMOULAGE='GET_COLIS_DEMOULAGE';
     const ACTION_DETAIL_PRODUIT='DETAIL_PRODUIT';
     const ACTION_LIST_INVENTAIRE_ACHATS='LIST_INVENTAIRE_ACHATS';
     const ACTION_LIST_INVENTAIRE_FACTURES='LIST_INVENTAIRE_FACTURES';
     const ACTION_STAT_GERANT='LIST_STAT_GERANT';
     const ACTION_GET_COLIS_BONSORTIE='GET_COLIS_BONSORTIE';
     const ACTION_GET_ENTREE='GET_ENTREE';
     const ACTION_STAT_ENTREE='LIST_STAT_ENTREE';
     const  ACTION_LIST_FACTURE_ANNULES='LIST_FACTURE_ANNULES';
     const  ACTION_VERIFY_COLISAGE='VERIFY_COLISAGE';
     const  ACTION_GET_NBCOLIS='GET_NBCOLIS';
     const  ACTION_GET_DEVISE='GET_DEVISE';
     const  ACTION_UPDATE_LIGNE='UPDATE_LIGNE';
     
     
     
     
     
     static function getBoPath() {
         
         if (is_file(App::FILE_PARAMETERS))
        {
            $parameters=parse_ini_file(App::FILE_PARAMETERS);
         return $parameters['backend'].'/src/bo';
        }else if (is_file('../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../'.App::FILE_PARAMETERS);
         return $parameters['backend'].'/src/bo';
        }else if (is_file('../../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../../'.App::FILE_PARAMETERS);
         return $parameters['backend'].'/src/bo';
        }else if (is_file('../../../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../../../'.App::FILE_PARAMETERS);
         return $parameters['backend'].'/src/bo';
        }else if (is_file('../../../../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../../../../'.App::FILE_PARAMETERS);
         return $parameters['backend'].'/src/bo';
        }
         
     }
     static function getWebsmsPath(){
         return App::getHome();
     }
     static function getHomeBoPath(){
         return App::getHome();
     }
     static function getHome() {
         if (is_file(App::FILE_PARAMETERS))
        {
            $parameters=parse_ini_file(App::FILE_PARAMETERS);
            return $parameters['server'];
        }else if (is_file('../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../'.App::FILE_PARAMETERS);
            return $parameters['server'];
        }else if (is_file('../../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../../'.App::FILE_PARAMETERS);
            return $parameters['server'];
        }else if (is_file('../../../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../../../'.App::FILE_PARAMETERS);
            return $parameters['server'];
        }else if (is_file('../../../../'.App::FILE_PARAMETERS)){
            $parameters=parse_ini_file('../../../../'.App::FILE_PARAMETERS);
            return $parameters['server'];
        }
     }
}
