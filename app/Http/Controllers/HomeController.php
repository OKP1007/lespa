<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Attend;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Lesson $lesson)
    {
        $user = Auth::user();
        $status = 0;
        $lessonCount = Attend::where('lesson_id', $lesson->id)->count();
        if ($user) {
            $lessonAttend = Attend::where('lesson_id', $lesson->id)->where('user_id', $user->id)->first();
            if (is_set($lessonAttend)) {
                $status = $lessonAttend->status;
            }
        }
        return view('lesson', ['lesson' => $lesson, 'lessonCount' => $lessonCount, 'status' => $status]);
    }
    public function login()
    {
        if(!\Auth::check()){
            \Cookie::queue('backUrl', url()->previous());
            return view('login');
        } else {
            $user = Auth::user();
            return view('profile', ['user' => $user]);
        }
    }
}
