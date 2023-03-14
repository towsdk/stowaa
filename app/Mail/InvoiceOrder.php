<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_details)
    {
        $this->order = $order_details;
        
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Invoice Order',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'invoice.sendinvoice',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [

            Attachment::fromPath(public_path('storage/invoice/'). $this->order->invoice->invoice)
                ->as('invoice.pdf')
                ->withMime('application/pdf'),
            
            // Attachment::fromStorage( 'invoice/' . $this->order->invoice->invoice )->as('invoice.pdf')->withMime('application/pdf'),
        ];
    }
}
