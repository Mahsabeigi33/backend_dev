<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;

class UnlockCommentAchievements
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(CommentWritten $event)
   {
       $user = $event->user;

       // Increment comments written and check for unlocked achievements
       $user->increment('comments_written');

       $writtenComments = $user->comments_written;

       if ($writtenComments == 1) {
           event(new AchievementUnlocked('First Comment Written', $user));
       } elseif ($writtenComments == 3) {
           event(new AchievementUnlocked('3 Comments Written', $user));
       } elseif ($writtenComments == 5) {
           event(new AchievementUnlocked('5 Comments Written', $user));
       } elseif ($writtenComments == 10) {
           event(new AchievementUnlocked('10 Comments Written', $user));
       } elseif ($writtenComments == 20) {
           event(new AchievementUnlocked('20 Comments Written', $user));
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
