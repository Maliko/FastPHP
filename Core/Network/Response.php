<?php

namespace FastPHP\Core\Network;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Response
 *
 * @author jdhel
 */
class Response {
    private $_SessionID = "";
    
    public function __construct() {
        $this->_SessionID = uniqid();
    }
    
    public function getSessionId() {
        return $this->_SessionID;
    }
}
