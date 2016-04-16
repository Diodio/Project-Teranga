<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Bo\BaseController as BaseController;
use Devise\DeviseManager as DeviseManager;
use Log\Loggers as Logger;
use App as App;

class DeviseController extends BaseController {

    private $logger;
    private $parameters;

    function __construct($request) {
        $this->logger = new Logger(__CLASS__);
        // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_UPDATE:
                        $this->doUpdate($request);
                        break;
                    case \App::ACTION_GET_DEVISE:
                        $this->doGetDevise($request);
                        break;
                }
            } else {
                throw new Exception('NO_ACTION');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
 
    public function doUpdate($request) {
         try {
             $deviseManager = new DeviseManager();
             $devise = new \Devise\Devise();
                $devise->setId($request['deviseId']);
                $devise->setDevise($request['devise']);
                $devise->setMontant($request['montant']);
                $deviseAdded = $deviseManager->update($devise);
                if ($deviseAdded->getId() != null) {
                        $this->doSuccess($deviseAdded->getId(), 'Devise modifiee avec succes');
                } else {
                    throw new Exception('impossible de modifier cette devise');
                }
             
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doGetDevise($request) {
        try {
            $deviseManager = new DeviseManager();
            $infos = $deviseManager->getInfoDevise();
            $this->doSuccessO($infos);
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
}

$oDeviseController = new DeviseController($_REQUEST);
