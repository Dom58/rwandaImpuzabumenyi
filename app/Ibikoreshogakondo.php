<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ibikoreshogakondo extends Model
{
    protected $fillable=['image','name','description','slug','user_id'];
    
    public function user()
    {
         return $this ->belongsTo(User::class, 'user_id');
    }
}
