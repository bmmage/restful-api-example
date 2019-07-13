<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Foundation\Jwt\Services\GenerateJwt;
use App\Transformers\JwtUserTransformer;
use App\Http\Requests\Jwt\JwtAuthorizeRequest;

/**
 * This controller is used to get the token required for the api routes.
 * It will also handle refreshing and black listing
 *
 * Class JwtController
 * @package App\Http\Controllers\Auth
 */
class JwtController extends Controller
{
    /**
     * Jwt Generator with refresh
     * @var GenerateJwt
     */
    private $jwtGenerator;

    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    /**
     * JwtController constructor.
     * @param GenerateJwt $generator
     */
    public function __construct(GenerateJwt $generator, JWTAuth $jwt)
    {
        $this->jwtGenerator = $generator;
        $this->jwtAuth = $jwt;
    }

    /**
     * Create a new JWT for authorization on our other routes.
     * @param JwtAuthorizeRequest $request
     * @return string
     */
    public function createAuthorizationToken(JwtAuthorizeRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            $tokens = $this->jwtGenerator->handle(Auth::user());
            $user = Auth::user();
            $user->token = $tokens['token'];
            $user->refresh = $tokens['refresh'];
            return resolve(JwtUserTransformer::class)->transform($user);
        }
        return response('Not Found', 404);
    }
}
