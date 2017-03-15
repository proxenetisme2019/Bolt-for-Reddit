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

        $BodyWinners = array();//Initial, empty, arrays
        $Winners = array();

        $initialrequest = file_get_contents('https://api.pushshift.io/reddit/search?link_id='.$postCode);
        //$file = '/Users/Olly/Desktop/comments.php';
        //$initialrequest = file_get_contents($file);
        $request_decoded = json_decode($initialrequest, true);

        for($iteration = 0; $iteration < $amount; $iteration++){
            $RInt = random_int (0 , $request_decoded["metadata"]["results"] - 1);// Creates a random INT between 0 and total results-1 , inclusive.
            $HTMLBody = $request_decoded["data"][$RInt]["body"];
            $HTMLBodyLower = strtolower ($HTMLBody);// Turns initial body to lowercase

            if($errors > $request_decoded["metadata"]["results"] * 2){ // If we encounter *2 as many errors as there are total results, we assume an error.
              return View::make('layouts.result')->with('status', 'Sorry, we encountered an error!');
            }else{
              if($keyword == null){ //If no keyword is submitted, winners are based off only the random int
                array_push($BodyWinners, $request_decoded["data"][$RInt]["body"]);
                array_push($Winners, $request_decoded["data"][$RInt]["author"]);
              }else{
                if(strpos ($HTMLBodyLower, $keyword)){// Uses a lowerscase version of the body and checks if the keyword is present
                  if(in_array($request_decoded["data"][$RInt]["author"], $Winners)){// Checks if this winner has already been chose, if so, redo.
                    $iteration -= 1;
                  }else{
                    array_push($BodyWinners, $request_decoded["data"][$RInt]["body"]);
                    array_push($Winners, $request_decoded["data"][$RInt]["author"]);
                  }
                }else{ //If keyword is not found in body, redo
                    $iteration -= 1;
                    $errors += 1;
                }
              }
            }
        }
        return View::make('layouts.result', compact('BodyWinners', 'Winners'));
    }
}
