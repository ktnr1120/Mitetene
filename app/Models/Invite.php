<?php

namespace App\Models;

use App\Mail\InvitationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\InvitationNotification;
use App\Models\User;

class Invite extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $fillable =[
        'user_id',
        'email',
        'token',
        ];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function invitedUser($token)
    {
        return $this->belongsToMany(User::class, 'invites', 'invited_user_id', 'user_id')
            ->withPivot('token')
            ->wherePivot('token', $token)
            ->withTimestamps();
    }
}
