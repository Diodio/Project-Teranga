<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Produit\Produit as Produit;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Stock\StockManager as StockManager;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class StockController extends BaseController {

    
    private $parameters;
            function __construct($request) {
       
       // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if(isset($request['ACTION'])) 
                {
                    switch ($request['ACTION']) {
                        case \App::ACTION_LIST:
                                $this->doList($request);
                                break;
                        case \App::ACTION_STAT:
                                $this->doGetStat($request);
                                break;
                        case \App::ACTION_STAT_FAMILLE:
                                $this->doGetStatFamille($request);
                                break;
                        case \App::ACTION_GET_STOCK:
                                $this->doGetStockReel($request);
                                break;
                        
                    }
            } else {
                throw new Exception('NO_ACTION');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    public function doList($request) {
        try {
            $stockManager = new StockManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('libelle', 'stock');
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
                        $sOrder = "";
                    }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
             if (isset($request['sSearch']) && $request['sSearch'] != "") {
                    //$sSearchs = explode(" ", $request['sSearch']);
                  //  for ($j = 0; $j < count($sSearchs); $j++) {
                  //      $sWhere .= " ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $request['sSearch'] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        // $sWhere = $sWhere .=")";
                //    }
                }
                // End filter from dataTable
//                if((isset ($request['profil']) && $request['profil'] == 'admin') || (isset ($request['profil']) && $request['profil'] == 'directeur'))
//                    $produits = $stockManager->retrieveAll('*', $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
//                else
                $produits = $stockManager->retrieveAllByUsine($request['usineCode'], $request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($produits != null) {
                    if((isset($request['profil']) && $request['profil'] == 'admin') || (isset ($request['profil']) && $request['profil'] == 'directeur'))
                        $nbProduits = $stockManager->countAll('*',$sWhere);
                    else
                       $nbProduits = $stockManager->countByUsine($request['usineCode'], $sWhere);
                    $this->doSuccessO($this->dataTableFormat($produits, $request['sEcho'], $nbProduits));
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

     public function doGetStat($request) {
        try {
            if (isset($request['userId'])) {
                $stockManager = new StockManager();
               // $request['login'],$request['codeUsine']
                if((isset($request['profil']) && $request['profil'] == 'admin') || (isset ($request['profil']) && $request['profil'] == 'directeur'))
                    $infoStocks = $stockManager->findStats('*');
                else
                     $infoStocks = $stockManager->findStats($request['usineCode']);
                if ($infoStocks !== NULL) {
                    $this->doSuccessO($infoStocks);
                } else
                    echo json_encode(array());
            }
            else {
                throw new Exception('Données invalides');
            }
        
        } catch (Exception $e) {
           $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    
     public function doGetStatFamille($request) {
        try {
            if (isset($request['userId'])) {
                $stockManager = new StockManager();
                $infoStocks = $stockManager->findStatsFamille($request['familleId'],$request['codeUsine']);
                if ($infoStocks !== NULL) {
                    $this->doSuccessO($infoStocks);
                } else
                    echo json_encode(array());
            }
            else {
                throw new Exception('Données invalides');
            }
        
        } catch (Exception $e) {
           $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    
    public function doGetStockReel($request) {
        try {
            if (isset($request['produitId'])) {
                $stockManager = new StockManager();
                $infoStocks = $stockManager->recupereNombreStockParProduit($request['produitId'],$request['codeUsine']);
                if ($infoStocks !== NULL) {
                    $this->doSuccessO($infoStocks);
                } else
                    echo json_encode(array());
            }
            else {
                throw new Exception('Données invalides');
            }
        
        } catch (Exception $e) {
           $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
   
}

        $oStockController = new StockController($_REQUEST);