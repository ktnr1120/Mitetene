<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable =[
        'title',
        'body',
        'user_id',
        'Children_ID',
        'Date',
        'weather_id',
        'IsDelete'
    ];
    
    //Userに対するリレーション
    
    //[1対多]の関係なので単数形に
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function weather()
    {
        return $this->belongsTo(Weather::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function image()
    {
        return $this->hasOne(Image::class, 'post_id');
    }
    
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
        
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}

