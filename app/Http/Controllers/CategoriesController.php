<?php

namespace App\Http\Controllers;

use App\AndroidDevice;
use App\Exceptions\ResponseConstructor;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use PD\Categories\Categories;
use Tymon\JWTAuth\JWTAuth;

define("GODTOKEN", "167511DD59C25DF253717564C1218");

class CategoriesController extends Controller
{


    protected $request, $responseConstructor,$auth;

    public function __construct(ResponseConstructor $responseConstructor, Request $request,JWTAuth $auth)
    {

        $this->request = $request;
        $this->auth = $auth;
        $this->responseConstructor = $responseConstructor;
        $this->middleware('jwt.auth', ['except' => array('getSubscribableCategories')]);
    }

    /**
     * Method for getting all categories
     */
    public function getSubscribableCategories()
    {

        $token = $this->request->header('godToken');

        if ($token == GODTOKEN) {

            if (Cache::has('categories_all')) {
                $categories = Cache::get('categories_all');

            } else {
                $categories = Categories::all();
            if($categories)
                Cache::add('categories_all', $categories, 60);

            }
            return response()->json(
                [
                    'categories' => $categories
                ],
                200
            );
        } else {

            return $this->responseConstructor
                ->setResultCode(500)
                ->setResultTitle("Invalid Token")
                ->respondWithError("Invalid Token");

        }

    }

    /*Method for subscribing categories*/

    public function subscribeCategories()
    {
        $token = $this->request->header('Authorization');

        $ttoken = $this->retrieveTokenFromHeader($token);

        $androidDeviceId = $this->getUserIdFromToken($ttoken);

        $categories = new Categories();

        $categories->categoryIds = Input::get('subscribeCategoryIds');
        $deviceUser = AndroidDevice::find($androidDeviceId);

        $deviceUser->categories()->sync($categories->categoryIds);

        /*foreach ($categories->categoryIds as $categoryId) {
            $deviceUser->categories()->attach($categoryId);

        }*/
        return $this->responseConstructor
            ->setResultCode(200)
            ->setResultTitle("Success")
            ->respondWithError("Success");

    }

    public function getUserIdFromToken($ttoken)
    {
        $id = $this->auth->getPayload($ttoken)->get('sub');

        return $id;

    }

    /**
     * Method to retrieve token header from the access token
     * @param $token
     * @return mixed
     */
    public function retrieveTokenFromHeader($token)
    {

        $index = 1;

        $ttoken = explode(" ", $token);

        return $ttoken[$index];

    }
}