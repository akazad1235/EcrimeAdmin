<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliceStationController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\CriminalController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\Api\userController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\testController;
use App\Http\Controllers\NationalIDController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserFeedbackController;


use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });




// Route::get('/station', [PoliceStationController::class, 'index']);

// Route::post('/station', [PoliceStationController::class, 'store']);



Auth::routes(['register' => false]);


Route::group(['middleware' => 'admin', 'middleware' => 'auth',], function(){

            
        //station is creating the group
        Route::prefix('policeStation')->name('station.')->group(function () {

            Route::get('/station', [PoliceStationController::class, 'index'])->name('index');
            Route::get('/getform', [PoliceStationController::class, 'create'])->name('create');
            Route::post('/station', [PoliceStationController::class, 'store'])->name('store');
            Route::get('/getdata/{id}', [PoliceStationController::class, 'edit'])->name('edit');
            Route::post('/dataUpdate/{id}', [PoliceStationController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [PoliceStationController::class, 'destroy'])->name('delete');
        });

        //station is creating the group
        Route::prefix('district')->name('district.')->group(function () {

            Route::get('/showAll', [DistrictController::class, 'index'])->name('index');
            Route::get('/district', [DistrictController::class, 'create'])->name('create');
            Route::post('/district', [DistrictController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DistrictController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [DistrictController::class, 'destroy'])->name('delete');
            
        });

        //criminals is create the group
        Route::prefix('criminals')->name('criminals.')->group(function () {

            Route::get('/index', [CriminalController::class, 'index'])->name('index');
            Route::get('/create', [CriminalController::class, 'create'])->name('create');
            Route::post('/store', [CriminalController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CriminalController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CriminalController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [CriminalController::class, 'destroy'])->name('delete');
            

        });

        //Coplain is create the group
        Route::prefix('complain')->name('complain.')->group(function () {

            Route::get('/index', [ComplainController::class, 'index'])->name('index');
            Route::get('/details/{id}', [ComplainController::class, 'show'])->name('details');
           // Route::get('/show', [ComplainController::class, 'show']); 
        });

       // Users is create the group
        Route::prefix('users')->name('users.')->group(function () {

            Route::get('/index', [AdminController::class, 'index'])->name('index');
            Route::get('/create', [AdminController::class, 'create'])->name('create');
            Route::post('/store', [AdminController::class, 'store'])->name('store');
        
        });

         //Users profiles is create the group
         Route::prefix('profile')->name('profile.')->group(function () {

            Route::get('/index', [ProfileController::class, 'index'])->name('index');
            Route::get('/index', [ProfileController::class, 'index'])->name('index');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
 
        });
          //National DI create the group
          Route::prefix('nid')->name('nid.')->group(function () {

            Route::get('/index', [NationalIDController::class, 'index'])->name('index');
            Route::post('/store', [NationalIDController::class, 'store'])->name('store');
 
        });
        //Addmin Feedback to Your create the group
        Route::prefix('feedback')->name('feedback.')->group(function () {

            Route::get('/index', [UserFeedbackController::class, 'index'])->name('index');
            Route::get('/get', [UserFeedbackController::class, 'store']);
            Route::put('/update/{id}', [UserFeedbackController::class, 'update']);
            //Route::post('/store', [FeedbackController::class, 'store'])->name('store');
 
        });
  
        //use router
        Route::get('/', [HomeController::class, 'dashboard']);
        Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('/home', [HomeController::class, 'dashboard']);
    });

});


//for api
Route::get('/criminals', [testController::class, 'criminals']);
Route::get('/addComplian', [testController::class, 'createComplain']);
Route::get('/storeComplain', [testController::class, 'storeComplain']);

//create a new complain
Route::post('/storeComplain', [testController::class, 'storeComplain']);

Route::get('/verified/{id}/token/{verification_code}', [userController::class, 'verifyAcc'])->name('verify-code');

//Route::post('/register ', [UserRegistrationController::class, 'store']);



Route::get('/details', [ComplainController::class, 'details']);
Route::get('/updateStatus', [ComplainController::class, 'updateStatus']);
Route::get('/updateId', [ComplainController::class, 'updateId']);










