<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\AddNoteMail;
use App\Events\AddNoteEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddNoteListener
{
    private $user;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AddNoteEvent  $event
     * @return void
     */
    public function handle(AddNoteEvent $event)
    {
        foreach ($this->user->isAdminList() as $admin) {
            Mail::to($admin->email)->send(new AddNoteMail($event->created));
        }
    }
}
