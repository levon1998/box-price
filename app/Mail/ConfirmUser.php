<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmUser extends Mailable
{
    use Queueable, SerializesModels;

    private $verifyToken = '';
    private $userId = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userId, $verifyToken)
    {
        $this->userId      = $userId;
        $this->verifyToken = $verifyToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userID      = $this->userId;
        $verifyToken = $this->verifyToken;
        return $this->from('example@example.com')->view('emails.confirm', compact('userID', 'verifyToken'));
    }
}
