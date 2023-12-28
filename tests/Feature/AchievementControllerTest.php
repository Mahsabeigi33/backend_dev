<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Comment;


class AchievementControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
      //  $response = $this->get('/');

        //$response->assertStatus(200);
    }


    public function test_first_lesson_watched_achievement()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->actingAs($user)->post("/lessons/{$lesson->id}/watch");

        $response->assertStatus(200);

        // Assert that the 'First Lesson Watched' achievement is unlocked for the user
        $this->assertContains('First Lesson Watched', $user->achievements->pluck('name')->toArray());
    }

    public function test_5_lessons_watched_achievement()
    {
        $user = User::factory()->create();
        Lesson::factory(5)->create();

        // Watch 5 lessons
        foreach (Lesson::all() as $lesson) {
            $this->actingAs($user)->post("/lessons/{$lesson->id}/watch");
        }

        // Assert that the '5 Lessons Watched' achievement is unlocked for the user
        $this->assertContains('5 Lessons Watched', $user->achievements->pluck('name')->toArray());
    }

    public function test_first_comment_written_achievement()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)->post("/comments/{$comment->id}/write");
        if ($response) {
          $response->assertStatus(200);
          // Assert that the 'First Comment Written' achievement is unlocked for the user
          $this->assertContains('First Comment Written', $user->achievements->pluck('name')->toArray());
        } else {
              $this->fail('Response not received');
          }

    }

    public function test_achievements_endpoint()
    {
        $user = User::factory()->create();
        // ... Watch lessons, write comments to unlock achievements ...

        $response = $this->actingAs($user)->get("/users/{$user->id}/achievements");

        $response->assertStatus(200)
        ->assertJson([
                'unlocked_achievements' => [],//$user->achievements->pluck('name')->toArray(), // Actual unlocked achievements array
                'next_available_achievements' => [],
                'current_badge' => 'Beginner', // Assuming default badge is 'Beginner' when no achievements are unlocked
                'next_badge' => 'Intermediate', // If the user unlocks 4 achievements, the next badge would be 'Intermediate'
                'remaining_to_unlock_next_badge' => 4 - $user->achievements->count() // Remaining count to unlock next badge
            ]);
    }





}
