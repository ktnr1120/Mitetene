<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function acceptFriendship(User $friend)
    {
        // フォロワーとして追加するロジックを実装
        // 例えば、Friendship モデルに is_accepted カラムがある場合
        auth()->user()->friendships()->where('friend_id', $friend->id)->update(['is_accepted' => true]);
    
        return redirect()->back()->with('message', '友達認証を許可しました。');
    }
}
