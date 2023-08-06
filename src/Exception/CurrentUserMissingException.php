<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class CurrentUserMissingException extends Exception
{
    public function __construct()
    {
        parent::__construct('Current user cannot be retrieved');
    }
}
