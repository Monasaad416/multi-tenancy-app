<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\HomeController;
use App\Http\Controllers\Tenant\PostController;
use App\Http\Controllers\Tenant\SectionController;
use App\Http\Controllers\Tenant\ServiceController;
use App\Http\Controllers\Tenant\CategoryController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenant\RoleController as TenantRoleController;
use App\Http\Controllers\Tenant\WorkController;
use App\Http\Controllers\Tenant\MessageController;
use App\Http\Controllers\Tenant\ClientController;
use App\Http\Controllers\Tenant\TestimonialController;
use App\Http\Controllers\Tenant\ProfileController;
use App\Http\Controllers\Tenant\SettingController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware(['universal','web',InitializeTenancyByDomain::class,PreventAccessFromCentralDomains::class,])->group(function () {

    // Route::group(['prefix' => LaravelLocalization::setLocale() ,'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {
    //     Route::get('/', function(){
    //         return  LaravelLocalization::getSupportedLanguagesKeys() ;
    //     });
    // });

    Route::middleware(['auth','verified'])->prefix('/admin')->name('tenant.admin.')->group(function () {
        Route::get('/', [HomeController::class , 'index'])->name('dashboard.index');

        Route::get('/settings/edit', [SettingController::class,'edit'])->name('settings.edit');//edit settings of website
        Route::post('/settings/update', [SettingController::class,'update'])->name('settings.update');//edit settings of website

        Route::resources([
            'categories' => CategoryController::class,
            'sections' => SectionController::class,
            'services' => ServiceController::class,
            'roles' => TenantRoleController::class,
            'works' => WorkController::class,
            'clients' => ClientController::class,
            'testimonials' => TestimonialController::class

        ]);


        Route::get('/section/{category_id}',[SectionController::class,'getSectionsByCategory']);

        Route::post('/categories/toggle-state/{id}',[CategoryController::class,'toggleState'])->name('category.toggle_state');
        Route::post('/sections/toggle-state/{id}',[SectionController::class,'toggleState'])->name('section.toggle_state');
        Route::post('/services/toggle-state/{id}',[ServiceController::class,'toggleState'])->name('service.toggle_state');

        Route::get('/settings/edit', [SettingController::class,'edit'])->name('settings.edit');//edit settings of website
        Route::post('/settings/update', [SettingController::class,'update'])->name('settings.update');//edit settings of website


        Route::get('/profile/edit/{id}', [ProfileController::class,'edit'])->name('profile.edit');//edit profile of user
        Route::post('/profile/update', [ProfileController::class,'update'])->name('profile.update');//edit profile of user



        Route::controller(PostController::class)->group(function(){
            Route::get('/posts','index')->name('posts.index');
            Route::get('/posts/show/{id}','show')->name('posts.show');
            Route::delete('/posts/destroy/{id}','destroy')->name('posts.destroy');
            Route::post('/posts/toggle-state/{id}','toggleState')->name('post.toggle_state');

        });

        Route::controller(MessageController::class)->group(function(){
            Route::get('/messages','index')->name('messages.index');
            Route::get('/messages/show/{id}','show')->name('messages.show');
            Route::delete('/messages/destroy/{id}','destroy')->name('messages.destroy');
        });
    });
    require __DIR__.'/auth.php';
    //require __DIR__.'/tenant_client_auth.php';
});









