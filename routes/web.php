<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\BundleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;

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

Route::get('/langs',function(){
    return getDefaultLanguage();
});
Route::get('/',function(){
    return dd("jjjjjjj");
});

Route::middleware(['auth', 'verified'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('dashboard.index'); //home page

    Route::get('/settings/edit', [SettingController::class,'edit'])->name('settings.edit');//edit settings of website
    Route::post('/settings/update', [SettingController::class,'update'])->name('settings.update');//edit settings of website

    Route::post('/bundles/toggle-state/{id}',[BundleController::class,'toggleState'])->name('toggle_state');


    Route::get('/profile/edit/{id}', [ProfileController::class,'edit'])->name('profile.edit');//edit profile of user
    Route::post('/profile/update', [ProfileController::class,'update'])->name('profile.update');//edit profile of user
    Route::resources([
        'tenants' => TenantController::class,
        'roles' => RoleController::class,
        'items' => ItemController::class,
        'bundles' => BundleController::class,
        'users' => UserController::class,
    ]);

});

require __DIR__.'/auth.php';
