<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
  use Queueable, SerializesModels;

  public $url;

  /**
   * Create a new message instance.
   */
  public function __construct(string $url)
  {
    $this->url = $url;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      from: new Address('atividades@proandre.com.br'),
      subject: $this->url,
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(view: 'mails.resetPassword');
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