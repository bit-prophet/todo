<?php

namespace App\Observers;

use App\Events\TodoCompletedToggled;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class TodoObserver
{
    public function updated(Todo $todo): void
    {
        // Broadcast event to notify the current user about the status change
        broadcast(new TodoCompletedToggled(Auth::id(), $todo->id, $todo->completed))->toOthers();

    }
}
