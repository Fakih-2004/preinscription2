<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // Add this import


class InscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $candidatName;

    public function __construct($candidatName)
    {
        $this->candidatName = $candidatName;
    }

    public function build()
    {
        Log::info('Construction de l\'email de confirmation:', ['candidatName' => $this->candidatName]);
        return $this->subject('Confirmation d\'inscription')
                    ->view('mails.inscription_confirmation')
                    ->with(['candidatName' => $this->candidatName]);
    }
}