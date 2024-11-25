<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    public function size(){
        return Storage::size($this->path);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
