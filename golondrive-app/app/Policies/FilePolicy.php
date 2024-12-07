<?php

namespace App\Policies;

use App\Models\File;
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
        return $user->all();
    }
    public function delete(User $user, File $f){
        return $user->id === $f->user_id;
    }
}
