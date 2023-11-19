<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSuccess extends Notification
{
    use Queueable;

    private mixed $name;
    private mixed $info;
    private mixed $url;

    public function __construct($name, $info, $url)
    {
        $this->name = $name;
        $this->info = $info;
        $this->url  = $url;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Success !')
            ->markdown('mail.order', [
                'name'     => $this->name,
                'info'     => $this->info,
                'url'      => $this->url,
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
