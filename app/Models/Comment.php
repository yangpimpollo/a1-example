<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    // relación many to one / de muchos a uno
    public function image(){
        return $this->belongsTo(Image::class, 'image_id');   
    }

    // relación many to one / de muchos a uno
    public function user(){
        return $this->belongsTo(User::class, 'user_id');   
    }
}