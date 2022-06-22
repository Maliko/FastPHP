<?php

namespace FastPHP\Modules\Base\Service;

/**
 * Description of SampleService
 *
 * @author jdhel
 */
class SampleService {
    public function __construct() {
        
    }
    
    public function getValue() {
        return uniqid() . ' + ' . uniqid();
    }
}
