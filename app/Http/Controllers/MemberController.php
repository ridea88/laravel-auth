<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  Firebase\JWT\JWT;  

class MemberController extends Controller
{
    public function register(Request $request){

        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $role = $request->role;

        $newMember = member::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "role" => $role
        ]);

        return response([
            "message" =>"success",
            "data" => $newMember
        ], 201
    );
    }



    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        $member = member::where("email",$email)->first();

        if(!$member){
            return response([
                "message" => "email atau password salah"
            ], 401);
        }

        if(!Hash::check($password, $member->password)){
            return response([
                "message" => "email atau password salah"
            ], 401);
        }

        $key = env("JWT_SECRET");
        $payload = [
            "id" => $member->id,
            "iat" => time()
        ];

        $hash = "HS256";
        $token = JWT::encode($payload, $key,$hash);
        return response(["message"=>"login berhasil",
                         "data" => $token]);
    }

    public function profile(Request $request){

        $member= member::where("id",$request->id)->first();
        return response([
            "message" => "ini endpoint",
            "data" => $member
        ]);
    }

    public function report(){
        return response([
            "message" => "ini endpoint report"
        ]);
    }
}
