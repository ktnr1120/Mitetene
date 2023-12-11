<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Weather extends Model
{
    use HasFactory;
    
    protected $table = 'weathers';

    protected $fillable = ['name'];

    /**
     * The posts that belong to the weather.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_weather');
    }
}
