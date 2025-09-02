<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\RFQ;
use App\Models\Supplier;

class RFQMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rfq;
    public $supplier;

    /**
     * Create a new message instance.
     */
    public function __construct(RFQ $rfq, Supplier $supplier)
    {
        $this->rfq = $rfq;
        $this->supplier = $supplier;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request for Quotation: ' . $this->rfq->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rfq',
            with: [
                'rfq' => $this->rfq,
                'supplier' => $this->supplier,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        // Attach RFQ files if they exist
        if ($this->rfq->attachments) {
            foreach ($this->rfq->attachments as $attachment) {
                $filePath = storage_path('app/public/' . $attachment['path']);
                if (file_exists($filePath)) {
                    $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath($filePath)
                        ->as($attachment['original_name']);
                }
            }
        }

        return $attachments;
    }
}
