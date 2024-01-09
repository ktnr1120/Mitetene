<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;

class InvitationController extends Controller
{
    public function showForm()
    {
        return view('invitation.form');
    }
    
    public function sendInvitation(Request $request)
    {
        //　バリデーションのルール
        $rules = [
            'email' => 'required|email|unique:invitations,email',
        ];
            
        //　バリデーション実行
        $request->validate($rules);
        
        //　メール送信処理
        $email = $request->input('email');
        Mail::to($email)->send(new InvitationMail());
        
        //　送信が成功したら成功メッセージを表示
        return redirect('/invite')->with('success', 'Invitation sent successfully');
    }
}
