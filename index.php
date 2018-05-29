<?php

ini_set('display_errors', 1);

use FastPHP\Core\Bootstrap;

require_once "Core/Autoloader.php";
spl_autoload_register(array('FastPHP\Core\Autoloader', 'load'));

$bootstrap = new Bootstrap();
$bootstrap->init();