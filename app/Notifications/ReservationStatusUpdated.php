<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class ReservationStatusUpdated extends Notification
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable): array
    {
        return ['database']; // Stores notification in DB for real-time retrieval
    }

    public function toArray($notifiable): array
    {
        $resourceName = $this->reservation->facility?->name ?? $this->reservation->equipment?->name ?? 'Resource';
        $status = ucfirst($this->reservation->status);

        return [
            'reservation_id' => $this->reservation->id,
            'title' => "Reservation {$status}",
            'message' => "Your reservation for {$resourceName} has been " . strtolower($status) . ".",
            'status' => $this->reservation->status,
        ];
    }
}