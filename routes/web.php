<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\HomeController;
use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

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

Route::view('/login','users.login')->name('login');
Route::view('/register','users.register')->name('register');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::post('/do-login',[UserController::class,'login'])->name('do-login');
Route::post('/do-register',[UserController::class,'register'])->name('do-register');

Route::middleware('auth')->get('/',[PictureController::class,'home'])->name('home');
Route::middleware('auth')->post('/save-picture',[PictureController::class,'saveAjax'])->name('save-picture');
Route::middleware('auth')->get('/picture/{picture}',[PictureController::class,'getPicture'])->name('get-picture');
Route::middleware('auth')->delete('/remove-picture',[PictureController::class,'removePicture'])->name('remove-picture');

Route::get("/ajax", function()
{
    return view('ajax');
});
Route::get("/search", [HomeController::class, "search"]);

Route::get('/sendmail/{email}/{domain}', function ($email, $domain) {
    $mailaddress = $email ."@" .$domain;
    echo $mailaddress;
    $response = Mail::to($mailaddress)->send(new Notification(''));
    echo $response;
    if($response == null)
    {
        echo "<script>window.close();</script>";
    }
    else
    {
        echo "no";
    }
    dump($response);
    dd("Email is Sent.");
});

Route::view('/recuperar', 'users.changepassword')->name('recuperar');
