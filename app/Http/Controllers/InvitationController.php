<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvitationNotification;
use Illuminate\Support\Facades\Hash;
use App\Models\Invite;
use App\Models\User;

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
        
        //トークンの有効期限
        $expiration = Carbon::now()->addHours(24);
        
        //　メール送信時の保存処理
        Invite::create([
            'user_id' => auth()->id(),
            'email' => $email,
            'token' => $token,
            'expiration' => $expiration,
        ]);

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
        return view('invitation.accept', ['token' => $token, 'email' => $invite->email]);
    }

    
    public function acceptInvitation($token, Request $request)
    {
        //招待したﾕｰｻﾞｰIDと自分のIDの紐づけ
        
        //
        
        $invite = Invite::where('token', $token)->first();
        //dd($invite);
        
        //dd($invite->token);
        //dd($invite, Carbon::now(), $invite->expiration);
        if(!$invite || Carbon::now() > $invite->expiration) {
            // トークンが無効な場合または有効期限切れの場合の処理
            abort(404);
        }
    
        // 既に登録されているユーザーならばログイン
        $existingUser = User::where('email', $invite->email)->first();
    
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect('/index'); // ログイン後のリダイレクト先を適切に設定
        }
    
        // ゲストユーザーとして登録
        $guestUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // ログイン
        if (Auth::login($guestUser)) {
            // ログインが成功した場合
            \Log::info('Guest user logged in successfully.', ['user_id' => $guestUser->id]);
        } else {
            // ログインが失敗した場合
            \Log::error('Guest user login failed.', ['user_email' => $request->email]);
            abort(404);
        }
        
        // トークンを無効化
        $invite->delete();
        
        return redirect('/index');
    }
}