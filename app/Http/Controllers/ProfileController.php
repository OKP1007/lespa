<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Attend;
use App\User;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Lesson $lesson)
    {
        if(!Auth::check()){
            return redirect('/loginCheck');
        }
        $user = Auth::user();
        $instructor = Instructor::where('line_id', $user->line_id)->first();
        return view('profile', ['user' => $user,'instructor' => $instructor]);
    }
    public function edit(Lesson $lesson)
    {
        if(!Auth::check()){
            return redirect('/loginCheck');
        }
        $user = Auth::user();
        return view('profileEdit', ['user' => $user]);
    }
    public function update(Request $request)
    {
        if(!Auth::check()){
            return redirect('/loginCheck');
        }
        $user = Auth::user();
        $user->name = $request->name;
        $user->tel = $request->tel;
        $user->save();
        $instructor = Instructor::where('line_id', $user->line_id)->first();
        return view('profile', ['user' => $user,'instructor' => $instructor]);
    }
}
