<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\Genre;
use App\Models\Level;
use App\Models\Instructor;
use Storage;

class AddLessonController extends Controller
{
    public function index(Lesson $lesson)
    {
        if(!\Auth::check()){
            \Cookie::queue('backUrl', url()->previous());
            return view('login');
        }
        $genres = Genre::all();
        $levels = Level::all();
        return view('addLesson', ['lesson' => $lesson, 'genres' => $genres, 'levels' => $levels]);
    }

    public function create(Request $request)
    {
        if(!\Auth::check()){
            \Cookie::queue('backUrl', url()->previous());
            return view('login');
        }
        $post = new Post;
        $lesson = new Lesson;
        $form = $request->all();

        $user = \Auth::user();
        $instructor = Instructor::where('line_id', $user->line_id)->first();
        if (!$instructor) {
            $title = 'インストラクター登録を行ってください';
            $message = 'レッスンの登録には、インストラクター登録が必要です。';
            return view('message', ['title' => $title, 'message' => $message]);
        }

        $lesson->instructor_id = $instructor->id;
        $lesson->studio_id = $request->studio_id;
        $lesson->genre_id = $request->genre_id;
        $lesson->level_id = $request->level_id;
        $lesson->price = $request->price;
        $lesson->lesson_start_dt = $request->lesson_date . ' ' . $request->lesson_start_time;
        $lesson->lesson_end_dt = $request->lesson_date . ' ' . $request->lesson_end_time;
        $lesson->deadline_dt = $request->lesson_date . ' 00:00:00';
        $lesson->capacity = $request->capacity;
        $lesson->outline = $request->outline;
        $lesson->url_token = sha1(uniqid(mt_rand(), true));
  

        // if ($image2) {
        //     // バケットの`tmp`フォルダへアップロード
        //     $path2 = Storage::disk('s3')->putFile('tmp/1', $image2, 'public');
        //     // アップロードした画像のフルパスを取得
        //     $post = new Post;
        //     $post->image_path = Storage::disk('s3')->url($path2);
        //     $lesson->img_file_path_2 = $post->image_path;
        //     $post->save();
        // }

        // if ($image3) {
        //     // バケットの`tmp`フォルダへアップロード
        //     $path3 = Storage::disk('s3')->putFile('tmp/1', $image3, 'public');
        //     // アップロードした画像のフルパスを取得
        //     $post = new Post;
        //     $post->image_path = Storage::disk('s3')->url($path3);
        //     $lesson->img_file_path_3 = $post->image_path;
        //     $post->save();
        // }

        $lesson->save();
  
        return redirect('addLesson');
    }
    public function edit(Lesson $lesson)
    {
        if(!\Auth::check()){
            \Cookie::queue('backUrl', url()->previous());
            return view('login');
        }

        $user = Auth::user();
        $lesson = Lesson::where('url_token', $request->urlToken)->first();
        $genres = Genre::all();
        $levels = Level::all();
        return view('addLesson', ['lesson' => $lesson, 'genres' => $genres, 'levels' => $levels]);
    }
}
