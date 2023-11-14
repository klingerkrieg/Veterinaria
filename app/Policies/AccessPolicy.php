<?php

namespace App\Policies;

use App\Models\User;

class AccessPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function veterinario(User $user) {
        return $user->tipo == User::VETERINARIO;
    }

}
