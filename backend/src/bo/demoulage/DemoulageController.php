<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;;
use Exceptions\ConstraintException as ConstraintException;
use App as App;

class DemoulageController extends BaseController  {

    private $parameters;

    function __construct($request) {

        // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if (isset($request['ACTION'])) {
                switch ($request['ACTION']) {
                    case \App::ACTION_INSERT:
                        $this->doInsert($request);
                        break;
                }
            } else {
                throw new Exception('NO ACTION');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        try {
            if ($request['nombreParCarton'] !="" && $request['nombreCarton'] != "") {
                $produitManager = new \Produit\ProduitManager();
                $produit=$produitManager->findById($request['produitId']);
                $demoulage = new Produit\Demoulage();
                $demoulageManager = new Produit\DemoulageManager();
                $demoulage->setNombreCarton($request['nombreCarton']);
                $demoulage->setNombreParCarton($request['nombreParCarton']);
                $demoulage->setProduit($produit);
                $demoulageAdded = $demoulageManager->insert($demoulage);
                if ($demoulageAdded->getId() != null) {
                    $this->doSuccess($demoulageAdded->getId(), 'Produit demoulé avec succes');
                } else {
                    throw new Exception('Insertion impossible');
                }
            } else {
                throw new Exception('Données invalides');
            }
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

  
}

$oDemoulageController = new DemoulageController($_REQUEST);
