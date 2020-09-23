<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserAcadeReset extends Notification
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $appName = config('app.name');
        return (new MailMessage)
            ->subject("E-mail para recuperação de login")
            ->greeting("Olá, {$notifiable->name}, seja bem vindo(a) a $appName")
            ->line("Clique no link abaixo para gerar um novo login de acesso. Insira o e-mail {$notifiable->email}, e uma senha de sua preferência")
            ->line("Essas credenciais servirão para acesso a o sistema.")
            ->action('Reset Login', route('password.reset',$this->token))
            ->salutation('Atenciosamente, #Hashtag Soluções Web');



    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
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
