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
                    case \App::ACTION_GET_COLIS:
                        $this->doGetColis($request);
                        break;   
                    case \App::ACTION_GET_COLISAGES:
                                $this->doVerifieColis($request);
                                break;
                    case \App::ACTION_GET_INFOS:
                                $this->doGetQuantite($request);
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
            if ($request['produitId'] !="" && $request['stockReel'] != "") {
                $produitManager = new \Produit\ProduitManager();
                $produit=$produitManager->findById($request['produitId']);
                $demoulageManager = new Produit\DemoulageManager();
               // $demou = $demoulageManager->verifieDemoulage($request['produitId'], $request['codeUsine']);
                $demoulage = new Produit\Demoulage();
                //if($demou == 0)
                //    $demoulage->setId ($demou);
              // $demoulage->setNombreCarton($request['nombreCarton']);
              //  $demoulage->setNombreParCarton($request['nombreParCarton']);
                $demoulage->setProduit($produit);
                $demoulage->setCodeUsine($request['codeUsine']);
                $demoulage->setLogin($request['login']);
                $demoulageAdded = $demoulageManager->insert($demoulage);
                if ($demoulageAdded->getId() != null) {
                    if($request['stockReel'] !=""){
                      $stockManager = new \Stock\StockManager();
                       $stockManager->ajoutStockReelParProduit($request['produitId'], $request['codeUsine'], $request['login'], $request['stockReel']);
                       $jsonCarton = json_decode($_POST['jsonCarton'], true);
                         foreach ($jsonCarton as $key => $ligneCarton) {
                            if(isset($ligneCarton["nbCarton"])) {
                                $carton = new \Produit\Carton();
                                $carton->setDemoulage($demoulage);
                                $carton->setNombreCarton($ligneCarton['nbCarton']);
                                $carton->setQuantiteParCarton($ligneCarton['qte']);
                                $carton->setTotal($ligneCarton['total']);
                                $carton->setProduitId($request['produitId']);
                                $cartonManager = new Produit\CartonManager();
                                $cartonManager->insert($carton); 
                            }
                         }
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

  public function doGetColis($request) {
        try {
            if (isset($request['produitId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $infoscolis = $demoulageManager->getAllColis($request['produitId'], $request['codeUsine']);
                    if($infoscolis!= NULL){
                        $this->doSuccessO($infoscolis);
                    }  else {
                         echo json_encode(array());
                    }
        } else{
                $this->doError('-1', 'Données invalides');
        }
        
        }catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    
    public function doVerifieColis($request) {
        try {
            if (isset($request['produitId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $infoscolis = $demoulageManager->verificationColis($request['produitId'],$request['nbColis'],$request['quantite']);
                $this->doSuccess($infoscolis, 'Produit demoulé avec succes');
                   
        } else{
                $this->doError('-1', 'Données invalides');
        }
        
        }catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
    public function doGetQuantite($request) {
        try {
            if (isset($request['produitId'])) {
                $demoulageManager = new Produit\DemoulageManager();
                $colis = $demoulageManager->getQuantiteColisage($request['produitId']);
                if($colis !=null)
                    $this->doSuccessO($colis);
                else
                   echo json_encode(array());  
            } else {
                throw new Exception('PARAM_NOT_ENOUGH');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }
}

$oDemoulageController = new DemoulageController($_REQUEST);
