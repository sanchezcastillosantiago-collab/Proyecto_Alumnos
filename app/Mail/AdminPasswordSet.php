<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPasswordSet extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plainPassword;

    /**
     * Create a new message instance.
     */
    public function __construct($user, string $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Credenciales de administrador')
                    ->view('emails.admin-password')
                    ->with([
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                        'password' => $this->plainPassword,
                    ]);
    }
}
