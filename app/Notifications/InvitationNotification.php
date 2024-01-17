<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class InvitationNotification extends Notification
{
    use Queueable;
    
    protected $token;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        Log::info('Mail will be sent to: ' . $this->email);
        
        $expiration = Carbon::now()->addHours(24);
        $url = url('/accept-invitation/' . $this->token);

        return (new MailMessage)
            ->subject('[みててね]　ゲスト招待')
            ->view('emails.invitation', ['token' => $this->token, 'url' => $url, 'expiration' => $expiration]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_id' => auth()->id(), // 招待したユーザーのID
            'email' => $this->email,
            'token' => $this->token,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}