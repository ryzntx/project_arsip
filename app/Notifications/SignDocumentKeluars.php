<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WhatsApp\Component;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WhatsApp\WhatsAppChannel;
use NotificationChannels\WhatsApp\WhatsAppTemplate;

class SignDocumentKeluars extends Notification {
    use Queueable;

    //
    protected $nama_dokumen, $kategori, $instansi;

    /**
     * Create a new notification instance.
     */
    public function __construct($nama_dokumen, $kategori, $instansi) {
        $this->nama_dokumen = $nama_dokumen;
        $this->kategori = $kategori;
        $this->instansi = $instansi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return [WhatsAppChannel::class];
    }

    public function toWhatsapp($notifiable) {
        return WhatsAppTemplate::create()
            ->language('id')
            ->name('pemberitahuan')
            ->body(Component::text($notifiable->name)) // Nama tujuan notifikasi
            ->body(Component::text($this->nama_dokumen)) // Nama dokumen
            ->body(Component::text($this->kategori)) // Kategori dokumen
            ->body(Component::text($this->instansi)) // Instansi pengirim dokumen
            ->body(Component::dateTime(new \DateTimeImmutable('now', new \DateTimeZone('Asia/Jakarta'))))  // Waktu pengiriman notifikasi
            ->to(Str::replaceFirst('0', '+62', $notifiable->phone)); // Nomor tujuan notifikasi
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)->markdown('content');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            //
        ];
    }
}