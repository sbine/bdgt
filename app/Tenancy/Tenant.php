<?php

namespace App\Tenancy;

use App\Models\User;

class Tenant
{
    const COLUMN = 'user_id';

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Retrieve the current tenant's identifier.
     */
    public function id()
    {
        return $this->user->getAttribute('id');
    }
}
