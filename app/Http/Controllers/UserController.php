<?php namespace App\Http\Controllers;

use App\Exceptions\ResponseConstructor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PD\Users\UsersRepository;


class UserController extends ApiController {



	protected $user,$request;
	/**
	 * @var ResponseConstructor
	 */
	private $responseConstructor;

	/**
	 * @param UsersRepository|CNUserInterface|CNUsersRepository $cnuser
	 * @param Request $request
	 * @param ResponseConstructor $responseConstructor
	 * @internal param Guard $auth
	 */
	public function __construct(UsersRepository $user,Request $request,ResponseConstructor $responseConstructor){

		$this->request=$request;
		$this->user = $user ;
		$this->responseConstructor = $responseConstructor;
		$this->middleware('jwt.auth', ['except' => array('registerUser')]);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @return Response
	 * @internal param RegisterRequest $request
	 */
	public function registerUser()
	{

		return $this->user->createUser();

	}

}
