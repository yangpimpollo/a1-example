<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'image_path', 'description'])]
class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'user_id',
        'image_path',
        'description',
    ];

    // relación one to many / de uno a muchos
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // relación one to many / de uno a muchos
    public function likes(){
        return $this->hasMany(Like::class);
    }

    // relación many to one / de muchos a uno
    public function user(){
        return $this->belongsTo(User::class, 'user_id');   
    }


}