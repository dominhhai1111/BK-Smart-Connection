<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SolutionController extends Controller
{
    public function getSolution($topic, $feeling)
    {
        $circumstace_condition = ['topic' => $topic, 'feeling' => $feeling];
        $circumstace = DB::table("circumstance")->where($circumstace_condition)->first();
        $solution = DB::table("solution")->where("circumstance_id", $circumstace->id)->inRandomOrder()->first();
        var_dump($solution);

        return Redirect::to("http://bksmartconnection.local/public/uploads".$solution->url);
    }
}
