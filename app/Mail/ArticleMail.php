<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ArticleMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $article;

    /**
     * Create a new message instance.
     */
    public function __construct(Article $article)
    {
        $this->article=$article;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Article Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.article',  // Указание представления для email
            with: ['article' => $this->article] // Передача данных в шаблон
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

    public function build()
    {
        return $this->from(env('MAIL_USERNAME'))
        ->to("kaler654@mail.ru")
        ->with("article", $this->article)
        ->view("mail.article");
    }
}