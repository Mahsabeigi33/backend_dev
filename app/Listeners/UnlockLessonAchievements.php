<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LessonWatched;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;

class UnlockLessonAchievements
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(LessonWatched $event)
   {
       $user = $event->user;

       // Increment watched lessons and check for unlocked achievements
       //$user->increment('watched');

       $watched = $user->watched->count();

       if ($watched == 1) {
           event(new AchievementUnlocked('First Lesson Watched', $user));
       } elseif ($watched == 5) {
           event(new AchievementUnlocked('5 Lessons Watched', $user));
       } elseif ($watched == 10) {
           event(new AchievementUnlocked('10 Lessons Watched', $user));
       } elseif ($watched == 25) {
           event(new AchievementUnlocked('25 Lessons Watched', $user));
       } elseif ($watched == 50) {
           event(new AchievementUnlocked('50 Lessons Watched', $user));
       }

       // Check for unlocked badges
       $achievements = $user->achievements()->count();

       if ($achievements == 4) {
           event(new BadgeUnlocked('Intermediate', $user));
       } elseif ($achievements == 8) {
           event(new BadgeUnlocked('Advanced', $user));
       } elseif ($achievements == 10) {
           event(new BadgeUnlocked('Master', $user));
       }
   }
}
