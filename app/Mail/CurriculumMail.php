<?php

namespace App\Mail;

use App\Models\Curriculum;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurriculumMail extends Mailable
{
    use Queueable, SerializesModels;

    public Curriculum $curriculum;

    public function __construct(Curriculum $curriculum)
    {
        $this->curriculum = $curriculum;
    }

    public function build()
    {
        return $this->subject('Novo currículo recebido')
            ->view('emails.curriculum')
            ->with(['curriculum' => $this->curriculum])
            ->attach(storage_path('app/public/'.$this->curriculum->file_path));
    }
}
