<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;



Route::get('/testapi', function () {
    return response()->json(['message' => 'passou']);
});

Route::prefix('auth')->group(function () {
    Route::middleware('apiJWT')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/{id}', [AuthController::class, 'update']);
    Route::delete('/{id}', [AuthController::class, 'delete']);
});
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/password/reset-request', [AuthController::class, 'sendResetEmail']);
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);
    Route::post('/queda-de-preço', [AuthController::class, 'offerAlert']);    

});

Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class, 'create']);
    Route::get('/', [UserController::class, 'index']);
});






