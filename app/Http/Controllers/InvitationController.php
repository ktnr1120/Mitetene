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
    
    public function acceptInvitation($token)
    {
        // 招待を取得
        $invitation = Invite::where('token', $token)->first();
    
        // 招待が存在しないか、有効期限が切れている場合の処理
        if (!$invitation || $invitation->isExpired()) {
            abort(404); // または適切なエラーページへリダイレクト
        }
    
        // ゲストユーザーを作成
        $guestUser = User::create([
            'name' => request('name'),
            'email' => $invitation->email,
            'password' => Hash::make(request('password')),
        ]);
    
        // 招待テーブルの更新
        $invitation->update([
            'user_id' => $guestUser->id,
            'accepted_at' => now(),
        ]);
    
        // ログイン処理（ゲストユーザーとして）
        Auth::login($guestUser);
    
        // リダイレクト先を変更する場合は、適切なルートやURLに変更してください
        return redirect('/dashboard');
    }
}
