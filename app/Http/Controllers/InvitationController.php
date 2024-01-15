<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvitationNotification;
use Illuminate\Support\Facades\Hash;
use App\Models\Invite;

class InvitationController extends Controller
{
    public function showForm()
    {
        return view('invitation.form');
    }

    public function sendInvitation(Request $request)
    {
        // バリデーションのルール
        $rules = [
            'email' => 'required|email|unique:invites,email',
        ];

        // バリデーション実行
        $request->validate($rules);

        // トークン生成
        $token = Str::random(32);

        // メール送信処理
        $email = $request->input('email');

        Notification::route('mail', $email)
            ->notify(new InvitationNotification($token, $email));

        // 送信が成功したら成功メッセージを表示
        return view('invitation.invited')->with('success', '招待メールが送信されました');
    }
    
    public function showAcceptForm($token)
    {
        // トークンが有効かどうか確認
        $invite = Invite::where('token', $token)->first();
    
        if (!$invite) {
            // トークンが無効な場合の処理
            abort(404);
        }
    
        // トークンが有効な場合、ゲストユーザー登録のフォームを表示
        return view('invitation.accept', ['token' => $token]);
    }

    
    public function acceptInvitation($token)
    {
        $invite = Invite::where('token', $token)->first();
    
        if (!$invite) {
            // トークンが無効な場合の処理
            abort(404);
        }
    
        // 既に登録されているユーザーならばログイン
        $user = User::where('email', $invite->email)->first();
    
        if ($user) {
            Auth::login($user);
            return redirect('/dashboard'); // ログイン後のリダイレクト先を適切に設定
        }
    
        // ゲストユーザーとして登録
        $guestUser = User::create([
            'name' => $invite->name,
            'email' => $invite->email,
            'password' => Hash::make($invite->password),
        ]);
    
        // ログイン
        Auth::login($guestUser);
    
        // トークンを無効化
        $invite->delete();
    
        return redirect('/dashboard'); // ログイン後のリダイレクト先を適切に設定
    }
}
