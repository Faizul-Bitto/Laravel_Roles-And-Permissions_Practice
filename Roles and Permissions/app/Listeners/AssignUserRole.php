<?php

namespace App\Listeners;

use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignUserRole implements ShouldQueue
{
    public function handle($event)
    {
        $user = $event->user;
        $user->assignRole('User');
    }
}
