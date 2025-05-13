<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
namespace App\Mail;


class InscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $candidateName;

    public function __construct($candidateName)
    {
        $this->candidateName = $candidateName;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre inscription - FST Fès')
                    ->view('emails.inscription_confirmation')
                    ->with([
                        'candidateName' => $this->candidateName,
                    ]);
    }
}