<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword; //追加

//class CustomizedResetPassword extends Notification
class CustomizedResetPassword extends ResetPassword //変更
{
    use Queueable;

    public $token; //パスワードリセット用に追加

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    //public function __construct()
    public function __construct($token) //変更
    {
        $this->token = $token; //追加
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
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('パスワード再設定')->view(['custommail.reset_password_html','custommail.reset_password_text'], compact('url'));
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
