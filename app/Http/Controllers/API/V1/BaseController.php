<?php


namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{

    public function handleResponse($result, $msg)
    {
    	$res = [
            'status' => true,
            'data'    => $result,
            'message' => $msg,
        ];
        return response()->json($res, 200);
    }

    public function handleError($error, $errorMsg = [], $code = 503)
    {
    	$res = [
            'status' => false,
            'message' => $error,
        ];
        if(!empty($errorMsg)){
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }
}
