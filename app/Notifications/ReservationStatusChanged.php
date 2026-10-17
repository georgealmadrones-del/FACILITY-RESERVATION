<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationStatusChanged extends Notification
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable): array
    {
        return ['database']; // Removes the mail channel dependency for local testing
    }

    public function toMail($notifiable): MailMessage
    {
        $item = $this->reservation->facility?->name ?? $this->reservation->equipment?->name ?? 'Facility/Equipment';
        $status = ucfirst($this->reservation->status);

        $message = (new MailMessage)
                    ->subject("Reservation {$status}: {$item}")
                    ->greeting("Hello {$notifiable->name}!")
                    ->line("Your reservation request for **{$item}** has been **{$status}**.");

        if ($this->reservation->status === 'rejected' && $this->reservation->rejection_reason) {
            $message->line("Reason for rejection: " . $this->reservation->rejection_reason);
        }

        return $message->line("Thank you for using our reservation system!");
    }

    public function toArray($notifiable): array
    {
        $item = $this->reservation->facility?->name ?? $this->reservation->equipment?->name ?? 'Resource';
        $status = ucfirst($this->reservation->status);

        return [
            'reservation_id' => $this->reservation->id,
            'title' => "Booking {$status}",
            'message' => "Your request for {$item} has been " . strtolower($status) . ".",
            'status' => $this->reservation->status,
        ];
    }
}