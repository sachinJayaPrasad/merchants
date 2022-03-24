<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\MerchantsController;

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

Route::get('/merchants', [MerchantsController::class, 'show']);
Route::get('/show-add-page', [MerchantsController::class, 'show_add_page'])->name('show_add_page');
Route::post('/add-merchants', [MerchantsController::class, 'add_merchants'])->name('add_merchants');
Route::post('/update-merchants/{_id}', [MerchantsController::class, 'update_merchants'])->name('update_merchants');
Route::get('/edit-merchant/{_id}', [MerchantsController::class, 'edit_merchant'])->name('edit_merchant');
Route::get('/delete-merchant/{id}', [MerchantsController::class, 'delete_merchant'])->name('delete_merchant');
