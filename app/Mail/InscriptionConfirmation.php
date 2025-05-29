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
    public $personalInfo;
    public $diplomas;
    public $stages;
    public $experiences;
    public $attestations;
    public $pdfPath;

    public function __construct($candidatName, $candidatEmail, $personalInfo, $diplomas, $stages, $experiences, $attestations, $pdfPath = null)
    {
        $this->candidatName = $candidatName;
        $this->candidatEmail = $candidatEmail;
        $this->personalInfo = $personalInfo;
        $this->diplomas = $diplomas;
        $this->stages = $stages;
        $this->experiences = $experiences;
        $this->attestations = $attestations;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        $email = $this->subject('Confirmation d’inscription - FST USMBA')
                     ->view('mails.inscription_confirmation')
                     ->with([
                         'candidatName' => $this->candidatName,
                         'personalInfo' => $this->personalInfo,
                         'diplomas' => $this->diplomas,
                         'stages' => $this->stages,
                         'experiences' => $this->experiences,
                         'attestations' => $this->attestations,
                     ]);

        if ($this->pdfPath && file_exists($this->pdfPath)) {
            $email->attach($this->pdfPath, [
                'as' => 'confirmation_inscription.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}
?>