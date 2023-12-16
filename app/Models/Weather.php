<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'code'];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
