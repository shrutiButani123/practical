<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
Use Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMail $event): void
    {
        $user = User::findOrFail($event->userId)->toArray();

        //send mail with user data
        Mail::send('mail.welcome', ['user' => $user], function($message) use ($user){
            // $message->from('info@example.com', 'Admin');
            $message->to($user['email']);
            $message->subject('Welcome Mail');
        });
    }
}
