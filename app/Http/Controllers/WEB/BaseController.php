<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //success response methode
    public function sendResponse($result,$message){
        $response= 
        [
            'success'=>true,
            'data'=>$result,
            'message'=>$message
        ];
        return response()->json($response, 200);
    }

    //error response
    public function sendError($error, $errorMessage = [], $code = 300){
        $response = 
        [
            'success'=>false,
            'message'=>$error
        ];
        if(!empty($errorMessage)){
            $response['data'] = $errorMessage;
        }
        return response()->json($response, $code);
    }

    //notfound reaponse
    public function sendNotFound($errnotfound, $errorMessagenotfound = [], $code = 404){
        $response = 
        [
            'success'=>false,
            'message'=>$errnotfound
        ];
        if(!empty($errorMessagenotfound)){
            $response['data'] = $errorMessagenotfound;
        }
        return response()->json($response, $code);
    }
}
