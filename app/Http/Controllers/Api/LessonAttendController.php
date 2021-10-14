<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonAttendController extends Controller
{
    public function isReserved(Request $request)
    {
        $lessonAttendCount = Attend::where('lesson_id', $request->lessonId)->where('user_id', $request->userId)->count();
        if ($lessonAttendCount == 0) {
            $isAttended = false;
        } else {
            $isAttended = true;
        }
        return response()->json(['isAttended', $isAttended]);
    }
}
