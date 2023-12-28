<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        // Assuming you have 10 users and 10 lessons for demonstration
        $users = \App\Models\User::all();
        $lessons = \App\Models\Lesson::all();

        foreach ($users as $user) {
            foreach ($lessons as $lesson) {
                DB::table('lesson_user')->insert([
                    'user_id' => $user->id,
                    'lesson_id' => $lesson->id,
                    'watched' => false, // Default to not watched
                ]);
            }
        }
    }
}
