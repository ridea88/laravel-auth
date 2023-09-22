<?php

namespace App\Http\Middleware;

use App\Models\member;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CekToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header("Authorization");

        if(!$token){
            return response(["message" => "unauthenticate"],401);
        }

        $jwt_token = explode(" ",$token)[1];
        $key = env("JWT_SECRET");

        $hash = "HS256";
        $payload = JWT::decode($jwt_token, new Key($key,$hash));

        $member = member::where("id",$payload->id)->first();
        
        if(!$member){
            return response(["message" => "unauthenticate"],401);
        }

        $request["id"]=$member->id;
        return $next($request);
    }
}
