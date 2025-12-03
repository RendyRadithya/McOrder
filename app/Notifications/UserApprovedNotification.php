<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApprovedNotification extends Notification
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
            ->subject('🎉 Akun Anda Telah Disetujui - McOrder')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Selamat! Akun Anda di sistem McOrder telah disetujui oleh administrator.')
            ->line('Anda sekarang dapat login dan menggunakan semua fitur yang tersedia.')
            ->line('')
            ->line('**Detail Akun:**')
            ->line('Email: ' . $notifiable->email)
            ->line('Role: ' . ucfirst(str_replace('_', ' ', $notifiable->role)))
            ->action('Login Sekarang', url('/login'))
            ->line('Terima kasih telah bergabung dengan McOrder!')
            ->line('')
            ->line('Jika Anda memiliki pertanyaan, silakan hubungi administrator.')
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

