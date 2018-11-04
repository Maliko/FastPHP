<?php
/**
 * Created by PhpStorm.
 * User: f1r3st0rm
 * Date: 29.05.18
 * Time: 10:00
 */

namespace FastPHP\Modules\Base\Controller;

use FastPHP\Core\BaseClasses\Controller;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct('Base');
    }

    public function index() {
        $this->view->render('base/index', [
            'test' => 'Dies ist ein Test'
        ]);
    }

    public function tester($iId, $test) {
        echo $iId . ' : ' . $test;
    }
}