<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Achat\Achat as Achat;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Achat\AchatManager as AchatManager;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class AchatController extends BaseController implements BaseAction {

    
    private $parameters;
            function __construct($request) {
       
       // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if(isset($request['ACTION'])) 
                {
                    switch ($request['ACTION']) {
                        case \App::ACTION_INSERT:
                                $this->doInsert($request);
                                break;
                        case \App::ACTION_UPDATE:
                                $this->doUpdate($request);
                                break;
                        case \App::ACTION_VIEW:
                                $this->doView($request);
                                break;
                        case \App::ACTION_LIST:
                                $this->doList($request);
                                break;
                        case \App::ACTION_REMOVE:
                                $this->doRemove($request);
                                break;
                        case \App::ACTION_GET_PRODUCT:
                                $this->doGetInfoProduct($request);
                                break;
                        case \App::ACTION_SEARCH:
                                $this->doSearch($request);
                                break;
                                break;
                        case \App::ACTION_LIST_PAR_USINE:
                                $this->doGetAchatParUsine($request);
                                break;
                        
                    }
            } else {
                throw new Exception('NO_ACTION');
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        try {
                $achatManager = new AchatManager();
                $achat = new Achat();
                $achat->setNumero($request['numAchat']);
                $achat->setDateAchat(new \DateTime("now"));
                $achat->setPoidsTotal($request['poidsTotal']);
                $achat->setMontantTotal($request['montantTotal']);
                $achat->setModePaiement($request['modePaiement']);
                $achat->setNumCheque($request['numCheque']);
                $achat->setCodeUsine($request['codeUsine']);
                $achat->setLogin($request['login']);
                $achatAdded = $achatManager->insert($achat);
                if ($achatAdded->getId() != null) {
                    $jsonAchat = json_decode($_POST['jsonProduit'], true);
                         foreach ($jsonAchat as $key => $ligneachat) {
//                            /$ligne = json_decode($ligneachat, TRUE);
                            if(isset($ligneachat["Désignation"])) {
                                $ligneAchat = new \Achat\LigneAchat();
                                $ligneAchat->setAchat($achat);
                                $produitId = $ligneachat["Désignation"];
                                $produitManager = new Produit\ProduitManager();
                                $produit= $produitManager->findById($produitId);
                                $ligneAchat->setProduit($produit);
                                $ligneAchat->setQuantite($ligneachat['Quantite (kg)']);
                                $ligneAchat->setMontant($ligneachat['Montant']);
                                $ligneAchat->setPoids($ligneachat['Poids Net (kg)']);
                                $ligneAchatManager = new \Achat\LigneAchatManager();
                                $ligneAchatManager->insert($ligneAchat); 
                            }
                         }
                    $this->doSuccess($achatAdded->getId(), 'Achat enregistré avec succes');
                } else {
                    $this->doError('-1', 'Impossible d\'inserer cet achat');
                }
                
            
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }

    
    public function doList($request) {
        try {
            $produitManager = new AchatManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('designation', 'poidsNet', 'prixUnitaire');
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
                    $sSearchs = explode(" ", $request['sSearch']);
                    for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= " ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                       // $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $produits = $produitManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($produits != null) {
                    $nbAchats = $produitManager->count($sWhere);
                    $this->doSuccessO($this->dataTableFormat($produits, $request['sEcho'], $nbAchats));
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

    public function doRemove($request) {
        
    }

    public function doUpdate($request) {
        
    }

    public function doView($request) {
        
    }

}

        $oAchatController = new AchatController($_REQUEST);