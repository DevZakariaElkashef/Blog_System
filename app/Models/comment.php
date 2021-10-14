<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';

    public function Post(){
        return $this->belongsTo(Post::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
