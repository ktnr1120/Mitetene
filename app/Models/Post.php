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
        'weather_id'
    ];
    
    //Userに対するリレーション
    
    //[1対多]の関係なので単数形に
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function weather()
    {
        return $this->belongsTo(Weather::class);
    }
        
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}

