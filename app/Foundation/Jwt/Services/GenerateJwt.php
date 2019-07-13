<?php

namespace App\Foundation\Jwt\Services;

use App\User;
use Carbon\Carbon;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class GenerateJwt
 *
 * Generate a jwt for a user.
 *
 * @package App\Foundation\Jwt\Services
 */
class GenerateJwt
{
    /**
     * Generate a jwt for a user
     *
     * @param User $user
     * @return array ['token' => '', 'refresh' =>'']
     */
    public function handle(User $user) : array
    {
        try {
            $jwtAuth = resolve(JWTAuth::class);
            $token = $jwtAuth->fromUser($user);
            $refresh = $jwtAuth->claims([
                'rft' => true,
                'exp' => Carbon::now()->addDay(15)
            ])->fromUser($user);
            return [
                'token' => $token,
                'refresh' => $refresh
            ];
        } catch (JWTException $e) {
            logger($e->getMessage());
            return [
                'token' => '',
                'refresh' => ''
            ];
        }
    }
}