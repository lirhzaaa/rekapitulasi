<?php

use App\Http\Controllers\LatesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TampilData;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PsController;

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

// routes/web.php

Route::get('/error-permission', function(){
    return view('errors.permission');
})->name('errors.permission');

Route::middleware(['IsLogin'])->group(function(){
    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [TampilData::class, 'index'])->name('home');
    });
});
Route::middleware(['IsLogin', 'IsPs'])->group(function(){

    Route::prefix('/studentsPs')->name('students.')->group(function () {
        Route::get('/', [PsController::class, 'index'])->name('ps');
        // Route::get('/search', [PsController::class, 'search'])->name('search');
    });

    Route::prefix('/latestsPs')->name('latestsPs.')->group(function () {
        Route::get('/', [PsController::class, 'lates'])->name('home');
        Route::get('/rekap', [PsController::class, 'rekap'])->name('rekap');
        Route::get('/search', [PsController::class, 'search'])->name('search');
        Route::get('/detail/{id}', [PsController::class, 'show'])->name('detail');
        Route::get('/download/{id}', [PsController::class, 'downloadPDF'])->name('download');
    });

});

Route::middleware(['IsLogin', 'IsAdmin'])->group(function () {



    Route::prefix('/rombels')->name('rombels.')->group(function () {
        Route::get('/', [RombelsController::class, 'index'])->name('home');
        Route::get('/create', [RombelsController::class, 'create'])->name('create');
        Route::post('/store', [RombelsController::class, 'store'])->name('store');
        Route::get('/search', [RombelsController::class, 'search'])->name('search');
        Route::get('/{id}', [RombelsController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RombelsController::class, 'update'])->name('update');
        Route::delete('/{id}', [RombelsController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/rayons')->name('rayons.')->group(function () {
        Route::get('/', [RayonsController::class, 'index'])->name('home');
        Route::get('/create', [RayonsController::class, 'create'])->name('create');
        Route::post('/store', [RayonsController::class, 'store'])->name('store');
        Route::get('/search', [RayonsController::class, 'search'])->name('search');
        Route::get('/{id}', [RayonsController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RayonsController::class, 'update'])->name('update');
        Route::delete('/{id}', [RayonsController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/students')->name('students.')->group(function () {
        Route::get('/', [StudentsController::class, 'index'])->name('home');
        Route::get('/create', [StudentsController::class, 'create'])->name('create');
        Route::post('/store', [StudentsController::class, 'store'])->name('store');
        Route::get('/search', [StudentsController::class, 'search'])->name('search');
        Route::get('/{id}', [StudentsController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [StudentsController::class, 'update'])->name('update');
        Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('home');
        Route::get('/create', [UsersController::class, 'create'])->name('create');
        Route::post('/store', [UsersController::class, 'store'])->name('store');
        Route::get('/search', [UsersController::class, 'search'])->name('search');
        Route::get('/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UsersController::class, 'update'])->name('update');
        Route::delete('/{id}', [UsersController::class, 'destroy'])->name('delete');
    });


    Route::prefix('/latests')->name('latests.')->group(function () {
        Route::get('/', [LatesController::class, 'index'])->name('home');
        Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
        Route::get('/create', [LatesController::class, 'create'])->name('create');
        Route::post('/store', [LatesController::class, 'store'])->name('store');
        Route::get('/search', [LatesController::class, 'search'])->name('search');
        Route::get('/detail/{id}', [LatesController::class, 'show'])->name('detail');
        Route::get('/download/{id}', [LatesController::class, 'downloadPDF'])->name('download');
        Route::get('/{id}', [LatesController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LatesController::class, 'update'])->name('update');
        Route::delete('/{id}', [LatesController::class, 'destroy'])->name('delete');
    });



});

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UsersController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
Route::get('/export/excel', [LatesController::class,  'createExcel'])->name('export.excel');

