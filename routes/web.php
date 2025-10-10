<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\AuditManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditController;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    // CL Profiling Routes
    Route::name('cl-profiling.')->group(function () {
        Route::get('/cl-profiling', [AuditController::class, 'index'])->name('index');
        Route::get('/cl-profiling/datatable', [AuditController::class, 'dataTable'])->name('datatable');
        
        // API Routes for CL operations
        Route::get('/api/child-laborers/{id}', [AuditController::class, 'show'])->name('api.show');
        Route::get('/api/child-laborers/{id}/edit', [AuditController::class, 'editCl'])->name('api.edit');
        Route::put('/api/child-laborers/{id}', [AuditController::class, 'updateCl'])->name('api.update');
        Route::delete('/api/child-laborers/{id}', [AuditController::class, 'destroyCl'])->name('api.destroy');
        
        // Location API routes
        Route::get('/api/provinces', [AuditController::class, 'getProvinces'])->name('api.provinces');
        Route::get('/api/barangays', [AuditController::class, 'getBarangaysByProvince'])->name('api.barangays');
    });

    // Keep your existing audit management routes separate
    Route::name('audit-management.')->group(function () {
        Route::resource('/audit-management/audits', AuditManagementController::class);
    });

    Route::middleware(['auth'])->group(function () {
        // Existing audit routes
        Route::get('/audit-management/audit/{id}', [AuditController::class, 'view'])->name('audit.view');
        Route::post('/audit/evaluate/{id}', [AuditController::class, 'submitEvaluation'])->name('audit.evaluate.submit');
    });

});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';

// Dashboard API routes
Route::get('/api/dashboard/stats', [AuditController::class, 'getDashboardStats'])->name('api.dashboard.stats');