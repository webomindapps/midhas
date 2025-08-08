<?php

namespace App\Mail;

use App\Models\TellaFriend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendProducttoFriend extends Mailable
{
    use Queueable, SerializesModels;
    public $tella_friend;
    /**
     * Create a new message instance.
     */
    public function __construct(TellaFriend $tella_friend)
    {
        $this->tella_friend = $tella_friend;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your friend ' . $this->tella_friend->name . ' has sent you a product from Midhas'
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.send-productmail',
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
