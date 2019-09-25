<?php

namespace App\Exception;

use \Exception;

/* @class exception general for ESB */
class EsbException extends Exception
{
    /* @var exception code */
    public $code = 500;

    /* @var exception message */
    public $message = "General Error";

    public function __construct($code, $message)
    {
        $this->code = $code;

        $this->message = $message;
    }
}
