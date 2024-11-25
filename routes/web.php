<?php

use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryProdukController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_store'])->name('register.store');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_store'])->name('login.store');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
   Route::resource('produks', ProdukController::class); 
   Route::resource('category_produks', CategoryProdukController::class); 
   Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile.index');
    
    Route::get('export', function (Request $request) {
        // dd($request->all());
        $filters = [
            'category_selected' => $request->category_selected,
            'search_selected' => $request->search_selected,
        ];
    
        return Excel::download(new ProdukExport($filters), 'produk_filtered.xlsx');
    })->name('produks.export');
});