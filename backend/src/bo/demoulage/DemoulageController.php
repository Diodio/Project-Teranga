<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
use Produit\DemoulageManager as DemoulageManager;

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
					case \App::ACTION_LIST_DEMOULE:
						$this->doListeDemoule($request);
						break;
					case \App::ACTION_GET_COLIS_DEMOULAGE:
						$this->doGetColisColisage($request);
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
        
        public function doGetColisColisage($request) {
		try {
			if (isset($request['demoulageId'])) {
				$demoulageManager = new Produit\DemoulageManager();
				$infoscolis = $demoulageManager->getAllColisDemoulage($request['demoulageId'], $request['codeUsine']);
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
	
	
	public function doListeDemoule($request) {
		try {
			$demoulageManager = new DemoulageManager();
			if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
				// Begin order from dataTable
				$sOrder = "";
				$aColumns = array('numero','libelle', 'quantiteAdemouler', 'quantiteDemoulee');
				if (isset($request['iSortCol_0'])) {
					$sOrder = "ORDER BY  ";
					for ($i = 0; $i < intval($request['iSortingCols']); $i++) {
						if ($request['bSortable_' . intval($request['iSortCol_' . $i])] == "true") {
							$sOrder .= "" . $aColumns[intval($request['iSortCol_' . $i])] . " " .
									($request['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
						}
					}
	
					$sOrder = substr_replace($sOrder, "", -2);
					if ($sOrder == "ORDER BY") {
						$sOrder .= " numero desc";
					}
				}
				// End order from DataTable
				// Begin filter from dataTable
				$sWhere = "";
				if (isset($request['sSearch']) && $request['sSearch'] != "") {
					$sSearchs = explode(" ", $request['sSearch']);
					for ($j = 0; $j < count($sSearchs); $j++) {
						$sWhere .= "( ";
						for ($i = 0; $i < count($aColumns); $i++) {
							$sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
							if ($i == count($aColumns) - 1)
								$sWhere = substr_replace($sWhere, "", -3);
						}
						$sWhere = $sWhere .=")";
					}
				}
				// End filter from dataTable
				$demoulages = $demoulageManager->retrieveAll($request['codeUsine'],$request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
				if ($demoulages != null) {
					$nb = $demoulageManager->countAll($request['codeUsine'],$sWhere);
					$this->doSuccessO($this->dataTableFormat($demoulages, $request['sEcho'], $nb));
				} else {
					$this->doSuccessO($this->dataTableFormat(array(), $request['sEcho'], 0));
				}
			} else {
				throw new Exception('list failed');
			}
		} catch (Exception $e) {
			throw $e;
		} catch (Exception $e) {
			throw new Exception('ERREUR SERVEUR');
		}
	}
}

$oDemoulageController = new DemoulageController($_REQUEST);
