<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\User;

class LessonController extends Controller
{
  /**
 * Watch a lesson.
 *
 * @param  Lesson  $lesson
 * @return \Illuminate\Http\Response
 */
public function watch(Lesson $lesson)
  {

    $lesson=Lesson::where('id',1)->first();
      // Ensure the lesson exists
      if (!$lesson) {
          return response()->json(['message' => 'Lesson not found.'], 404);
      }

      // Assuming you're using Laravel's authentication
      //$user = auth()->user();
      $user=User::where('id',1)->first();
return $user->achievements->pluck('name')->toArray();
      // Check if the user is authenticated
      if (!$user) {
          return response()->json(['message' => 'Unauthenticated.'], 401);
      }

      // Check if the user has already watched this lesson.
      if ($user->watched->contains($lesson->id)) {
          return response()->json(['message' => 'Lesson already watched.'], 400);
      }

      // Attach the lesson to the user's watched lessons.
      $user->watched()->attach($lesson->id);

      return response()->json(['message' => 'Lesson watched successfully.', 'lesson' => $lesson], 200);
  }
}
