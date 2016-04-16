<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Bo\BaseController as BaseController;
use Inventaire\InventaireManager as InventaireManager;
use Log\Loggers as Logger;
use App as App;

class InventaireController extends BaseController {

    private $logger;
    private $parameters;

    function __construct($request) {
        $this->logger = new Logger(__CLASS__);
        // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_GET_INFOS:
                        $this->doGetInfoInventaire($request);
                        break;
                }
            } else {
                throw new Exception('NO_ACTION');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
 
    public function doGetInfoInventaire($request) {
    	try {
    		$inventaireManager = new InventaireManager();
    		$infos = $inventaireManager->getInfoInventaire($request['dateDebut'],$request['dateFin'], $request['codeUsine']);
    		$this->doSuccessO($infos);
    	} catch (Exception $e) {
    		$this->doError('-1', $e->getMessage());
    	}
    }
    
}

$oInventaireController = new InventaireController($_REQUEST);
