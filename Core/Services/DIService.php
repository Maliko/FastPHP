<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FastPHP\Core\Services;

use FastPHP\Core\Elementary\ConfigFileReader;
use FastPHP\Core\Exceptions\ServiceNotFoundException;

class DIService {
    private $_dependencies;
    
    public function __construct() {
        $this->getDependencyConfigs();
    }
    public function hasFunctionDI($className, $function) {
        $functions = \get_class_methods($className);
        
        foreach ($functions as $func) {
            if($func === $function) {
                return $this->needsFunctionDI($className, $function);
            }
        }
    }
    
    public function getDependencyObject($className) {
        if($this->needsFunctionDI($className, '__construct')) {
            $diNames = $this->getDependencyNames($className, '__construct');
            $params = [];

            foreach ($diNames as $diName) {
                $params[] = $this->getDependencyObject($diName);
            }
            
            $class = new \ReflectionClass($className);
            return $class->newInstanceArgs($params);
        } else {
            return new $className;
        }
    }
    
    public function getDependencyNames($className, $functionName) : array {
        $class = new \ReflectionClass($className);
        $function = $class->getMethod($functionName);
        
        $parameters = $function->getParameters();
        $result = [];
        
        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            
            foreach ($this->_dependencies as $dependencyConfig) {
                foreach ($dependencyConfig as $dependency) {
                    if($type->getName() == $dependency->namespace) {
                        $result[] = (string)$dependency->namespace;
                    }
                }
            }
        }
        
        return $result;       
    }
    
    private function needsFunctionDI($className, $function) {
        $class = new \ReflectionClass($className);
        $func = $class->getMethod($function);
        $args = $func->getParameters();
        
        foreach ($args as $arg) {
            $type = $arg->getType();
            
            foreach ($this->_dependencies as $dependencyConfig) {
                foreach ($dependencyConfig as $dependency) {
                    if($type->getName() == $dependency->namespace) {
                        return true;
                    }
                }
            }
        }
        
        if(count($args) === 0) {
            return false;
        } else {
            throw new ServiceNotFoundException("The called Function uses a Service that's not declared. Please check your Service-Config-Files.");
        }
        
    }
    
    private function getDependencyConfigs() {
        $configFileReader = new ConfigFileReader('Config/Service.xml');
        $this->_dependencies[] = $configFileReader->getConfig();
        
        $directory = new \DirectoryIterator('Modules');
        foreach ($directory as $file) {
            if($file->isDir() && !$file->isDot()) {
                $sPath = 'Modules/' . $file->getFilename() . '/Config/Service.xml';
                $configFileReader2 = new ConfigFileReader($sPath);
                $this->_dependencies[] = $configFileReader2->getConfig();
            }
        }
    }
}
