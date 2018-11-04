<?php

namespace FastPHP\Core\BaseClasses;

use FastPHP\Core\Services\ViewService;

class Controller {

    protected $view;
    private $_module;

    public function __construct($sModule)
    {
        $this->_module = $sModule;

        $this->view = new ViewService($sModule);
    }

    /**
     * Returns the Name of the Module
     * @return string
     */
    public function getModuleName() {
        return $this->_module;
    }
}