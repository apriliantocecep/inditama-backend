<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Inditama API Documentation",
     *      description="Developer test description",
     *      @OA\Contact(
     *          email="cecepaprilianto@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API Server"
     * )

     *
     * @OA\Tag(
     *     name="Authentication",
     *     description="API Endpoints of Authentication"
     * )
    */

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @OA\Get(
     *      path="/login",
     *      operationId="loginAuth",
     *      tags={"Authentication"},
     *      summary="Login",
     *      description="Login to application",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Wrong Email or Password!",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
    */
    public function login(\App\Http\Requests\LoginRequest $request)
    {
        if (!$token = auth('api')->attempt($request->validated())) {
            return \App\Helper\ResponseHelper::error([
                'message' => 'Wrong Email or Password!'
            ], 200);
        }

        $content = \App\Helper\JWTHelper::createNewToken($token);

        return \App\Helper\ResponseHelper::ok($content);
    }

    public function register(\App\Http\Requests\RegisterRequest $request)
    {
        $user = \App\Models\User::create(array_merge($request->validated(), [
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]));

        return \App\Helper\ResponseHelper::ok([
            'message' => 'User successfully registered',
            'user' => $user
        ]);
    }

    public function logout()
    {
        auth('api')->logout();
        return \App\Helper\ResponseHelper::ok([
            'message' => 'User successfully signed out',
        ]);
    }

    public function profile()
    {
        return \App\Helper\ResponseHelper::ok([
            'user' => auth('api')->user(),
        ]);
    }
}
