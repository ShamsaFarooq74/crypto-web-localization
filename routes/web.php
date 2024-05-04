<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\BinanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     $plans = Plan::all();
//     $privacies = Privacy::get();
//     return view('welcome', compact('plans', 'privacies'));
// });

// Route::get('/home/{locale}', function (string $locale) {
//     if (!in_array($locale, ['en', 'ar'])) {
//         abort(400);
//     }

//     App::setLocale($locale);

//     $plans = Plan::all();
//     $privacies = Privacy::get();
//     return view('welcome', compact('plans', 'privacies'));
// });

Route::get('/', [HomeController::class, 'show']);
Route::get('/home/{locale}', [HomeController::class, 'locale']);

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('logout-user', [HomeController::class, 'logout'])->name('logout-user');
Route::post('authenticate-login', [HomeController::class, ' authenticate_login'])->name(' authenticate-login');
Route::post('user-register', [HomeController::class, 'user_register'])->name('user-register');

Route::get('lang/change', [HomeController::class, 'change'])->name('changeLang');

 Route::get('binance-payment/{id}', [BinanceController::class, 'BinancePay'])->name('binance.payment.{id}');
 Route::get('binance-success', [BinanceController::class, 'success'])->name('binance.success');
 Route::get('binance-duration', [BinanceController::class, 'duration'])->name('binance.duration');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('admin', AdminController::class);
    // Route::resource('user', UserController::class);
    // Route::get('user-status', [UserController::class, ('userStatus')])->name('user.status');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('plans', [PlanController::class, 'index'])->name('plan.index');
    Route::resource('plan', PlanController::class);
    Route::get('plan-status', [PlanController::class, 'planStatus'])->name('plan.status');

    Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
    Route::get('manage-users', [AdminController::class, 'manage_users'])->name("manage-users");

    Route::get('privacy-policy', [PrivacyController::class, 'privacy_policy'])->name("privacy-policy");

    Route::get('privacy-create', [PrivacyController::class, 'create'])->name("privacy-create");

    Route::post('privacy-store', [PrivacyController::class, 'store'])->name("privacy-store");

    Route::delete('privacy-destroy/{id}', [PrivacyController::class, 'destroy'])->name("privacy-destroy");

    Route::get('privacy-edit/{id}', [PrivacyController::class, 'edit'])->name("privacy-edit");

    Route::put('privacy-update/{id}', [PrivacyController::class, 'update'])->name("privacy-update");

    Route::get('privacy_status', [PrivacyController::class, 'status'])->name('privacy_status');

    Route::resource('term', TermController::class);
    Route::get('term-status', [TermController::class, 'status'])->name('term.status');

});
