<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRejectedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pemberitahuan Pendaftaran Akun - McOrder')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Terima kasih atas minat Anda untuk bergabung dengan sistem McOrder.')
            ->line('Setelah melakukan peninjauan, kami mohon maaf untuk memberitahukan bahwa pendaftaran akun Anda tidak dapat disetujui pada saat ini.')
            ->line('')
            ->line('**Informasi Pendaftaran:**')
            ->line('Email: ' . $notifiable->email)
            ->line('Role yang diminta: ' . ucfirst(str_replace('_', ' ', $notifiable->role)))
            ->line('')
            ->line('Jika Anda merasa ini adalah kesalahan atau ingin mendiskusikan lebih lanjut, silakan hubungi administrator kami di mcorder@mcd-citragarden.com')
            ->line('')
            ->line('Terima kasih atas pengertian Anda.')
            ->salutation('Salam, Tim McOrder');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

