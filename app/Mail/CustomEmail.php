<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $bodyHtml;

    public function __construct(string $subjectLine, string $bodyHtml)
    {
        $this->subjectLine = $subjectLine;
        $this->bodyHtml = $bodyHtml;
    }

    public function build()
    {
        // Provide both an HTML view and a plain-text fallback.
        // The plain view receives a sanitized text version to ensure no HTML is rendered in plain mode.
        return $this->subject($this->subjectLine)
                    ->view('emails.custom')
                    ->text('emails.plain')
                    ->with([
                        'bodyHtml' => $this->bodyHtml,
                        'bodyText' => strip_tags($this->bodyHtml),
                    ]);
    }
}
