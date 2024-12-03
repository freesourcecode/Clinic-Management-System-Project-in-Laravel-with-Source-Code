<?php 

namespace App\Exceptions;

use Exception;

class PermissionDenied extends Exception
{
    /**
     * Create a new role denied exception instance.
     *
     * @param string $role
     */
    public function __construct()
    {
        $this->message = sprintf("You don't have a required permission.");
    }
}
