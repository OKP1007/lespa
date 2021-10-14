<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Attend;
use App\User;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $status = 0;
        $isInstructor = false;

        $user = Auth::user();
        $lesson = Lesson::where('url_token', $request->urlToken)->first();
        $lessonCount = Attend::where('lesson_id', $lesson->id)->count();
        if ($user) {
            $lessonAttend = Attend::where('lesson_id', $lesson->id)->where('user_id', $user->id)->first();
            if (isset($lessonAttend)) {
                $status = $lessonAttend->status;
            }
            // レッスンの講師か判定
            $instructor = Instructor::where('line_id', $user->line_id)->first();
            if ($instructor && $instructor->id == $lesson->instructor_id) {
                $isInstructor = true;
            }
        }
        return view('lesson', ['lesson' => $lesson, 'lessonCount' => $lessonCount, 'status' => $status, 'isInstructor' => $isInstructor]);
    }
}
