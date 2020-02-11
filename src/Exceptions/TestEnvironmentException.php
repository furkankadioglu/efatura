<?php 
namespace furkankadioglu\eFatura\Exceptions;

use Exception;

class TestEnvironmentException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}