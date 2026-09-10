<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HrConsultancyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hrdata;
    public $files;

    /**
     * Create a new message instance.
     */
    public function __construct($hrdata, $files = [])
    {
        $this->hrdata = $hrdata;
        $this->files = $files;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'HR Consultancy Requirement',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.HrConsultancy',
            with: [
                'hrdata' => $this->hrdata
            ]
        );
    }

   
    public function attachments(): array
    {
        $attachments = [];

        foreach ($this->files as $file) {

            $attachments[] = Attachment::fromPath(
                $file->getRealPath()
            )->as(
                $file->getClientOriginalName()
            )->withMime(
                $file->getMimeType()
            );
        }

        return $attachments;
    }
}
