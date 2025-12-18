<?php

namespace App\Policies;

use App\Models\User;

class FollowsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function DejarDeSeguir(User $AuthUser, User $UserPerfil): bool
    {
        
        return $AuthUser->id === $UserPerfil->id;
    }
}
