<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';

    public function Category(){
        return $this->belongsTo(Category::class); 
    }

    public function User(){
        return $this->belongsTo(User::class); 
    }

    public function Comments(){
        return $this->hasMany(comment::class);
    }
}
