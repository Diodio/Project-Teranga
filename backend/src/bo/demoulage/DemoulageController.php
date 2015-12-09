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
                $demoulageManager = new Produit\DemoulageManager();
                $demou = $demoulageManager->verifieDemoulage($request['produitId'], $request['codeUsine']);
                $demoulage = new Produit\Demoulage();
                if($demou == 0)
                    $demoulage->setId ($demou);
                $demoulage->setNombreCarton($request['nombreCarton']);
                $demoulage->setNombreParCarton($request['nombreParCarton']);
                $demoulage->setProduit($produit);
                $demoulage->setCodeUsine($request['codeUsine']);
                $demoulage->setLogin($request['login']);
                $demoulageAdded = $demoulageManager->insert($demoulage);
                  
                if ($demoulageAdded->getId() != null) {
                    if($request['stockFinal'] !=""){
                      $stockManager = new \Stock\StockManager();
                       $stockManager->ajoutStockFinalParProduit($request['produitId'], $request['codeUsine'], $request['login'], $request['stockFinal']);
                    }
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