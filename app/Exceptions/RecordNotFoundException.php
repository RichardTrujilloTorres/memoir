<?php

namespace App\Exceptions;

use Throwable;

/**
 * Class RecordNotFound
 * @package App\Exceptions
 */
class RecordNotFoundException extends \Exception
{
    protected $message = 'Record not found';

    protected $code = 404;

    public function __construct($resourceId = null)
    {
        if ($resourceId) {
            $this->message = 'Record with ID ' . $resourceId . ' not found';
        }

        parent::__construct($this->message, $this->code);
    }
}
