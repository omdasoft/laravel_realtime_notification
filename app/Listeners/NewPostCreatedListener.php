<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NewPostCreatedEvent;
use App\Notifications\NewPostCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPostCreatedListener
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
    public function handle(NewPostCreatedEvent $event): void
    {
        $adminUser = User::admin()->first();

        //notify the admin about the post created
        $adminUser->notify(new NewPostCreated($event->post));
    }
}
