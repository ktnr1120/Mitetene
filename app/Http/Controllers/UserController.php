<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 認証済みユーザーの友達一覧を表示
    public function friends()
    {
        // 認証済みユーザーの友達を取得
        $friends = Friendship::where('user_id', auth()->user()->id)
            ->orWhere('friend_id', auth()->user()->id)
            ->get();
            //dd($friends);

        return view('friend.friends', compact('friends'));
    }
}
