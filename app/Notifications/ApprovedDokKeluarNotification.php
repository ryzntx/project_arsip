<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApprovedDokKeluarNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($dokumen, string $status)
    {
        $this->dokumen = $dokumen;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'nama_dokumen' => $this->dokumen->nama_dokumen,
            'kategori' => $this->dokumen->dokumen_kategori->nama_kategori,
            'dinas' => $this->dokumen->instansi->nama_instansi,
            'sifat' => $this->dokumen->sifat_dokumen,
            'status' => $this->status,
            'alasan' => $this->dokumen->alasan,
        ];
    }
}
