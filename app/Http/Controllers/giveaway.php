<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class giveaway extends Controller
{
    public function requestFromAPI(Request $request){
        $postCode = $request->input('code');
        $amount = $request->input('number');
        $keyword = $request->input('keyword');
        $errors = 0;

        $BodyWinners = array();
        $Winners = array();

        $initialrequest = file_get_contents('https://api.pushshift.io/reddit/search?link_id='.$postCode);
        //$file = '/Users/Olly/Desktop/comments.php';
        //$initialrequest = file_get_contents($file);
        $request_decoded = json_decode($initialrequest, true);
        //dd($request_decoded);

        for($iteration = 0; $iteration < $amount; $iteration++){
            $RInt = random_int (0 , $request_decoded["metadata"]["results"] - 1);
            $HTMLBody = $request_decoded["data"][$RInt]["body"];
            //$HTMLBody = $request_decoded[1]["data"]["children"][$RInt]["data"]["body_html"];
            $HTMLBodyLower = strtolower ($HTMLBody);

            if($errors > $request_decoded["metadata"]["results"] * 2){ // If we encounter 2* as many errors as there is total reults we assume an error.
              return View::make('layouts.result')->with('status', 'Sorry, we encountered an error!');
            }else{
              if($keyword == null){
                array_push($BodyWinners, $request_decoded["data"][$RInt]["body"]);
                array_push($Winners, $request_decoded["data"][$RInt]["author"]);
                //array_push($BodyWinners, $request_decoded[1]["data"]["children"][$RInt]["data"]["body_html"]);
                //array_push($Winners, $request_decoded[1]["data"]["children"][$RInt]["data"]["author"]);
              }else{
                if(strpos ($HTMLBodyLower, $keyword)){
                  if(in_array($request_decoded["data"][$RInt]["author"], $Winners)){
                    $iteration -= 1;
                  }else{
                    array_push($BodyWinners, $request_decoded["data"][$RInt]["body"]);
                    array_push($Winners, $request_decoded["data"][$RInt]["author"]);
                    //array_push($BodyWinners, $request_decoded[1]["data"]["children"][$RInt]["data"]["body_html"]);
                    //array_push($Winners, $request_decoded[1]["data"]["children"][$RInt]["data"]["author"]);
                  }
                }else{
                    $iteration -= 1;
                    $errors += 1;
                }
              }
            }
        }
        return View::make('layouts.result', compact('BodyWinners', 'Winners'));
    }
}
