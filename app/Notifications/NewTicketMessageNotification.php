<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Notifications\Channels\Dashboard\DashboardChannel;
use App\Notifications\Channels\Dashboard\DashboardMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewTicketMessageNotification extends Notification
{
    public Ticket $ticket;
    public TicketMessage $ticketMessage;
    public function __construct(Ticket $ticket,TicketMessage $ticketMessage)
    {
        $this->ticket = $ticket;
        $this->ticketMessage = $ticketMessage;
    }

    public function via($notifiable): array
    {
        return ['mail',DashboardChannel::class];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Destek bildiriminiz cevaplandı.')
            ->line("\"{$this->ticket->subject}\" konulu bildiriminize yeni mesaj gönderildi.")
            ->action('Bildirimi Görüntüle', url()->route('ticket.show',$this->ticket))
            ->line("Mesaj içeriği: \"{$this->ticketMessage->body}\"");
    }

    public function toDashboard($notifiable)
    {
        return (new DashboardMessage)
            ->title('Destek bildiriminiz cevaplandı.')
            ->message("<strong>\"{$this->ticket->subject}\"</strong> konulu bildiriminize yeni mesaj gönderildi.")
            ->action(url()->route('ticket.show',$this->ticket));
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
