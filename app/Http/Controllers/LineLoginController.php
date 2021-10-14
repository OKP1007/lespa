<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Str;

class LineLoginController extends Controller
{
    public function index()
    {
        // state生成
        $state = Str::random(40);
        \Cookie::queue('state', $state,100);

        // nonce生成
        $nonce  = Str::random(40);
        \Cookie::queue('nonce', $nonce,100);

        // LINE認証 
        $uri ="https://access.line.me/oauth2/v2.1/authorize?response_type=code";
        $client_id_uri = "&client_id=".env('CLIENT_ID', false);
        $redirect_uri ="&redirect_uri=https://dantick.com/login";
        $state_uri = "&state=".$state;
        $scope_uri="&scope=openid%20profile";
        $prompt_uri = "&prompt=consent";
        $nonce_uri = "&nonce=";
        $bot_prompt = "&bot_prompt=aggressive";

        return redirect($uri.$client_id_uri.$redirect_uri.$state_uri.$scope_uri.$prompt_uri.$nonce_uri.$bot_prompt);
    }
    public function logout()
    {
        if(\Auth::check()){
            //ログイン状態だった場合強制ログアウトする
            \Auth::logout();
        }
        return redirect('/');
    }
}
