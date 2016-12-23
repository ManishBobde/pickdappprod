<?php

namespace App\Http\Controllers;

use App\Exceptions\ResponseConstructor;
use Illuminate\Http\Request;

use App\Http\Requests;

class AppController extends Controller
{
    public function __construct(Request $request,ResponseConstructor $responseConstructor){

        $this->request=$request;
        $this->responseConstructor = $responseConstructor;
        $this->middleware('jwt.auth');
    }

    public function shareApp(){

        return response()->json([
           "body"       =>  "Share this app",
           "imageUrl"   =>  public_path()."/image.png"
        ]);

    }

    public function getLatestAppVersion(){

        return response()->json([
            "appVersion"       =>  "1.0"
        ]);

    }
}
