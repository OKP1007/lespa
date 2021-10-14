<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use App\User;
use Illuminate\Support\Facades\Auth;
use Storage;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        if(!\Auth::check()){
            \Cookie::queue('backUrl', url()->previous());
            return view('login');
        }
        $user = Auth::user();
        $instructor = Instructor::where('line_id', $user->line_id)->first();
        if (!$instructor) {
            return view('instructor', ['user' => $user, 'instructor' => $instructor]);
        }
        return view('instructorEdit', ['instructor' => $instructor]);
    }
    public function submit(Request $request)
    {
        if(!\Auth::check()){
            return view('login');
        }
        $user = Auth::user();
        $instructor = new Instructor;

        $instructor->line_id = $request->line_id;
        $instructor->name = $request->name;
        $instructor->gender = 1;
        // $instructor->gender = $request->gender;
        $instructor->age = $request->age;
        $instructor->introduction = $request->introduction;
        $instructor->career = $request->career;
        $instructor->twitter_id = $request->twitter_id;
        $instructor->instagram_id = $request->instagram_id;
        // $instructor->img_file_name = $request->img_file_name;
        $instructor->img_file_name = 'https://liff-danceticket.s3-ap-northeast-1.amazonaws.com/tmp/1/DSC_0769.jpg';
        $instructor->save();

        $title = 'インストラクター登録完了';
        $message = 'インストラクターの登録が完了いたしました。';
        return view('message', ['title' => $title, 'message' => $message]);
    }
    public function edit(Request $request)
    {
        if(!\Auth::check()){
            \Cookie::queue('backUrl', url()->previous());
            return view('login');
        }
        $user = Auth::user();
        $instructor = Instructor::where('line_id', $user->line_id)->first();
        if (!$instructor) {
            return view('instructor', ['user' => $user]);
        }
        return view('instructorEdit', ['instructor' => $instructor]);
    }
    public function update(Request $request)
    {
        if(!\Auth::check()){
            return view('login');
        }
        $user = Auth::user();
        $instructor = Instructor::where('line_id', $user->line_id)->first();
        if (!$instructor) {
            $title = 'インストラクター情報更新に失敗しました。';
            $message = 'インストラクター情報更新に失敗しました。';
            return view('message', ['title' => $title, 'message' => $message]);
        }

        $instructor->line_id = $user->line_id;
        $instructor->name = $request->name;
        $instructor->gender = 1;
        // $instructor->gender = $request->gender;
        $instructor->age = $request->age;
        $instructor->introduction = $request->introduction;
        $instructor->career = $request->career;
        $instructor->twitter_id = $request->twitter_id;
        // $instructor->instagram_id = $request->instagram_id;
        // $instructor->img_file_name = $request->img_file_name;
        //s3アップロード開始
        $image = $request->file('img_file_name');
        // $image2 = $request->file('img_file_path_2');
        // $image3 = $request->file('img_file_path_3');

        if ($image) {
            // // 画像の大きさ指定
            // $img_max_height = "350";
            // $img_max_width = "350";
            // // 拡張子取得
            // $imgType = image_type_to_mime_type(exif_imagetype($image));
 
            // // 画像の大きさを取得
            // list($img_width,$img_height) = getimagesize($image);
             
            // // 画像の大きさが規定値以内であれば、そのまま
            // // それ以上であれば、規定値に縮小
            // if(($img_max_height > $img_height) && ($img_max_width > $img_width)){
            //     $resize_height = $img_height;
            //     $resize_width = $img_width;
            // }else{
            //     $per = 1.0; // 倍率
            //     $resize_height = $img_height;
            //     $resize_width = $img_width;
            //     while($img_max_width < $resize_width){
            //         $resize_height = floor($resize_height * $per);
            //         $resize_width = floor($resize_width * $per);
            //         $per = $per - 0.1;
            //     }
            //     while($img_max_height < $resize_height){
            //         $resize_height = floor($resize_height * $per);
            //         $resize_width = floor($resize_width * $per);
            //         $per = $per - 0.1;
            //     }
            // }
            // // サムネイルの画像リソース
            // $thumb_image = imagecreatetruecolor($resize_width,$resize_height);
            // $original_image = imagecreatefromgif($image);
            // // サムネイル画像の作成
            // imagecopyresampled($thumb_image, $original_image, 0, 0, 0, 0,
            //     $resize_width,$resize_height,
            //     $img_width,$img_height);
            // バケットの`tmp`フォルダへアップロード
            $path1 = Storage::disk('s3')->putFile('tmp/' . $user->id . '/intraImg', $image, 'public');
            // アップロードした画像のフルパスを取得
            $instructor->img_file_name = Storage::disk('s3')->url($path1);
        }

        // $instructor->img_file_name = 'https://liff-danceticket.s3-ap-northeast-1.amazonaws.com/tmp/1/DSC_0769.jpg';
        $instructor->save();

        $title = 'インストラクター更新完了';
        $message = 'インストラクター情報の更新が完了いたしました。';
        return view('message', ['title' => $title, 'message' => $message]);
    }
}
