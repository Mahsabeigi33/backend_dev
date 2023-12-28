<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
      {
          // Example data: User 1 has Achievement 1
          DB::table('user_achievements')->insert([
              'user_id' => 1,
              'achievement_id' => 1,
              'created_at' => now(),
              'updated_at' => now(),
          ]);

          // Example data: User 2 has Achievement 2
          DB::table('user_achievements')->insert([
              'user_id' => 2,
              'achievement_id' => 2,
              'created_at' => now(),
              'updated_at' => now(),
          ]);

/*
// Assuming you have 10 users and 10 lessons for demonstration
$users = \App\Models\User::all();
$achievements = \App\Models\Achievement::all();

foreach ($users as $user) {
    foreach ($achievements as $achievement) {
        DB::table('user_achievements')->insert([
            'user_id' => $user->id,
            'achievement_id' => $achievement->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
*/
          // You can continue adding more sample data as needed.
      }
}
