<?php
/**
 * Created by PhpStorm.
 * User: f1r3st0rm
 * Date: 29.05.18
 * Time: 10:00
 */

namespace FastPHP\Modules\Base\Controller;

class Base
{
    public function index() {
        echo 'Ich bin ein Test';
    }

    public function tester($iId, $test) {
        echo $iId . ' : ' . $test;
    }
}