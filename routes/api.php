<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\criminalApiController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\Api\VerifyRegistrationController;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\userComplainController;
use App\Http\Controllers\Api\userUpdateController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\CommentsController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('complainStor', testController::class);
Route::resource('allComplians', testController::class); 

Route::resource('/criminals', criminalApiController::class);

//User Register
Route::resource('/register', UserRegistrationController::class);
Route::resource('/verifyEmail', VerifyRegistrationController::class);

Route::resource('/users', userController::class);

//user complain
Route::resource('/complain', userComplainController::class);
Route::resource('/updateProfile', userUpdateController::class);

//user feedback
Route::resource('/feedback', FeedbackController::class);

//user comments
Route::resource('/comments', CommentsController::class);


//user Registration

