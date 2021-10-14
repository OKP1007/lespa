<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;

class ApiController extends Controller
{
    public function webhook(Request $request)
    {
        \Log::info($request->events[0]['source']['userId']);
        $this->accountLink($request->events[0]['source']['userId'], $request->events[0]['replyToken']);
        return;
    }
    /**
    * @param string $userId
    * @param string $replayToken
    * @throws \LINE\LINEBot\Exception\CurlExecutionException
    */
   private function accountLink(string $userId, string $replayToken){

       $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(config("auth.line-api-key"));
       $response = $httpClient->post("https://api.line.me/v2/bot/user/{$userId}/linkToken",[]);

       $rowBody = $response->getRawBody();
       $responseObject = json_decode($rowBody);
       $linkToken = object_get($responseObject, "linkToken");
       $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => config("auth.channel-secret")]);

       $templateMessage = new TemplateMessageBuilder("account link", new ButtonTemplateBuilder("アカウント連携します。", "アカウント連携します。", null, [
           new UriTemplateActionBuilder("OK", route("lessonList", ["linkToken" => $linkToken]))
       ]));
       $response = $bot->replyMessage($replayToken, $templateMessage);
       $lineResponse = $response->getHTTPStatus() . ' ' . $response->getRawBody();
       \Log::info($lineResponse);
   }
}
