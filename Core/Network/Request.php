<?php

namespace FastPHP\Core\Network;

use FastPHP\Core\Network\Response;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author jdhel
 */
class Request {
    private $_SessionID = "";
    
    public function __construct() {
        $this->_SessionID = uniqid();
    }
    
    public function is_authenticated() {
        return true;
    }
    
    public function getSessionId() {
        return $this->_SessionID;
    }
}
