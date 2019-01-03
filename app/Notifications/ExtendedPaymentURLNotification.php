<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\InvoiceItem;
use App\User;

class ExtendedPaymentURLNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invoice_item;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(InvoiceItem $invoice_item)
    {
        $this->invoice_item = $invoice_item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(config('app.name') . ': Extended Warranty Approved')
                    ->greeting('Hello ' . $notifiable->renderFullname() . ',')
                    ->line('We gladly to know that your extended warranty is approved by AHAM. To have a extended warranty please complete the transaction.')
                    ->action('Proceed to Payment', route('checkout', $this->invoice_item->id));
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
            $this->invoice_item->id,
        ];
    }
}
