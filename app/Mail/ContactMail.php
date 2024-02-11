<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cartData)
    {
        $this->content = $cartData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('******@example.com') // 送信元
        return $this->view('emails.reservation') // テンプレート
            ->from('nfam8naoto@gmail.com') // 送信元
            ->subject('ご予約完了のお知らせ') // メールタイトル
            ->with([
                'content' => $this->content,
            ]); // withオプションでセットしたデータをテンプレートへ
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
