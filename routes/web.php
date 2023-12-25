<?php

use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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




Route::get('/', [MainController::class,'index'])->name('main.index');//✓
Route::get('/currency_edit/{currency_id}', [MainController::class,'currency_edit'])->name('main.currency_edit');//update: post//✓
Route::put('/currency_edit/{currency_id}', [MainController::class,'currency_update'])->name('main.currency_update');//update: post//✓
Route::get('/categories', [MainController::class,'categories'])->name('main.categories');//✓

Route::get('/incomes_category_create', [MainController::class,'incomes_create'])->name('main.incomes_create');//save: post//✓
Route::get('/outcomes_category_create', [MainController::class,'outcomes_create'])->name('main.outcomes_create');//✓
Route::post('/incomes_category_create', [MainController::class,'incomes_save'])->name('main.incomes_save');//save: post//✓
Route::post('/outcomes_category_create', [MainController::class,'outcomes_save'])->name('main.outcomes_save');//✓


Route::post('/income_random_create/{wallet_id}',[WalletController::class,'save_random_income'])->name('wallet.save_random_income');//save random income//✓
Route::post('/outcome_random_create/{wallet_id}',[WalletController::class,'save_random_outcome'])->name('wallet.save_random_outcome');//save random outcome//✓




Route::get('/wallet/{id}', [WalletController::class,'wallet_main'])->name('wallet.main')->where('id','[0-9]+');;
Route::get('/transfer_create/{current_wallet_id}', [WalletController::class,'transfer_create'])->name('wallet.transfer_create')->where('current_wallet_id','[0-9]+');
Route::post('/transfer_create/{current_wallet_id}',[WalletController::class,'transfer_save'])->name('wallet.transfer_save')->where('current_wallet_id','[0-9]+');
Route::get('/wallet/create',[WalletController::class,'create_wallet'])->name('wallet.create');
Route::post('/wallet/create',[WalletController::class,'save_wallet'])->name('wallet.save');




// Route::post('/posts/{post_id?}/attach_tag/',[PostController::class,'attach_tag'])->name('posts.attach_tag');




// Route::get('/', function () {
//     return 'test2';
// });

// Route::get('/test',function (){
//     return 'test';
// });


