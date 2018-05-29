<?php
/**
 * Created by PhpStorm.
 * User: f1r3st0rm
 * Date: 29.05.18
 * Time: 23:34
 */

namespace FastPHP\Core\Exceptions;


use Throwable;

class ControllerNotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}