<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolutionController extends Controller
{
    public function getSolution($topic, $feeling)
    {
        $circumstace_condition = ['topic' => $topic, 'feeling' => $feeling];
        $circumstace = DB::table("circumstance")->where($circumstace_condition)->first();
        var_dump($circumstace);
    }
}
