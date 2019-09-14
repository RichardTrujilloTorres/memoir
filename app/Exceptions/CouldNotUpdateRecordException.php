<?php

namespace App\Exceptions;

/**
 * Class CouldNotUpdateRecordException
 * @package App\Exceptions
 */
class CouldNotUpdateRecordException extends \Exception
{
    protected $message = 'Could not update record';

    protected $code = 500;

    public function __construct($resourceId = null)
    {
        if ($resourceId) {
            $this->message = 'Could not update record with ID ' . $resourceId;
        }

        parent::__construct($this->message, $this->code);
    }
}
