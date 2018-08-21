<?php


namespace FastPHP\Core\Services;

use FastPHP\Core\Elementary\ConfigFileReader;

/**
 * Class RoutingService
 * @package FastPHP\Core\Services
 */
class RoutingService
{
    /**
     * Returns the ClassAction
     * @param string $sRoute
     * @return array|null|int
     */
    public function getClassAction($sRoute = '') {
        if(empty($sRoute)) {
            if(array_key_exists('PATH_INFO', $_SERVER)) {
                $sRoute = $_SERVER['PATH_INFO'];
            } else {
                $sRoute = '';
            }

        }

        $directory = new \DirectoryIterator('Modules');
        foreach ($directory as $file) {
            if($file->isDir() && !$file->isDot()) {
                $sPath = 'Modules/' . $file->getFilename() . '/Config/Route.xml';
                $configFileReader = new ConfigFileReader($sPath);
                $aData = $configFileReader->getConfig();

                foreach ($aData as $route) {
                    $aRouteTemp = $this->buildFinalRoute($sRoute, $route->route);
                    if($aRouteTemp['route'] === $sRoute) {
                        return [
                            'route'     => $route,
                            'parameter' => $aRouteTemp['parameter']
                        ];
                    }
                }
            }
        }

        if(empty($sRoute)) {
            return null;
        } else {
            return -1;
        }


    }

    private function buildFinalRoute($sUrlRoute, $configRoute) {
        $aConfigRoute = explode('/', (string)$configRoute);
        $aUrlRoute = explode('/', $sUrlRoute);
        $aParameter = [];

        if(count($aConfigRoute) === count($aUrlRoute)) {
            for ($i = 0; $i < count($aUrlRoute); $i++) {
                if(substr($aConfigRoute[$i], 0, 1) == '{' && substr($aConfigRoute[$i], strlen($aConfigRoute[$i]) - 1, 1) == '}') {
                    $aParameter[] = $aUrlRoute[$i];
                    $aConfigRoute[$i] = $aUrlRoute[$i];
                }
            }
        }

        return [
            'route'     => implode('/', $aConfigRoute),
            'parameter' => $aParameter
        ];

    }
}