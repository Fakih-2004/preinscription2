<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $candidatName;
    public $candidatEmail;

    public function __construct($candidatName, $candidatEmail)
    {
        $this->candidatName = $candidatName;
        $this->candidatEmail = $candidatEmail;
    }

    public function build()
    {
        return $this->view('mails.inscription_confirmation')
            ->subject('Confirmation d’inscription - FST USMBA')
            ->with([
                'candidatName' => $this->candidatName,
            ]);
    }
}