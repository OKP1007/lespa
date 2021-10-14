<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Genre;
use App\Models\Level;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LessonListController extends Controller
{
    public function index(Request $request)
    {
        // state検証
        $state_line = $request->input('state');
        $state_cookie = \Cookie::get('state');
        $lessons = Lesson::where('lesson_start_dt', '>', Carbon::now())->orderBy('lesson_start_dt', 'asc')->paginate(5);
        $genres = Genre::all();
        $levels = Level::all();
        // stateが異なる場合
        if($state_line == null || $state_line !== $state_cookie){
            \Session::flash('flash_message', 'state検証エラー');
            return view('lessonList', ['lessons' => $lessons, 'genres' => $genres, 'levels' => $levels]);
        }

        // エラーレスポンスが返って来た場合はエラーを返却
        $error_description = $request->input('error_description');
        if($error_description != ""){
                \Session::flash('flash_message', '権限が拒否されました');
                return view('lessonList', ['lessons' => $lessons, 'genres' => $genres, 'levels' => $levels]);
        }

        // アクセストークンを発行する
        $code = $request->input('code');
        $lineUserData = $this->basic_request($code);
        return view('lessonListHasUser', ['lessons' => $lessons, 'lineUserData' => $lineUserData
            , 'genres' => $genres, 'levels' => $levels, 'accessToken' => $code]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {
        // state検証
        $state_line = $request->input('state');
        $state_cookie = \Cookie::get('state');
        // stateが異なる場合
        if($state_line !== $state_cookie){
            \Session::flash('flash_message', 'state検証エラー');
            return redirect('/');
        }

        // エラーレスポンスが返って来た場合はエラーを返却
        $error_description = $request->input('error_description');
        if($error_description != ""){
            \Session::flash('flash_message', '権限が拒否されました');
            return redirect('/');
        }

        // アクセストークンを発行する
        $code = $request->input('code');
        $lineUserData = $this->basic_request($code);
        $user = User::where('line_id', $lineUserData->userId)->first();
        if ($user == null) {
            $user = User::create([
                'name' => $lineUserData->displayName,
                'line_id' => $lineUserData->userId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        Auth::loginUsingId($user->id);

        if (!is_null(\Cookie::get('backUrl'))) {
            return redirect(\Cookie::get('backUrl'));
        } else {
            return redirect('/');
        }
    }

    // アクセストークン発行
    // 参考　https://yaba-blog.com/laravel-call-api/
    public function basic_request(String $code) {

        $client = new Client();
        $response = $client->request('POST', 'https://api.line.me/oauth2/v2.1/token', array(
            "headers" => array(
                "Content-Type" => "application/x-www-form-urlencoded",
            ),
            "form_params" => array(
                "grant_type" => "authorization_code",
                "code" => $code,
                "redirect_uri" => "https://dantick.com/login",
                "client_id" => env('CLIENT_ID', false),
                "client_secret" => env('CHANNEL_SECRET')
            )
        ));

        $post = $response->getBody();
        $post = json_decode($post, true);
        //レスポンスから新規記事のURLを取得
        $accessToken = $post['access_token'];
        $refreshToken = $post['refresh_token'];

        $this->verify_access_token($accessToken);
        return $this->getLineUserData($accessToken);
    }


    // アクセストークン検証
    public function verify_access_token(String $access_token)
    {
        $url = "https://api.line.me/oauth2/v2.1/verify?access_token=" . $access_token ;
        $method = "GET";
        //接続
        $client = new Client();
        $response = $client->request($method, $url);
        $posts = $response->getBody();
        $posts = json_decode($posts, true);
    }

    // ユーザー情報取得
    private function getLineUserData(String $access_token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/profile");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($response);
        
        return $json;

    }
    public function search(Request $request)
    {
        $lessonQuery = Lesson::select('lessons.*')
        ->join('instructors', 'lessons.instructor_id', '=', 'instructors.id')
        ->join('genres', 'lessons.genre_id', '=', 'genres.id')
        ->join('levels', 'lessons.level_id', '=', 'levels.id');
        if ($request->instractorName != "") {
            $lessonQuery->where('instructors.name', $request->instractorName);
        }
        $priceRanges = array();
        if ($request->priceRangeLow != null && $request->priceRangeLow != "" && $request->priceRangeHigh != null && $request->priceRangeHigh != "") {
            $priceRanges[] = $request->priceRangeLow;
            $priceRanges[] = $request->priceRangeHigh;
            $lessonQuery->whereBetween('lessons.price', $priceRanges);
        }
        if ($request->area != null && $request->area != "") {
            $lessonQuery->where('lessons.area', 'LIKE', '%' . $request->genreId . '%');
        }
        if ($request->genreId != null && $request->genreId != "") {
            $lessonQuery->where('lessons.genre_id', $request->genreId);
        }
        if ($request->levelId != null && $request->levelId != "") {
            $lessonQuery->where('lessons.level_id', $request->levelId);
        }
        if ($request->lessonDate != null && $request->lessonDate != "") {
            $lessonQuery->whereBetween('lessons.lesson_start_dt', [$request->lessonDate . ' 00:00:00', $request->lessonDate . ' 23:59:59']);
        }

        $lessons = $lessonQuery->where('lesson_start_dt', '>', Carbon::now())->orderBy('lesson_start_dt', 'asc')->paginate(5);
        $genres = Genre::all();
        $levels = Level::all();
        return view('lessonList', ['lessons' => $lessons, 'genres' => $genres, 'levels' => $levels, 'request' => $request]);
    }
}
