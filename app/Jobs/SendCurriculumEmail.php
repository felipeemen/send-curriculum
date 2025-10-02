<?php

namespace App\Jobs;

use App\Mail\CurriculumMail;
use App\Models\Curriculum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCurriculumEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Curriculum $curriculum;

    public function __construct(Curriculum $curriculum)
    {
        $this->curriculum = $curriculum;
    }

    public function handle(): void
    {
        Mail::to($this->curriculum->email)
            ->send(new CurriculumMail($this->curriculum));
    }
}
