<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as Controller;

use Illuminate\Http\Request;

class BaseController extends Controller
{
	/*
		Response for succesfull request
	*/
	public function showResponse($result,$message){
		$response=[
			'succes'=>true,
			'data'=>$result,
			'message'=>$message
		];
		return response()->json($response,200);
	}

	/*
		Response for error request
	*/

	public function errorResponse($error,$errorMessages=[],$code=404){
		$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
	}
}
