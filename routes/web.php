<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'member'], function () {
    Route::get('index', [MemberController::class, 'index'])->name('member.index');
    Route::get('create', [MemberController::class, 'create'])->name('member.create'); 
    Route::post('store', [MemberController::class, 'store'])->name('member.store'); 
    Route::get('show/{id}', [MemberController::class, 'show'])->name('member.show'); 
    Route::get('edit/{id}', [MemberController::class, 'edit'])->name('member.edit'); 
    Route::post('update/{id}', [MemberController::class, 'update'])->name('member.update'); 
    Route::post('destroy/{id}', [MemberController::class, 'destroy'])->name('member.destroy'); 
    Route::get('search', [MemberController::class, 'search'])->name('member.search'); 
});