<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementsTableSeeder extends Seeder
{
         /**
          * Run the database seeds.
          *
          * @return void
          */
         public function run()
         {
             // Define the achievements data
             $achievements = [
                 [
                     'name' => 'First Lesson Watched',
                     'type' => 'Lessons Watched',
                 ],
                 [
                     'name' => '5 Lessons Watched',
                     'type' => 'Lessons Watched',
                 ],
                 // ... add more achievements as needed
             ];


               DB::table('achievements')->insert([
                   'name' => 'First Lesson Watched',
                   'type'=> 'Lessons Watched',
                   'created_at' => now(),
                   'updated_at' => now(),
               ]);
               DB::table('achievements')->insert([
                   'name' => '5 Lessons Watched',
                   'type'=>'Lessons Watched',
                   'created_at' => now(),
                   'updated_at' => now(),
               ]);
               DB::table('achievements')->insert([
                   'name' => 'First Comment Written',
                   'type'=> 'Comments Written',
                   'created_at' => now(),
                   'updated_at' => now(),
               ]);

                DB::table('achievements')->insert([
                      'name' => '3 Comment Written',
                      'type'=> 'Comments Written',
                      'created_at' => now(),
                      'updated_at' => now(),
                  ]);


         }
}
