<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PTJController;
use App\Http\Controllers\PTJKPController;
use App\Http\Controllers\PTKController;
use App\Http\Controllers\KJBTController;
use App\Http\Controllers\KPTKWController;
use App\Http\Controllers\KPTJKPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminStaffController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role == 'ptj') {
        return redirect()->route('dashboard.ptj');
    } elseif ($user->role == 'ptjkp') {
        return redirect()->route('dashboard.ptjkp');
    } elseif ($user->role == 'ptk') {
        return redirect()->route('dashboard.ptk');
    } elseif ($user->role == 'kjbt') {
        return redirect()->route('dashboard.kjbt');
    } elseif ($user->role == 'kptjkp') {
        return redirect()->route('dashboard.kptjkp');
    } elseif ($user->role == 'kptkw') {
        return redirect()->route('dashboard.kptkw');
    } elseif ($user->role == 'pkkp') {
        return redirect()->route('dashboard.pkkp');
    } elseif ($user->role == 'pkk') {
        return redirect()->route('dashboard.pkk');
    } elseif ($user->role == 'admin') {
        return redirect()->route('dashboard.admin');
    } else {
        abort(403, 'Unauthorized.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])->name('dashboard.admin');

    
//tunjuk form
Route::get('/admin/staff/create', [AdminStaffController::class, 'create'])->name('admin.staff.create');
//proses form
Route::post('/admin/staff/store', [AdminStaffController::class, 'store'])->name('admin.staff.store');
Route::get('/admin/staff/{id}/edit', [AdminStaffController::class, 'edit'])->name('admin.staff.edit');
Route::put('/admin/staff/{id}', [AdminStaffController::class, 'update'])->name('admin.staff.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard/ptj', [DashboardController::class, 'dashboardPtj'])->name('dashboard.ptj');
Route::get('/dashboard/ptjkp', [DashboardController::class, 'dashboardPtjkp'])->name('dashboard.ptjkp');
Route::get('/dashboard/ptk', [DashboardController::class, 'dashboardPtk'])->name('dashboard.ptk');
Route::get('/dashboard/kjbt', [DashboardController::class, 'dashboardKjbt'])->name('dashboard.kjbt');
Route::get('/dashboard/kptkw', [DashboardController::class, 'dashboardKptkw'])->name('dashboard.kptkw');
Route::get('/dashboard/kptjkp', [DashboardController::class, 'dashboardKptjkp'])->name('dashboard.kptjkp');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ptj/create', [PTJController::class, 'create'])->name('ptj.create');
    Route::post('/ptj/create', [PTJController::class, 'store'])->name('ptj.store');
    Route::get('/ptj/show', [PTJController::class, 'show'])->name('ptj.show');
    Route::get('/ptj/{id}/edit', [PTJController::class, 'edit'])->name('ptj.edit');
    Route::put('/ptj/{id}', [PTJController::class, 'update'])->name('ptj.update');
    Route::delete('/ptj/{id}', [PTJController::class, 'destroy'])->name('ptj.destroy');
    
});
Route::middleware(['auth'])->group(function () {
Route::get('/ptjkp', [PTJKPController::class, 'index'])->name('ptjkp.dashboard');
Route::get('/ptjkp/{id}/show', [PTJKPController::class, 'show'])->name('ptjkp.show');
Route::post('/ptjkp/tuntutan/{id}/semak', [PTJKPController::class, 'semak'])->name('ptjkp.tuntutan.semak');
Route::post('/ptjkp/tuntutan/{id}/tidak-lengkap', [PTJKPController::class, 'tidakLengkap'])->name('ptjkp.tuntutan.tidakLengkap');

});
Route::middleware(['auth'])->group(function () {
Route::get('/ptk', [PTKController::class, 'index'])->name('ptk.dashboard');
Route::get('/ptk/{id}/show', [PTKController::class, 'show'])->name('ptk.show');
Route::post('/ptk/tuntutan/{id}/lulus', [PTKController::class, 'lulus'])->name('ptk.tuntutan.lulus');
Route::post('/ptk/tuntutan/{id}/tidak-lengkap', [PTKController::class, 'tidakLengkap'])->name('ptk.tuntutan.tidakLengkap');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/kjbt', [KJBTController::class, 'index'])->name('kjbt.dashboard');
    Route::get('/kjbt/show', [KJBTController::class, 'show'])->name('kjbt.show');
    Route::post('/kjbt/tuntutan/{id}/sahkan', [KJBTController::class, 'sahkan'])->name('kjbt.tuntutan.sahkan');
    Route::post('/kjbt/tuntutan/{id}/tidak-lengkap', [KJBTController::class, 'tidakLengkap'])->name('kjbt.tuntutan.tidakLengkap');
    Route::get('/kjbt/export/pdf', [KJBTController::class, 'exportPDF'])
    ->name('kjbt.export.pdf');

    
    });

    Route::middleware(['auth'])->group(function () {
    Route::get('/kptkw', [KPTKWController::class, 'index'])->name('kptkw.dashboard');
    Route::get('/kptkw/{id}/show', [KPTKWController::class, 'show'])->name('kptkw.show');
    Route::post('/kptkw/tuntutan/{id}/lulus', [KPTKWController::class, 'lulus'])->name('kptkw.tuntutan.lulus');
    Route::post('/kptkw/tuntutan/{id}/tidak-lengkap', [KPTKWController::class, 'tidakLengkap'])->name('kptkw.tuntutan.tidakLengkap');
    
    });

    Route::middleware(['auth'])->group(function () {
    Route::get('/kptjkp', [KPTJKPController::class, 'index'])->name('kptjkp.dashboard');
    Route::get('/kptjkp/{id}/show', [KPTJKPController::class, 'show'])->name('kptjkp.show');
    Route::post('/kptjkp/tuntutan/{id}/sahkan', [KPTJKPController::class, 'sahkan'])->name('kptjkp.tuntutan.sahkan');
    Route::post('/kptjkp/tuntutan/{id}/tidak-lengkap', [KPTJKPController::class, 'tidakLengkap'])->name('kptjkp.tuntutan.tidakLengkap');
    
    });


require __DIR__.'/auth.php';
