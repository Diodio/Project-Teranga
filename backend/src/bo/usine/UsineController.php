<?php

require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Usine\Usine as Usine;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Usine\UsineManager as UsineManager;
use Exceptions\ConstraintException as ConstraintException;
use App as App;

class UsineController extends BaseController implements BaseAction {

    private $parameters;

    function __construct($request) {

        // $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if (isset($request['ACTION'])) {
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
                    case \App::ACTION_REVOKE:
                        $this->doRevoke($request);
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
            if (isset($request['familleName']) && $request['familleName'] != "") {
                $familleproduit = new FamilleProduit();
                $familleproduitManager = new FamilleProduitManager();
                $familleproduit->setLibelle($request['familleName']);
                $familleAdded = $familleproduitManager->insert($familleproduit);
                if ($familleAdded->getId() != null) {
                    $this->doSuccess($familleAdded->getId(), 'Famille de Produit enregistré avec succes');
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

    public function doUpdate($request) {
        try {
            if (isset($request['familleId']) && isset($request['familleName'])) {
                $familleproduitManager = new FamilleProduitManager();
                $familleproduit = $familleproduitManager->findById($request['familleId']);
                $familleproduit->setLibelle($request['familleName']);
                $familleUpdated = $familleproduitManager->update($familleproduit);
                if($familleUpdated->getId() != null) {
                    $this->doSuccess($familleUpdated->getId(), 'Famille de Produit modifié avec succes');
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

    public function doList($request) {
        try {
            if (isset($request['ACTION'])) {
                $usineManager = new UsineManager();
                $usine = $usineManager->retrieveAll();
                if ($usine != NULL) {
                    $this->doSuccessO($this->listObjectToArray($usine));
                } else
                    echo json_encode(array());
            }else {

                throw new ConstraintException('Données invalides');
            }
        } catch (ConstraintException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doRemove($request) {
        try {
            if (isset($request['familleId'])) {
                $familleManager = new FamilleProduitManager();
                $nbDeleted = $familleManager->delete($request['familleId']);
                $this->doSuccess($nbDeleted, 'REMOVED');
            } else {
                throw new ConstraintException('Données invalides');
            }
        } catch (ConstraintException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doView($request) {
        try {
            if (isset($request['familleId'])) {
                $familleManger = new FamilleProduitManager();
                $famille = $familleManger->view($request['familleId']);
                if ($famille != NULL) {
                    $this->doSuccessO($famille);
                } else
                    echo json_encode(array());
            }
            else {
                throw new ConstraintException("Donnees invalide");
            }
        } catch (ConstraintException $e) {
            $logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $logger->log->error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

}

$oUsineController = new UsineController($_REQUEST);
