<?php 
namespace furkankadioglu\eFatura\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $responseData;

    public function __construct($message = null, $code = 0, Exception $previous = null, $responseData = [])
    {
        $this->responseData = $responseData;

        parent::__construct($message, $code, $previous);
    }

    public function getResponseData()
    {
        return $this->responseData;
    }
}