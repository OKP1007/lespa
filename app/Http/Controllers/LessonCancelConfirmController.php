<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Genre;
use App\Models\Level;
use App\Models\Attend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonCancelConfirmController extends Controller
{
    public function index(Request $request)
    {
        if(!\Auth::check()){
            \Cookie::queue('backUrl', url()->previous());
            return view('login');
        }
        $lesson = Lesson::find($request->lesson_id);
        return view('lessonCancelConfirm', ['lesson' => $lesson]);
    }
    public function submit(Request $request)
    {
        if(!\Auth::check()){
            return view('login');
        }
        $user = Auth::user();
        DB::table('attends')
            ->where('user_id', $user->id)
            ->where('lesson_id', $request->lesson_id)
            ->update(['status' => 2]);
        $lesson = Lesson::find($request->lesson_id);
        $this->sendMessage($user, $lesson);
        $title = 'キャンセル完了';
        $message = 'キャンセルが完了いたしました。';
        return view('message', ['title' => $title, 'message' => $message]);
    }

    // ユーザー情報取得
    private function sendMessage($user, $lesson)
    {
        // $dataに送るデータを詰めます。
        $data = array(
            'to' => $user->line_id,
            'messages' => [
                array(
                    "type" => "template",
                    "altText" => "レッスンの受付を取り消しました。\n". url('') . '/lesson/' . $lesson->url_token,
                    "template" => array(
                        "type" => "buttons",
                        "imageAspectRatio" => "square",
                        "text" => "レッスンの受付の受付を取り消しました。\n" . 
                                '講師名 : ' . $lesson->instructor->name . "\n" .
                                '日時 : ' . $lesson->lesson_start_dt . "\n",
                        "actions" => [
                            array(
                                "type" =>  "uri",
                                "label" => "詳細",
                                "uri" => url('') . '/lesson/' . $lesson->url_token
                            ),
                        ],
                    ),
                )
            ]
        );
        if ($lesson->img_file_path_1) {
            $data['messages'][0]['template']['thumbnailImageUrl'] = $lesson->img_file_path_1;
        } elseif ($lesson->instructor->img_file_name) {
            $data['messages'][0]['template']['thumbnailImageUrl'] = $lesson->instructor->img_file_name;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . env('CHANNEL_ACCESS_TOKEN'),
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/bot/message/push");
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // 送信データ

        $response = curl_exec($ch);
        curl_close($ch);
    }
}
