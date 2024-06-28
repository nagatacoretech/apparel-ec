<?php

namespace App\Mail;

use App\Models\OrderItems;
use App\Models\ProductDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderItems;

    /**
     * Create a new message instance.
     */
    public function __construct($orderItems)
    {
        $this->orderItems = $orderItems->toArray();
        // dd($this->orderItems);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope( subject: 'ご購入ありがとうございました！',);
    }

public function content(): Content
    {
        return new Content(
            view: 'email.customer',
            with: $this->orderItems,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
