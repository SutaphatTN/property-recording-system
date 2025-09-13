<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\asset_maintenance;

class RequestMaintenanceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $maintenance;

    /**
     * Create a new message instance.
     */
    public function __construct(asset_maintenance $maintenance)
    {
        $this->maintenance = $maintenance;
    }

    public function build()
    {
        return $this->subject('แจ้งการซ่อมใหม่')
                    ->markdown('emails.request');
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Request Maintenance Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'emails.maintenance.new',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
