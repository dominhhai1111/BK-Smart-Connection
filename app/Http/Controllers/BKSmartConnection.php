<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use DB;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

class BKSmartConnection extends Controller
{
    public function test($object1, $object2){
        $result = json_encode($this->getResult(json_decode($object1), json_decode($object2)));
        return $result;
    }

    public function show($id)
    {
        $user = DB::table("USER")->select("id", "name")->where("id", $id)->first();
        return json_encode($user);
    }

    public function getMusicUrlForUser($score, $objects)
    {
        $arr = array(array("name"=>"home", "type"=>"LOCATION", "frequency"=>"0.6"), array("name"=>"Lynk Lee", "type"=>"PERSON", "frequency"=>"0.4"));

        $json = json_encode($arr);
        $objects = json_decode($json);
        $list_existence_noun = [];
        foreach ($objects as $object){
            switch ($object->type){
                case "PERSON": $list_peron[] = $object->name;
                case "LOCATION": $list_existence_noun[] = $object->type;
                case "OTHER": $list_existence_noun[] = $object->type;
            }
        }
        $topic = $this->findTopicMusic($objects);
        $singer = $this->findSingerMusic($objects);
        $music = DB::table("music")->where("id", 1)->first();
        return var_dump($topic) . var_dump($singer) ;
    }

    public function findTopicMusic($objects){
        $topics_weight = [];
        foreach ($objects as $object){
            if ($object->type == "LOCATION" || $object->type == "OTHER"){
                $existence_in_data = DB::table("dictionary")->select("id_topic")->where("name", $object->name)->first();
                //var_dump($existence_in_data); die;
                if($existence_in_data != null){
                    if(!array_key_exists($existence_in_data->id_topic, $topics_weight)){
                        $topics_weight[$existence_in_data->id_topic] = 0;
                    }
                    $topics_weight[$existence_in_data->id_topic] += $object->frequency;
                }
            }
        }
        $id_topic_have_max_weight = array_search(max($topics_weight),$topics_weight);
        // Choose topic have max weight is the first in array $topics_have_max_wright
        $topic_have_max_weight = DB::table("topic")->where("id", $id_topic_have_max_weight)->first();
        return $topic_have_max_weight;
    }

    public function findSingerMusic($objects){
        foreach ($objects as $object){
            if($object->type == "PERSON"){
                $existence_in_data = DB::table("singer")->where("name", $object->name)->first();
                if($existence_in_data != null){
                    return $existence_in_data;
                }else {
                    return null;
                }
            }
        }
    }

    public function playMusic($music){
        return redirect("/public/uploads/music/".$music);
    }

