<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming you have a User model to reference user IDs
        $users = \App\Models\User::all();

        // Create comments for each user
        foreach ($users as $user) {
            // Insert multiple comments for each user
            for ($i = 1; $i <= 5; $i++) {
                DB::table('comments')->insert([
                    'body' => "Comment {$i} by {$user->name}",
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
