<?php

namespace App\Mail;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddNoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $created;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Note $created)
    {
        $this->created = $created;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Создание заметки')
            ->view('emails.add_note');
    }
}
