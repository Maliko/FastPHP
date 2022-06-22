<?php
/**
 * Created by PhpStorm.
 * User: f1r3st0rm
 * Date: 29.05.18
 * Time: 10:00
 */

namespace FastPHP\Modules\Base\Controller;

use FastPHP\Core\BaseClasses\Controller;
use FastPHP\Core\Network\Request;
use FastPHP\Modules\Base\Service\SampleService;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct('Base');
    }

    public function index(SampleService $service) {        
        $this->view->render('base/index', [
            'test' => $service->getValue()
        ]);
    }

    public function tester(SampleService $service, $iId, $test) {
        echo $iId . ' : ' . $test;
        echo "<br>";
        echo $service->getValue();
    }
}