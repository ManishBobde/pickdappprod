<?php

namespace App\Http\Controllers;

use App\Exceptions\ResponseConstructor;
use App\FeedBack;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;

class FeedBackController extends Controller
{
    protected $request;
    /**
     * @var ResponseConstructor
     */
    private $responseConstructor;

    public function __construct(Request $request,ResponseConstructor $responseConstructor){

        $this->request=$request;
        $this->responseConstructor = $responseConstructor;
        $this->middleware('jwt.auth');
    }

    public function feedback()
    {

        $rules = array(
            'feedback' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return $this->responseConstructor->setResultCode(500)
                ->setResultTitle("Feedback error")
                ->respondWithError("Error in Feedback");
        } else {
            // store
            $feedback = new FeedBack;
            $feedback->feedBackText = Input::get('feedback');
            $feedback->save();
        }

        return $this->responseConstructor->setResultCode(200)
            ->setResultTitle("Feedback received")
            ->successResponse("Done");

    }
}
