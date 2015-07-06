<?php

session_start();

require_once 'config.php';
require_once 'core/Autoloader.php';

use Tracy\Debugger;
Debugger::enable( Debugger::DEVELOPMENT /*Debugger::PRODUCTION , ROOT_PATH . 'log' */ );
//Debugger::$email = 'maci-x@azet.sk';

require_once 'core/Database.php';
require_once 'core/Template.php';
require_once 'core/Router.php';
require_once 'core/User.php';
require_once 'core/SystemMessage.php';