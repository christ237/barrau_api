<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContributionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them wills
| be assigned to the "api" middleware group. Make something great!
|
*/



// Contributions

Route::post('/contributions', [ContributionController::class, 'store']);

// Public routes

Route::post('/register', [AdminController::class, 'register']);
Route::post('/login', [AdminController::class, 'login']);


Route::post('/lawyers/lawyerByLocation', [LawyerController::class, 'lawyertown']);
Route::post('/lawyers/updatePassword', [LawyerController::class, 'updatePassword']);
Route::post('/lawyers/update', [LawyerController::class, 'update']);

Route::post('/lawyers/profile', [LawyerController::class, 'show']);
Route::post('/lawyers/contributions', [LawyerController::class, 'contributions']);
Route::get('/lawyers', [LawyerController::class, 'index']);

Route::get('/searchLawyers', [LawyerController::class, 'getAll']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/lawyers', [LawyerController::class, 'store']);
});

Route::put('/lawyers/{id}', [LawyerController::class, 'update']);
Route::post('/lawyers/payments', [PaymentController::class, 'store']);


// Lawyers

// Login
Route::post('/lawyers/login', [LawyerController::class, 'login']);
Route::post('/lawyers/getLawyer', [LawyerController::class, 'getProfile']);
Route::post('/lawyers/checkPassword', [LawyerController::class, 'checkPassword']);

// Security
Route::post('/lawyers/grantLinkAccess', [LawyerController::class, 'grantLinkAccess']);
Route::post('/lawyers/cardLost', [LawyerController::class, 'cardLost']);



// Update fields
Route::post('/lawyers/update/phone', [LawyerController::class, 'updateLawyerPhone']);
Route::post('/lawyers/update/email', [LawyerController::class, 'updateLawyerEmail']);
Route::post('/lawyers/update/address', [LawyerController::class, 'updateLawyerAddress']);
Route::post('/lawyers/update/image', [LawyerController::class, 'updateLawyerPhoto']);
Route::post('/lawyers/search', [LawyerController::class, 'search']);

Route::post('/lawyers/image', [LawyerController::class, 'upload']);


Route::get('/navigate/{id}', function() {

  });


  Route::get('/mobile', function() {

  });




Route::post('/attestation', [LawyerController::class, 'getAttestation']);
