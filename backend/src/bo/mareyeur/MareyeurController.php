<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Mareyeur\Mareyeur as Mareyeur;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Mareyeur\MareyeurManager as MareyeurManager;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class MareyeurController extends BaseController implements BaseAction {

    
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
                        case \App::ACTION_LIST_VALID:
                                $this->doGetMareyeurs($request);
                                break;
                            
                        case \App::ACTION_GET_MAREYEURS:
                                $this->doGetInfoMareyeurs($request);
                                break;
                        case \App::ACTION_GET_LAST_NUMBER:
                                $this->doGetLastNumberMareyeur($request);
                                break;
                    }
            } else {
                throw new Exception($this->parameters['NO_ACTION']);
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        try {
                $mareyeur = new Mareyeur();
                $mareyeurManager = new MareyeurManager();
                $mareyeur->setReference($request['reference']);
                $mareyeur->setNom($request['nom']);
                $mareyeur->setAdresse($request['adresse']);
                $mareyeur->setTelephone($request['telephone']);
                $mareyeur->setMontantFinancement($request['compte']);
                $mareyeurAdded = $mareyeurManager->insert($mareyeur);
                if ($mareyeurAdded->getId() != null) {
                        $this->doSuccess($mareyeurAdded->getId(), 'Mareyeur enregistre avec succes');
                } else {
                    throw new Exception('impossible d\'inserer ce mareyeur');
                }
            
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doUpdate($request) {
         try {
             $mareyeurManager = new MareyeurManager();
             if($request['oper'] == 'edit') {
                $mareyeur = $mareyeurManager->findById($request['id']);
                $mareyeur->setNom($request['nom']);
                $mareyeur->setAdresse($request['adresse']);
                $mareyeur->setTelephone($request['telephone']);
                $mareyeur->setMontantFinancement($request['montantFinancement']);
                $mareyeurAdded = $mareyeurManager->update($mareyeur);
                if ($mareyeurAdded->getId() != null) {
                        $this->doSuccess($mareyeurAdded->getId(), 'Mareyeur mis à jour avec succes');
                } else {
                    throw new Exception('impossible d\'inserer ce mareyeur');
                }
             }
             else if($request['oper'] == 'del'){
                 if($request['id'] !=null) {
                     $nbLines = $mareyeurManager->delete($request['id']);
                     $this->doSuccess($nbLines, 'REMOVED');
                 }
                 else {
                     throw new Exception('impossible de supprimer ce mareyeur');
                 }
                     
             }
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

   public function doList($request) {
        try {
            if (isset($request['userId'])) {
                $mareyeurManager= new MareyeurManager();
                $mareyeurs = $mareyeurManager->findAllMareyeurs($request['userId']);
                if ($mareyeurs != NULL) {
                    $this->doSuccessO($this->listObjectToArray($mareyeurs));
                } else
                    echo json_encode(array());
            }else {
                throw new ConstraintException('Donnees invalides');
            }
        } catch (ConstraintException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR_SERVEUR');
        }
    }
    public function doRemove($request) {
        $this->logger->log->info('Action Remove contact');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['contactIds'])) {
                $this->logger->log->info('Remove with params : ' . $request['contactIds']);
                $contactId = $request['contactIds'];
                $contactManager = new ContactManager();
                $nbModified = $contactManager->remove($contactId);
                $this->doSuccess($nbModified, $this->parameters['REMOVED']);
            } else {
                $this->logger->log->trace('Remove : Params not enough');
                $this->doError('-1', $this->parameters['CONTACT_NOT_REMOVED']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doView($request) {
       
        try {
            if (isset($request['productId'])) {
                $this->logger->log->info('View params : ' . $request['productId']);
                $mareyeurManager = new MareyeurManager();
                $mareyeur = $mareyeurManager->view($request['productId']);
                $this->doSuccessO($mareyeur);
            } else {
                throw new Exception('PARAM_NOT_ENOUGH');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }
    
    public function doGetMareyeurs($request) {
            $mareyeurManager = new MareyeurManager();
            
        try {
            $mareyeurs = $mareyeurManager->retrieveAllMareyeur();
            
            if ($mareyeurs != null)
                $this->doSuccessO($mareyeurs);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    
    public function doGetInfoMareyeurs($request) {
            $mareyeurManager = new MareyeurManager();
            
        try {
            $mareyeurs = $mareyeurManager->findInfoMareyeurs($request['mareyeurId']);
            if ($mareyeurs != null)
                $this->doSuccessO($mareyeurs);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    
     public function doGetLastNumberMareyeur($request) {
        try {
                $mareyeurManager = new MareyeurManager();
                $lastMareyeur = $mareyeurManager->getLastMareyeurNumber();
                $this->doSuccess($lastMareyeur,'Dernier mareyeur');
        }  catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
}
$oMareyeurController = new MareyeurController($_REQUEST);