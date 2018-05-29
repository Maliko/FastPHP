<?php


namespace FastPHP\Core\Services;

use FastPHP\Core\Elementary\ConfigFileReader;

/**
 * Class RoutingService
 * @package FastPHP\Core\Services
 */
class RoutingService
{
    public function getClassAction($sRoute = '') {
        if(empty($sRoute)) {
            $sRoute = $_SERVER['PATH_INFO'];
        }

        $directory = new \DirectoryIterator('Modules');
        foreach ($directory as $file) {
            if($file->isDir() && !$file->isDot()) {
                $sPath = 'Modules/' . $file->getFilename() . '/Config/Route.xml';
                $configFileReader = new ConfigFileReader($sPath);
                $aData = $configFileReader->getConfig();

                foreach ($aData as $route) {
                    if((string)$route->route === $sRoute) {
                        return $route;
                    }
                }
            }
        }
        
        return null;

    }
}