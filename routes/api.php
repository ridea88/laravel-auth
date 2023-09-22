<?php

use App\Http\Controllers\MemberController;
use App\Http\Middleware\CekRole;
use App\Http\Middleware\CekToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/member/register",[MemberController::class,"register"]);
Route::post("/member/login",[MemberController::class,"login"]);
Route::get("/member/report",[MemberController::class,"report"])->middleware([CekToken::class,CekRole::class]);
Route::get("/member/profile",[MemberController::class,"profile"])->middleware([CekToken::class]);
