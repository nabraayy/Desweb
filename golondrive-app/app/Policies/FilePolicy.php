<?php

namespace App\Policies;

use App\Models\Files;
use App\Models\User;

class FilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function upload(User $user){
        return $user->id ===1;
    }
    public function delete(User $user, Files $f){
        return $user->id === $f-> user_id;
    }
}
