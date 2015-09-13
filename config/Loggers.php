<?php
namespace Log;
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
if (is_file('../lib/log4php/Logger.php'))
{
    require_once '../lib/log4php/Logger.php';
} else if (is_file('../../lib/log4php/Logger.php'))
{
    require_once '../../lib/log4php/Logger.php';
}else if (is_file('../../../lib/log4php/Logger.php')){
    require_once '../../../lib/log4php/Logger.php';
}else if (is_file('../../../../lib/log4php/Logger.php')){
    require_once '../../../../lib/log4php/Logger.php';
}
class Loggers extends \Logger{
    public $log;
    public function __construct($categoryLogger) {
        parent::__construct('Logger');
        if (is_file('../config/config.xml'))
        {
            \Logger::configure('../config/config.xml');
        }
        else if (is_file('../../config/config.xml'))
        {
            \Logger::configure('../../config/config.xml');
        }else if (is_file('../../../config/config.xml')){
            \Logger::configure('../../../config/config.xml');
        }else if (is_file('../../../../config/config.xml')){
            \Logger::configure('../../../../config/config.xml');
        }
        $this->log =\Logger::getLogger($categoryLogger);
        date_default_timezone_set('GMT');
    }
}
