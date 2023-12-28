<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateUsersCommentsWrittenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all users and set the default value for 'comments_written' column
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            DB::table('users')->where('id', $user->id)->update([
                'comments_written' => 0 // Set default value to 0
            ]);
        }
    }
}
