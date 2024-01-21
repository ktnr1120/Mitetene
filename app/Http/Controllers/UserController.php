<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 認証済みユーザー一覧を表示
    public function authenticatedUsers()
    {
        // 認証済みユーザーが持つトークンを取得
        $authenticatedUsers = Auth::user()->invites;

        return view('authenticated-users.authenticate', compact('authenticatedUsers'));
    }
}
