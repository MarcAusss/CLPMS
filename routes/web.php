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

    Route::name('audit-management.')->group(function () {
        Route::resource('/audit-management/audits', AuditManagementController::class);
    });


    Route::middleware(['auth'])->group(function () {
        // Route::get('/audit-management/audit/{a_id}/edit', [AuditController::class, 'edit'])->name('audit.edit');
        // Route::get('/audit-management/audit/evaluate/{id}', [AuditController::class, 'evaluate'])->name('audit.evaluate');
        // Route::get('/audit-management/audit/{id}/review', [AuditController::class, 'review'])->name('audit.review');
        Route::get('/audit-management/audit/{id}', [AuditController::class, 'view'])->name('audit.view');
        // Route::get('/audit-management/audit/schedule/{id}', [AuditController::class, 'schedule'])->name('audit.schedule');

        // Evaluation Submission
        Route::post('/audit/evaluate/{id}', [AuditController::class, 'submitEvaluation'])->name('audit.evaluate.submit');
    });

});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
