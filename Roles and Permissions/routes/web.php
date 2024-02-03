<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/SuperAdmin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'role:SuperAdmin'])->name('SuperAdmin.index');

Route::middleware(['auth', 'role:SuperAdmin'])->name('SuperAdmin.')->prefix('SuperAdmin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/ManageRoles', RolesController::class)->parameters(['ManageRoles' => 'role']);
    Route::POST('/ManageRoles/{role}/permissions', [RolesController::class, 'givePermission'])->name('ManageRoles.permissions.add');
    Route::DELETE('/ManageRoles/{role}/permissions/{permission}', [RolesController::class, 'revokePermission'])->name('ManageRoles.permissions.revoke');
    Route::resource('/ManagePermissions', PermissionController::class)->parameters(['ManagePermissions' => 'permission']);
    Route::get('/ManageUsers', [UserController::class, 'index'])->name('ManageUsers.index');
    Route::get('/ManageUsers/{user}', [UserController::class, 'show'])->name('ManageUsers.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/ManageUsers/{user}/roles', [UserController::class, 'assignRole'])->name('ManageUsers.roles');
    Route::delete('/ManageUsers/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('ManageUsers.roles.remove');
});


require __DIR__ . '/auth.php';
