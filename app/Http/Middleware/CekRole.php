<?php

namespace App\Http\Middleware;

use App\Models\member;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id;
        $member= member::where("id",$id)->first();

        if(!$member){
            return response(["message" => "unauthenticate"]);
        }
        if($member->role != "admin"){
            return response([
                "message" => "unauthorize"
            ], 403);
        }
        return $next($request);
    }
}
