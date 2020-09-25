<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificaSale extends Notification
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
        //  Storage::get('public/pdf/TRAMITE_VENTA-' . $id . '.pdf');
        // ->attach('/path/to/file', [
        //     'as' => 'name.pdf',
        //     'mime' => 'application/pdf',
        // ]);
        return (new MailMessage)
            ->subject('ADJUDICACIÓN DE VENTA NÚMERO: '. 
            $this->msg[0]->id.'  '.
            $this->msg[1]->nombremarca.' | '.
            $this->msg[1]->nombremodeloauto.' | '.
            $this->msg[1]->anno)
            ->line('Estimado cliente: '. $this->msg[2]->firstName .' '. $this->msg[2]->lastName .'.')
            ->line('Nos es grato informarle que has sido el ganador en de la venta: '.
            $this->msg[0]->id .' del automóvil: '. 
            $this->msg[1]->nombremarca.' | '.
            $this->msg[1]->nombremodeloauto.' | '.
            $this->msg[1]->anno .' | '.
            $this->msg[1]->nombrecolorauto.'')
            ->line('Con VIN, Número de motor y Placa: '.
            $this->msg[1]->vin.' | '.
            $this->msg[1]->numeromotor.' | '.
            $this->msg[1]->placas.' respectivamente.')
            ->line('Por un monto de: $ '. $this->msg[0]->precio .' ('.$this->msg[3].' 00/100 M.N.)')
            ->line($this->msg[7] ? 'Descuento: '. $this->msg[6]->descuento_percent .' %' : 'Esta subasta no posee descuento' )
            ->line($this->msg[7] ? 'Por un monto final de: $ '. $this->msg[5].' ('.$this->msg[4].' 00/100 M.N.)' :'Por un monto final de: $ '. $this->msg[0]->precio .' ('.$this->msg[3].' 00/100 M.N.)' )
            ->line('Venta realizada el día: '. $this->msg[0]->created_at)
            ->line('-------------------------------------------------------------------------')
            ->line('Anexo la ficha de deposito para hacer la transferencia.')
            ->line(' La fecha limite de pago es hasta 3 días hábiles de haber recibido este correo')
            ->line('                                                                                                                         ')
            ->line('En cuanto realices la transferencia enviar al correo electrónico rn2subastas@rn2.com.mx el comprobante de pago. Posteriormente recibirá indicaciones de la recepción del vehículo.')
            ->line('Anexo la ficha de deposito para hacer la transferencia.')
            ->line('Muchas gracias y felicidades.')
            ->attach(storage_path('app/public/pdf/TRAMITE_VENTA-' . $this->msg[1]->id . '.pdf'), [
                     'as' => 'TRAMITE_VENTA-' . $this->msg[1]->id . '.pdf',
                     'mime' => 'application/pdf',
                 ])
            ->attach(storage_path('app/public/pdf/TRAMITE_VENTA-' . $this->msg[1]->id . '.jpg'), [
                'as' => 'TRAMITE_VENTA-' . $this->msg[1]->id . '.jpg',
                'mime' => 'image/jpg',
            ]);
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
