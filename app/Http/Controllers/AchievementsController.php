<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
     {
         $unlockedAchievements = $user->achievements->pluck('name')->toArray();

         // Determine the next available achievements for each group
         $nextAvailableAchievements = $this->getNextAvailableAchievements($user);

         // Determine the current badge, next badge, and remaining achievements to unlock next badge
         $currentBadge = $this->getCurrentBadge($user);
         $nextBadge = $this->getNextBadge($user);
         $remainingToUnlockNextBadge = $this->getRemainingAchievementsForNextBadge($user);

         return response()->json([
             'unlocked_achievements' => $unlockedAchievements,
             'next_available_achievements' => $nextAvailableAchievements,
             'current_badge' => $currentBadge,
             'next_badge' => $nextBadge,
             'remaining_to_unlock_next_badge' => $remainingToUnlockNextBadge,
         ]);
     }

     private function getNextAvailableAchievements(User $user)
     {
          $unlockedAchievements = $user->achievements->pluck('name')->toArray();
          $lessonsWatched = $user->watched->count();
          $commentsWritten = $user->comments->count();
          $nextAvailable = [];

          if (!in_array('First Lesson Watched', $unlockedAchievements) && $lessonsWatched >= 1) {
             $nextAvailable[] = 'First Lesson Watched';
          }

          if (!in_array('5 Lessons Watched', $unlockedAchievements) && $lessonsWatched >= 5) {
             $nextAvailable[] = '5 Lessons Watched';
          }

          if (!in_array('10 Lessons Watched', $unlockedAchievements) && $lessonsWatched >= 10) {
             $nextAvailable[] = '10 Lessons Watched';
          }

          if (!in_array('3 Comments Written', $unlockedAchievements) && $commentsWritten >= 3) {
             $nextAvailable[] = '3 Comments Written';
          }
          return $nextAvailable;

     }

     private function getCurrentBadge(User $user)
     {
        $achievementsCount = $user->achievements->count();

         if ($achievementsCount >= 10) {
             return 'Master';
         } elseif ($achievementsCount >= 8) {
             return 'Advanced';
         } elseif ($achievementsCount >= 4) {
             return 'Intermediate';
         } else {
             return 'Beginner';
         }
     }

     private function getNextBadge(User $user)
     {
        $achievementsCount = $user->achievements->count();

        if ($achievementsCount >= 10) {
            return null; // No next badge after Master
        } elseif ($achievementsCount >= 8) {
            return 'Master';
        } elseif ($achievementsCount >= 4) {
            return 'Advanced';
        } else {
            return 'Intermediate';
        }
     }

     private function getRemainingAchievementsForNextBadge(User $user)
     {
       $currentBadge = $this->getCurrentBadge($user);
        if ($currentBadge == 'Master') {
            return 0; // No more achievements needed for Master
        }
        $nextBadgeAchievements = [
            'Intermediate' => 4,
            'Advanced' => 8,
            'Master' => 10
        ];
        $achievementsCount = $user->achievements->count();
        return 2;
      //  return $nextBadgeAchievements[$currentBadge] - $achievementsCount;
     }
}
