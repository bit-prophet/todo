<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userID = User::query()->first()->value('id');

        Todo::query()->create([
            'user_id' => $userID,
            'title' => 'Finish homework',
            'completed' => false,
        ]);

        Todo::query()->create([
            'user_id' => $userID,
            'title' => 'Go to the gym',
            'completed' => false,
        ]);

        Todo::query()->create([
            'user_id' => $userID,
            'title' => 'Buy groceries',
            'completed' => true,
        ]);
    }
}
