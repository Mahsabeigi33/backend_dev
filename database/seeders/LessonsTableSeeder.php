<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Create multiple lessons
     for ($i = 1; $i <= 9; $i++) {
         DB::table('lessons')->insert([
             'title' => "Lesson Title {$i}",
             'created_at' => now(),
             'updated_at' => now(),
         ]);
     }
    }
}
