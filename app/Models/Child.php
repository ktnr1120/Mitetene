<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Child extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
