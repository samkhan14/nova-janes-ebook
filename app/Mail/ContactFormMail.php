<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, first_name: string, last_name: string, email: string, message: string}  $data
     */
    public function __construct(public array $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [
                new Address($this->data['email'], trim($this->data['first_name'].' '.$this->data['last_name'])),
            ],
            subject: 'New contact form message from '.$this->data['name'],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-form',
            with: [
                'name' => $this->data['name'],
                'firstName' => $this->data['first_name'],
                'lastName' => $this->data['last_name'],
                'email' => $this->data['email'],
                'contactMessage' => $this->data['message'],
            ],
        );
    }
}
