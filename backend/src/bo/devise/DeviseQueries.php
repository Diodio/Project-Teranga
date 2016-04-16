<?php

namespace Devise;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class DeviseQueries {
    /*
     *
     */

    private $entityManager;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
    }

     public function update($devise) {
        if ($devise != null) {
            Bootstrap::$entityManager->merge($devise);
            Bootstrap::$entityManager->flush();
            return $devise;
        }
    }
}
