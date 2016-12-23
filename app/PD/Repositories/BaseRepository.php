<?php
/**
 * Created by PhpStorm.
 * User: Hash
 * Date: 13-08-2015
 * Time: 21:49
 */

namespace PD\Repositories;



use App\AndroidDevice;
use App\Exceptions\ResponseConstructor;
use PD\Utilities\StringConstants;
use Exception;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

abstract class BaseRepository {

    protected $errorCodes;
    /**
     * @var JWTAuth
     */
    protected $auth;

    public function __construct(JWTAuth $auth,ResponseConstructor $errorCodes){
        $this->errorCodes = $errorCodes;
        $this->auth = $auth;
    }

    /**
     * Method for creating genric record for registration in DB
     * @param CustomModel $model
     * @return mixed
     */
    protected function createGenericRecord(AndroidDevice $model){

        try{
            $model->deviceId   = Input::get(StringConstants::DEVICEID);


            $androidDevice = AndroidDevice::where('deviceId',$model->deviceId)->first();

            if(count($androidDevice)==1) {
                /*OrCreate(['deviceId'=>
                    $model->deviceId,'pushRegId'=>Input::get(StringConstants::PUSHREGID),'deviceType'=>Input::get(StringConstants::DEVICETYPE)
                ,'osType'=>Input::get(StringConstants::OSTYPE),'osVersion'=>Input::get(StringConstants::OSVERSION)
                ,'deviceModelName'=> Input::get(StringConstants::DEVICEMODELNAME)]);*/

                $androidDevice->deviceId = $model->deviceId;

                $androidDevice->pushRegId = Input::get(StringConstants::PUSHREGID);

                $androidDevice->deviceType = Input::get(StringConstants::DEVICETYPE);

                $androidDevice->osType = Input::get(StringConstants::OSTYPE);

                $androidDevice->osVersion = Input::get(StringConstants::OSVERSION);

                $androidDevice->deviceModelName = Input::get(StringConstants::DEVICEMODELNAME);

                $androidDevice->appVersion =  Input::get(StringConstants::APPVERSION);

                $androidDevice->update();
            }else{

                $androidDevice = new AndroidDevice();

                $androidDevice->deviceId = $model->deviceId;

                $androidDevice->pushRegId = Input::get(StringConstants::PUSHREGID);

                $androidDevice->deviceType = Input::get(StringConstants::DEVICETYPE);

                $androidDevice->osType = Input::get(StringConstants::OSTYPE);

                $androidDevice->osVersion = Input::get(StringConstants::OSVERSION);

                $androidDevice->deviceModelName = Input::get(StringConstants::DEVICEMODELNAME);

                $androidDevice->appVersion =  Input::get(StringConstants::APPVERSION);

                $androidDevice->save();


            }

        } catch (Exception $e) {

            throw new Exception($e->getMessage(),"500");//response()->json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);

        }

        $accessToken = $this->auth->fromUser($androidDevice);

        return response()->json([
            'accessToken' => $accessToken
        ] ,200);

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