    public function getResult($object1, $object2){
        //TODO
        $result = ["rule1" => 0, "rule2" => 0, "rule3" => 0, "rule4" => 0, "rule5" => 0, "rule6" => 0, "rule7" => 0];
        if ($this->rule1($object1)){
            $result["rule1"] = 1;
        }
        if ($this->rule2($object2)) {
            $result["rule2"] = 1;
        }
        if ($this->rule3($object1)){
            $result["rule3"] = 1;
        }
        if ($this->rule4($object2)) {
            $result["rule4"] = 1;
        }
        if ($result["rule1"] && $result["rule2"]) {
            if($this->rule5($object1, $object2)){
                $result["rule5"] = 1;
            }
        }
        if ($result["rule3"] && $result["rule4"]) {
            if($this->rule6($object1, $object2)){
                $result["rule6"] = 1;
            }
        }
        if ($result["rule2"] && $result["rule4"]) {
            if($this->rule7($object1, $object2)){
                $result["rule7"] = 1;
            }
        }
        for ($i = sizeof($result); $i > 0; $i--){
            if ($result["rule" . $i]){
                switch ($i){
                    case 1: return $this->rule1($object1);
                    case 2: return $this->rule2($object2);
                    case 3: return $this->rule3($object1);
                    case 4: return $this->rule4($object2);
                    case 5: return $this->rule5($object1, $object2);
                    case 6: return $this->rule6($object1, $object2);
                    case 7: return $this->rule7($object1, $object2);
                }
            }
        }
        return null;
    }
    // singer
    public function rule1($objects){
        $arrSingerName = [];
        foreach ($objects as $object){
            if ($object->type == "PERSON"){
                $arrSingerName[] = $object->name;
            }
        }
        $str_singers = $this->convertMessage($arrSingerName);
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, song.url
            FROM song, singer
            WHERE song.singer_id = singer.id AND
            singer.name IN $str_singers"
        );
        return $list_of_song;
    }
    // Genre
    public function rule2($object2){
        $convertMessage = $this->convertMessage($this->explodeMessage($object2->document));
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, song.url
            FROM song, genre, singer
            WHERE genre.id = song.genre_id AND
            song.singer_id = singer.id AND
            genre.name IN $convertMessage"
        );
        return $list_of_song;
    }
    // View
    public function rule3($objects){
        $arrViewName = [];
        foreach ($objects as $object){
            if ($object->type == "LOCATION"){
                $arrViewName[] = $object->name;
            }
        }
        $str_views = $this->convertMessage($arrViewName);
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, song.url
            FROM song, singer, view, song_view
            WHERE song.singer_id = singer.id AND
            song.id = song_view.song_id AND
            view.id = song_view.view_id AND
            view.name IN $str_views"
        );
        return $list_of_song;
    }
    // Feeling
    public function rule4($object2){
        $convertMessage = $this->convertMessage($this->explodeMessage($object2->document));
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, song.url
            FROM song, feeling, song_feeling, feeling_words, singer
            WHERE song.id = song_feeling.song_id AND 
            feeling.id = song_feeling.feeling_id AND
            song.singer_id = singer.id AND
            feeling.id = feeling_words.feeling_id AND 
            feeling_words.name IN $convertMessage"
        );
        return $list_of_song;
    }
    // Singer + Genre
    public function rule5($object1, $object2){
        $arrSingerName = [];
        foreach ($object1 as $object){
            if ($object->type == "PERSON"){
                $arrSingerName[] = $object->name;
            }
        }
        $str_singers = $this->convertMessage($arrSingerName);
        $convertMessage = $this->convertMessage($this->explodeMessage($object2->document));
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, song.url
            FROM song, genre, singer
            WHERE genre.id = song.genre_id AND
            song.singer_id = singer.id AND
            genre.name IN $convertMessage AND song.id IN 
            (SELECT song.id
            FROM song, singer
            WHERE song.singer_id = singer.id AND
            singer.name IN $str_singers)"
        );

        return $list_of_song;
    }
    // View + Feeling
    public function  rule6($object1, $object2){
        $arrViewName = [];
        foreach ($object1 as $object){
            if ($object->type == "LOCATION"){
                $arrViewName[] = $object->name;
            }
        }
        $str_views = $this->convertMessage($arrViewName);
        $convertMessage = $this->convertMessage($this->explodeMessage($object2->document));
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, song.url
            FROM song, singer, view, song_view
            WHERE song.singer_id = singer.id AND
            song.id = song_view.song_id AND
            view.id = song_view.view_id AND
            view.name IN $str_views AND
            song.id IN 
            (SELECT song.id
            FROM song, feeling, song_feeling, feeling_words, singer
            WHERE song.id = song_feeling.song_id AND 
            feeling.id = song_feeling.feeling_id AND
            song.singer_id = singer.id AND
            feeling.id = feeling_words.feeling_id AND 
            feeling_words.name IN $convertMessage)"
        );
        return $list_of_song;
    }
    // Genre + Feeling
    public  function  rule7($object1, $object2){
        $convertMessage = $this->convertMessage($this->explodeMessage($object2->document));
        $list_of_song = DB::select(
            "SELECT song.name as song_name, singer.name as singer_name, song.url
            FROM song, genre, singer
            WHERE genre.id = song.genre_id AND
            song.singer_id = singer.id AND
            genre.name IN $convertMessage AND 
            song.id IN 
            (SELECT song.id
            FROM song, feeling, song_feeling, feeling_words, singer
            WHERE song.id = song_feeling.song_id AND 
            feeling.id = song_feeling.feeling_id AND
            song.singer_id = singer.id AND
            feeling.id = feeling_words.feeling_id AND 
            feeling_words.name IN $convertMessage)"
        );

        return $list_of_song;
    }
    
    public function ruletest1(){
        $result = DB::table("song")->get();
        return $result;
    }

    public function explodeMessage($message){
        $arrMessage = explode(" ", $message);
        return $arrMessage;
    }

    public function convertMessage($message){
        $convertMessage = "('" . implode("', '", $message) . "')";
        return $convertMessage;
    }
}
