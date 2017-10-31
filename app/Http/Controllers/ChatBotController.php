<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatBotController extends Controller
{
    public function getResponse($request)
    {
        $request = strtolower($request);
        $conversation = DB::table("conversation")->where("request", $request)->first();
        var_dump($conversation);
    }
}
