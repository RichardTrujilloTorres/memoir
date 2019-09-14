<?php

namespace App\Exceptions;

/**
 * Class CouldNotCreateRecordException
 * @package App\Exceptions
 */
class CouldNotCreateRecordException extends \Exception
{
    protected $message = 'Could not create record';

    protected $code = 500;
}
