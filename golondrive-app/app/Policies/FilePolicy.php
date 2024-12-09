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
    public function upload(User $user){
        return $user->all();
    }
    public function delete(User $user, File $f){
        return $user->id === $f->user_id;
    }
    public function view(User $user, File $file)
    {
        // Permitir ver si el usuario es el propietario o si está en la lista de compartición
        return $file->user_id === $user->id || $file->sharedWith()->contains($user->id);
    }
  
    protected $policies = [
        \App\Models\File::class => \App\Policies\FilePolicy::class,
    ];
    

}
