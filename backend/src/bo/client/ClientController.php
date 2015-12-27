<?php


require_once '../../../../common/app.php';
require_once App::AUTOLOAD;
$lang='fr';

use Client\Client as Client;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Client\ClientManager as ClientManager;
use Exceptions\ConstraintException as ConstraintException;
use App as App;

class ClientController extends BaseController implements BaseAction {


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
                                                $this->doGetListClients($request);
                                                break;
                                        case \App::ACTION_GET_INFOS:
                                                $this->doGetAdress($request);
                                                break;
                                        case \App::ACTION_GET_LAST_NUMBER:
                                                $this->doGetLastNumber($request);
                                                break;
                                        case \App::ACTION_LIST_VALID:
                                                $this->doRetrieveClients($request);
                                                break;
                                        case \App::ACTION_GET_INFO_CLIENT:
                                                $this->doGetInfosClient($request);
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
			$client = new Client();
			$clientManager = new ClientManager();
			$client->setReference($request['reference']);
			$client->setNom($request['nom']);
			$client->setAdresse($request['adresse']);
			$client->setPays($request['pays']);
			$client->setTelephone($request['telephone']);
			$clientAdded = $clientManager->insert($client);
			if ($clientAdded->getId() != null) {
				$this->doSuccess($clientAdded->getId(), 'Client enregistré avec succes');
			} else {
				throw new Exception('impossible d\'inserer ce client');
			}

		} catch (Exception $e) {
			throw new Exception('ERREUR SERVEUR');
		}
	}

	public function doUpdate($request) {
		try {
			$clientManager = new ClientManager();
			if($request['oper'] == 'edit') {
				$client = $clientManager->findById($request['id']);
				$client->setNom($request['nom']);
				$client->setAdresse($request['adresse']);
                                $client->setPays($request['pays']);
				$client->setTelephone($request['telephone']);
				$clientAdded = $clientManager->update($client);
				if ($clientAdded->getId() != null) {
					$this->doSuccess($clientAdded->getId(), 'Client mis à jour avec succes');
				} else {
					throw new Exception('impossible d\'inserer ce client');
				}
			}
			else if($request['oper'] == 'del'){
				if($request['id'] !=null) {
					$nbLines = $clientManager->delete($request['id']);
					$this->doSuccess($nbLines, 'REMOVED');
				}
				else {
					throw new Exception('impossible de supprimer ce client');
				}
				 
			}
		} catch (Exception $e) {
			throw new Exception('ERREUR SERVEUR');
		}
	}

	public function doList($request) {
		try {
			if (isset($request['userId'])) {
				$clientManager= new ClientManager();
				$clients = $clientManager->findAllClients($request['userId']);
				if ($clients != NULL) {
					$this->doSuccessO($this->listObjectToArray($clients));
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
				$clientManager = new ClientManager();
				$client = $clientManager->view($request['productId']);
				$this->doSuccessO($client);
			} else {
				throw new Exception('PARAM_NOT_ENOUGH');
			}
		} catch (Exception $e) {
			throw $e;
		} catch (Exception $e) {
			throw new Exception('ERREUR SERVEUR');
		}
	}
         public function doGetListClients($request) {
            $clientManager = new ClientManager();
            
        try {
            $mareyeurs = $clientManager->findListClients();
            
            if ($mareyeurs != null)
                $this->doSuccessO($mareyeurs);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    public function doGetAdress($request) {
            $clientManager = new ClientManager();
            
        try {
            $client = $clientManager->findAdress($request['clientId']);
            if ($client != null)
                $this->doSuccessO($client);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    public function doGetLastNumber($request) {
        try {
            $clientManager = new ClientManager();
            $last = $clientManager->getLastNumber();
            $this->doSuccess($last, 'Dernier client');
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }
    public function doRetrieveClients($request) {
            $clientManager = new ClientManager();
            
        try {
            $clients = $clientManager->retrieveClients();
            
            if ($clients != null)
                $this->doSuccessO($clients);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
    
     public function doGetInfosClient($request) {
            $clientManager = new ClientManager();
        try {
            $client = $clientManager->findInfosClient($request['clientId']);
            if ($client != null)
                $this->doSuccessO($client);
            else
                echo json_encode(array());
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR SERVEUR');
        }
    }
}

$oClientController = new ClientController($_REQUEST);