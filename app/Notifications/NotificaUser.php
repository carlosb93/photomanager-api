<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificaUser extends Notification
{
    use Queueable;

    public $msg;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        //
        //$this->token = $token;
        $this->msg = $msg;

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
        //dd($notifiable);
        return (new MailMessage)
            ->line('Bienvenido a la plataforma AutosubastaRN2.')
            ->line($this->msg)
            ->action('Entrar', url('/'))
            ->line('Gracias por usar nuestra plataforma!');
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
