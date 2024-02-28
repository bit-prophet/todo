<?php

namespace App\Console\Commands;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CompleteOldTasks extends Command
{
    protected $signature = 'todos:complete-old';
    protected $description = 'Mark todos created more than 2 days ago as completed';

    public function handle(): void
    {
        $twoDaysAgo = Carbon::now()->subDays(2);

        Todo::query()->where('created_at', '<=', $twoDaysAgo)
            ->update(['completed' => true]);

        $this->info('Old todos marked as completed successfully.');
    }
}
