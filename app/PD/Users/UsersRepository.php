<?php
/**
 *
 * User: MVB
 * Date: 25-06-2015
 * Time: 16:12
 */

namespace PD\Users;


use App\AndroidDevice;
use Exception;
use PD\Repositories\BaseRepository;
use App\Exceptions\ResponseConstructor;
use Tymon\JWTAuth\JWTAuth;

class UsersRepository extends BaseRepository
{
    protected $auth, $responseConstructor;

    /**
     * @param JWTAuth $auth
     * @param ResponseConstructor $responseConstructor
     */
    public function __construct(JWTAuth $auth, ResponseConstructor $responseConstructor)
    {
        $this->auth = $auth;
        $this->responseConstructor = $responseConstructor;
    }

    /**
     * Register new user be it student or lecturer
     */
    public function createUser()
    {
        try {
            return parent::createGenericRecord(new AndroidDevice());
        }catch (Exception $e){
            return $this->responseConstructor->setResultCode(404)
                ->setResultTitle("Invalid Credentials")
                ->respondWithError($e->getMessage());
        }
    }
}