<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserAcade extends Notification
{
  //  use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $token;


    public function __construct($token)
    {
        $this->token = $token;
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
        $appName = config('app.name');
        return (new MailMessage)
                    ->subject("Sua conta na $appName foi gerada")
                    ->greeting("Olá, {$notifiable->name}, seja bem vindo(a) a $appName")
                    ->line("Clique no link abaixo para gerar um login de acesso. Insira o e-mail {$notifiable->email}, e uma senha de sua preferência")
                    ->action('Gerar Login', route('password.reset',$this->token))
                    ->salutation('Atenciosamente, HashTag Soluções Web');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /*
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    */
}
