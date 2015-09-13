<?php
require_once 'bootstrap.php';
use Doctrine\ORM\Tools\Console\ConsoleRunner;
$bootstrap =new \Racine\Bootstrap();
// replace with mechanism to retrieve EntityManager in your app
$entityManager=$bootstrap->getEntityManager();
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($entityManager->getConnection()),
'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));
return ConsoleRunner::createHelperSet($entityManager);