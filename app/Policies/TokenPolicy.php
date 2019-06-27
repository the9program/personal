<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TokenPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->category->category === 'admin';
    }

    public function token(User $user)
    {
        return $user->category->category === 'moderator';
    }
}
