<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(3)->create();

        $users = User::inRandomOrder()->get();

        foreach ($users as $user) {
            Link::factory()->count(50)->create(['user_id' => $user->id]);
        }
    }
}
