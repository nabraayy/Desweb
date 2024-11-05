<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class Fichero extends Model
{
    public function size(){
        return Storage::size($this->path);
    }
     public function user(){
        return $this->belongsTo(User::class);
     }
}
