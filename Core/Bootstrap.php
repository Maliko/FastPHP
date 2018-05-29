<?php

namespace FastPHP\Core;

use \FastPHP\Core\Elementary\ConfigFileReader;
use FastPHP\Core\Exceptions\ControllerNotFoundException;
use FastPHP\Core\Services\RoutingService;

/**
 * Class Bootstrap
 * @package FastPHP\Core
 */
class Bootstrap
{
    /**
     * This Function initialize the Framework. Please don't modify this function.
     * When you need to implement own Code into the Bootstrapper, then implements the
     * bootstrap function in your Controller
     */
    public function init() {
        $configFileReader = new ConfigFileReader('Config/Config.xml');
        $configFileReader->getConfig();

        $routingService = new RoutingService();
        $aClassAction = $routingService->getClassAction();


        if(!is_null($aClassAction)) {
            $sClass = (string)$aClassAction->class;
            $sAction = (string)$aClassAction->action;

            $controller = new $sClass();
            $controller->$sAction();
        } else {
            throw new ControllerNotFoundException();
        }


    }
}