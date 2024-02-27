<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Todo;

class TodoPolicy
{
    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function update(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function create(User $user)
    {
        // Allow users to create todos
        return true;
    }

    public function delete(User $user, Todo $todo)
    {
        // Only allow users to delete their own todos
        return $user->id === $todo->user_id;
    }
}
