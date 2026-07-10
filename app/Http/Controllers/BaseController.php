<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function successMessage($success, $message, $data){
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function errorMessage($success, $message){
        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }
}
