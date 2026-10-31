<?php

namespace App;

use App\Models\Rent;
use App\Models\Room;
use App\Models\Building;
use App\Models\BackgroundUtamaPhoto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DaftarRuangController;
use App\Http\Controllers\DaftarPinjamController;
use App\Http\Controllers\DashboardRentController;
use App\Http\Controllers\DashboardRoomController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TemporaryRentController;
use App\Http\Controllers\BackgroundFotoController;
use App\Http\Controllers\DashboardAdminController;

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
    $backgroundPhotos = BackgroundUtamaPhoto::all();
    return view('index', [
        'title' => 'Home',
        'active' => 'login',
        'backgroundPhotos' => $backgroundPhotos
    ]);
})->middleware('checkRoleForHome');  // Menambahkan middleware untuk cek role_id


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/overview', function () {
        return view('/dashboard/overview/index', [
            'title' => "Dashboard Admin",
        ]);
    });

    Route::middleware(['checkRole'])->group(function () {
        
        Route::get('/dashboard/temporaryRents', [TemporaryRentController::class, 'index']);
        Route::get('/dashboard/temporaryRents/{id}/acceptRents', [TemporaryRentController::class, 'acceptRents']);
        Route::get('/dashboard/temporaryRents/{id}/declineRents', [TemporaryRentController::class, 'declineRents']);
        Route::resource('dashboard/rents', DashboardRentController::class);
        Route::resource('dashboard/rooms', DashboardRoomController::class);
        Route::put('/dashboard/rooms/{id}', [DashboardRoomController::class, 'update'])->name('dashboard.rooms.update');
        Route::delete('/dashboard/rooms/{room}', [DashboardRoomController::class, 'destroy'])->name('dashboard.rooms.destroy');

        Route::resource('dashboard/users', DashboardUserController::class);
        Route::resource('dashboard/admin', DashboardAdminController::class);
        Route::resource('/daftarpinjam', DashboardRentController::class);
        Route::put('dashboard/admin/{id}', [DashboardUserController::class, 'update'])->name('dashboard.admin.update');
        Route::put('dashboard/users/{id}', [DashboardUserController::class, 'update'])->name('dashboard.users.update');

        Route::get('dashboard/users/{id}/makeAdmin', [DashboardUserController::class, 'makeAdmin']);
        Route::get('dashboard/admin/{id}/removeAdmin', [DashboardAdminController::class, 'removeAdmin']);
        Route::post('/dashboard/rents/export-pdf', [DashboardRentController::class, 'exportPDF'])->name('export-pdf');
        Route::get('/dashboard/rooms/{room:name}', [DashboardRoomController::class, 'show']);

        Route::get('/dashboard/backgroundFoto', [BackgroundFotoController::class, 'index']);
        Route::get('/background', [BackgroundFotoController::class, 'index'])->name('background.index');
        
        Route::get('/background/utama/create', [BackgroundFotoController::class, 'createUtama'])->name('background.createUtama');
        Route::post('/background/utama', [BackgroundFotoController::class, 'storeUtama'])->name('background.storeUtama');
        
        Route::get('/background/login/create', [BackgroundFotoController::class, 'createLogin'])->name('background.createLogin');
        Route::post('/background/login', [BackgroundFotoController::class, 'storeLogin'])->name('background.storeLogin');
        
        Route::get('/background/utama/{id}/edit', [BackgroundFotoController::class, 'editUtama'])->name('background.editUtama');
        Route::put('/background/utama/{id}', [BackgroundFotoController::class, 'updateUtama'])->name('background.updateUtama');
        
        Route::get('/background/login/{id}/edit', [BackgroundFotoController::class, 'editLogin'])->name('background.editLogin');
        Route::put('/background/login/{id}', [BackgroundFotoController::class, 'updateLogin'])->name('background.updateLogin');

        Route::get('/background/admin/{id}/edit', [BackgroundFotoController::class, 'editAdmin'])->name('background.editAdmin');
        Route::put('/background/admin/{id}', [BackgroundFotoController::class, 'updateAdmin'])->name('background.updateAdmin');
        
        Route::delete('/background/utama/{id}', [BackgroundFotoController::class, 'destroyUtama'])->name('background.destroyUtama');
        Route::delete('/background/login/{id}', [BackgroundFotoController::class, 'destroyLogin'])->name('background.destroyLogin');
        Route::delete('/background/admin/{id}', [BackgroundFotoController::class, 'destroyAdmin'])->name('background.destroyAdmin');

        Route::get('/background/admin/create', [BackgroundFotoController::class, 'createAdmin'])->name('background.createAdmin');
        Route::post('/background/admin', [BackgroundFotoController::class, 'storeAdmin'])->name('background.storeAdmin');
        
        Route::get('dashboard/jadwalrapat', [RentController::class, 'showData']);
        
        Route::get('/api/schedule/today', [RentController::class, 'getTodaySchedule']);
        Route::get('/api/schedule/upcoming', [RentController::class, 'getUpcomingSchedule']);
        });
    Route::resource('/daftarpinjam', DashboardRentController::class);   
    Route::get('/daftarruang', [DaftarRuangController::class, 'index']);
    Route::get('/showruang/{room:name}', [DaftarRuangController::class, 'show']);
    Route::get('/daftarpinjam', [DaftarPinjamController::class, 'index'])->name('daftarpinjam');
    Route::post('/logout', [LoginController::class, 'logout']);
    

});



