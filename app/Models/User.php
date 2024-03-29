<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //Post に対するリレーション
    
    //「1対多」の関係なので'posts'と複数形に
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function children()
    {
        return $this->hasMany(Child::class);
    }
    
    public function invite()
    {
        return $this->hasMany(Invite::class);
    }
    
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id','friend_id')
            ->withTimestamps();
    }
    
    public function isFriendWith(User $user)
    {
        return $this->friends()->where('friend_id', $user->id)->exists();
    }
}
