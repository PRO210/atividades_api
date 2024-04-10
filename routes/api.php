<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
  return response()->json(['message' => 'ok']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

// Route::apiResource('/users', ProfileController::class);

Route::group(
  ['prefix' => 'v1'],
  function () {

    // Route::post('/users/store', [RegisterController::class, 'store']);
    // Route::get('/users/edit/{uuid}', [RegisterController::class, 'edit']);
    // Route::patch('/users/update', [RegisterController::class, 'update']);
    // Route::delete('/users/destroy/{uuid}', [RegisterController::class, 'destroy']);

    // Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
  }
);

// Route::get('/users', 'UserController@index')->middleware('auth:api');

Route::apiResource('/users', ProfileController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('user/profile/update-password', [AuthController::class, 'upPassword']);

Route::patch('user/profile/update', [AuthController::class, 'update']);
Route::get('user/profile/edit/{uuid}', [AuthController::class, 'edit']);

Route::delete('user/destroy/{uuid}', [AuthController::class, 'destroy']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

Route::post('forgot', [NewPasswordController::class, 'store']);
Route::post('reset', [NewPasswordController::class, 'reset']);

Route::post('mp/create_preference', [MercadoPagoController::class, 'create_preference']);
Route::post('mp/webhook', [MercadoPagoController::class, 'webhook']);
Route::get('mp/storePayment', [MercadoPagoController::class, 'storePayment']);


//http://larafood/api/v1/tenants
//http://larafood/api/v1/tenants
//http://larafood/api/v1/tenants?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
//http://larafood/api/v1/orders
//http://larafood/api/v1/orders?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
//http://larafood/api/v1/tables?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
//http://larafood/api/v1/tables?token_company=14e500e2-05a5-45af-a603-05c2df3ea4d8
