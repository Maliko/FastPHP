<?php
/**
 * Created by PhpStorm.
 * User: f1r3st0rm
 * Date: 21.08.18
 * Time: 23:09
 */

namespace FastPHP\Core\Services;

use FastPHP\Core\Elementary\ConfigFileReader;

class TranslationService
{
    private $_translationRules;

    /**
     * TranslationService constructor.
     */
    public function __construct()
    {
        $this->_translationRules = null;
    }

    public function translate($template) {

    }
}