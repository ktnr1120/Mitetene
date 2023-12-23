<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'url',
        'post_id',
        'alt'
    ];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
