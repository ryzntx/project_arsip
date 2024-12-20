<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\WhatsApp\WhatsAppChannel;
use NotificationChannels\WhatsApp\WhatsAppTextMessage;

class SignDocumentKeluars extends Notification {
    use Queueable;

    protected $telegram_user_id;
    protected string $whatsapp_number;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $whatsapp_number) {
        //
        // $this->telegram_user_id = $telegram_user_id;
        $this->whatsapp_number = $whatsapp_number;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        // return ['telegram'];
        return [WhatsAppChannel::class];
    }

    public function toTelegram($notifiable) {
        // dd($notifiable);
        // $url = url('/invoice/' . $notifiable->invoice->id);

        return TelegramMessage::create()
        // Optional recipient user id.
            ->to($this->telegram_user_id)

        // Markdown supported.
            ->line("Hello there!")
            ->line("Anda memiliki dokumen yang perlu anda tanda tangani.")
        // ->lineIf($notifiable->amount > 0, "Amount paid: {$notifiable->amount}")
            ->line("Thank you!")

        // (Optional) Blade template for the content.
        // ->view('notification', ['url' => $url])

        // (Optional) Inline Buttons
            ->button('View Invoice', 'https://example.com/invoice.pdf')
            ->button('Download Invoice', 'https://example.com/invoice.pdf');

        // (Optional) Conditional notification.
        // Only send if amount is greater than 0. Otherwise, don't send.
        // ->sendWhen($notifiable->amount > 0)

        // (Optional) Inline Button with Web App
        // ->buttonWithWebApp('Open Web App', $url)

        // (Optional) Inline Button with callback. You can handle callback in your bot instance
        // ->buttonWithCallback('Confirm', 'confirm_invoice ' . $this->invoice->id)
    }

    public function toWhatsapp($notifiable) {
        return WhatsAppTextMessage::create()
            ->message('Anda memiliki dokumen yang perlu anda tanda tangani.')

            ->to($this->whatsapp_number);
        // ->to('+6285156938759');
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
