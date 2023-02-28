<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Products;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/product', Products::class);
Route::get('/success', [Products::class,'success'])->name('checkout.success');
Route::get('/cancel', [Products::class,'cancel'])->name('checkout.cancel');