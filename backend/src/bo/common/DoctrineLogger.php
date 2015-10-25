<?php

/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Group
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */

namespace Common;
use Log\Loggers as Logger;

class DoctrineLogger implements \Doctrine\DBAL\Logging\SQLLogger{
    private static $FILEPATH='doctrineLog.txt';
    private $logger;
    public function startQuery($sql, array $params = null, array $types = null) {
        $this->logger=new Logger(__CLASS__);
        $this->logger->log->debug($sql);
        $this->logger->log->debug($params);
    }

    public function stopQuery() {
        
    }

}
