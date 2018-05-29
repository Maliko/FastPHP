<?php

ini_set('display_errors', 1);

use \FastPHP\Modules\Base\Controller\Base;

require_once "Core/Autoloader.php";
spl_autoload_register(array('FastPHP\Core\Autoloader', 'load'));

$test = new Base();
$test->test();