<?php

use App\Http\Controllers\CouponVerificationController;
use App\Http\Controllers\RefundController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/authentifier-ticket', [CouponVerificationController::class, 'create'])
    ->name('ticket.authenticate');

Route::get('/authentifier-ticket/traitement', [CouponVerificationController::class, 'processing'])
    ->name('ticket.processing');

Route::post('/authentifier-ticket', [CouponVerificationController::class, 'store'])
    ->name('ticket.authenticate.submit');

Route::get('/remboursement', [RefundController::class, 'create'])
    ->name('refund');

Route::get('/remboursement/traitement', [RefundController::class, 'processing'])
    ->name('refund.processing');

Route::post('/remboursement', [RefundController::class, 'store'])
    ->name('refund.submit');

Route::view('/conditions-utilisation', 'legal.terms')->name('legal.terms');
Route::view('/politique-confidentialite', 'legal.privacy')->name('legal.privacy');
Route::view('/faq', 'legal.faq')->name('legal.faq');
Route::view('/nous-connaitre', 'legal.about')->name('legal.about');
