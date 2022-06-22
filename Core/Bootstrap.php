<?php

namespace FastPHP\Core;

use FastPHP\Core\Elementary\ConfigFileReader;
use FastPHP\Core\Exceptions\ControllerNotFoundException;
use FastPHP\Core\Services\RoutingService;
use FastPHP\Core\Services\DIService;

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

        try {
            $configFileReader = new ConfigFileReader('Config/Config.xml');
            $baseConfig = $configFileReader->getConfig();

            $routingService = new RoutingService();
            $aClassAction = $routingService->getClassAction();

            if(!is_null($aClassAction) || !is_null($baseConfig)) {
                if($aClassAction == -1) {
                    throw  new ControllerNotFoundException();
                }

                if(!is_null($aClassAction)) {
                    $sClass = (string)$aClassAction['route']->class;
                    $sAction = (string)$aClassAction['route']->action;
                    $aParameter = $aClassAction['parameter'];
                } else {
                    $sClass = (string)$baseConfig->startPage->class;
                    $sAction = (string)$baseConfig->startPage->action;

                    if(isset($baseConfig->startPage->parameter)) {
                        $aParameter = (array)$baseConfig->startPage->parameter;
                    } else {
                        $aParameter = [];
                    }

                }
                
                $di = new DIService();
                
                if($di->hasFunctionDI($sClass, $sAction)) {
                    $dependencies = $di->getDependencyNames($sClass, $sAction);
                    
                    foreach ($dependencies as $dependency) {
                        $aParameter[] = $di->getDependencyObject($dependency);
                    }
                }
                
                $controller = new $sClass();
                
                call_user_func_array([$controller, $sAction], $aParameter);
            } else {
                throw new ControllerNotFoundException();
            }
        } catch (ControllerNotFoundException $e) {
            echo 'The Page you are searching could not found. Apologise for this.';
        }



    }
}