<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));


/** Facebook JDK */
require_once 'Zend/Facebook/autoload.php';
//require_once 'Zend/Glitch/Loader/Autoloader.php';
/** Zend_Application */
require_once 'Zend/Application.php';
 require "twitteroauth/autoload.php";
// include_once "google-api-php-client/examples/templates/base.php";
//require_once ('google-api-php-client/src/Google/autoload.php');




// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();