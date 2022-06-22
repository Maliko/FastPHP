<?php

namespace FastPHP\Core;

/**
 * Class Autoloader
 * @package FastPHP\Core
 */
class Autoloader
{
    /**
     * The Autoloader of the Framework. Don't change anything in this Function.
     * @param $class
     * @return bool
     */
    public static function load($class)
    {
        $part = explode('\\', $class);

        if($part[0] === 'FastPHP') {
            unset($part[0]);
        }

        $path = implode(DIRECTORY_SEPARATOR, $part) . '.php';

        if (file_exists($path)) {
            require_once $path;
        } else {
            return false;
        }
    }
    
     /**
     * The Autoloader of the Framework (CLI-Version). Don't change anything in this Function.
     * @param $class
     * @return bool
     */
    public static function loadCLI($class)
    {
        $part = explode('\\', $class);

        if($part[0] === 'FastPHP') {
            $part[0] = '..';
        }

        $path = implode(DIRECTORY_SEPARATOR, $part) . '.php';

        if (file_exists($path)) {
            require_once $path;
        } else {
            return false;
        }
    }
}