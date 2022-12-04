<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuth\UserAuthController;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

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

Auth::routes(['verify' => true]);

//frontend controller

Route::controller(FrontendController::class)->name('frontend.')->group(function(){
    Route::get('/', 'frontendIndex')->name('home');
});


//backend
Route::prefix('dashboard')->name('backend.')->group(function(){
    Route::get('/',[BackendController::class, 'dashboardIndex'])->middleware('verified')->name('home');

    // Role and permission routes

    Route::controller(RolePermissionController::class)->group( function () {
        //
    Route::get('/role', 'indexRole')->name('role.index')->middleware(['role_or_permission:super-admin|see role']);
    Route::get('/role/create', 'createRole')->name('role.create')->middleware(['role_or_permission:super-admin|create role']);
    Route::post('/role/store', 'roleStore')->name('role.store')->middleware(['role_or_permission:super-admin|create role']);
    Route::get('/role/edit/{id}', 'editRole')->name('role.edit')->middleware(['role_or_permission:super-admin|edit role']);
    Route::post('/role/update/{id}', 'roleUpdate')->name('role.update')->middleware(['role_or_permission:super-admin|edit role']);
    
    
    });
    
    //permission create route
    Route::post('/permission/store', [RolePermissionController::class, 'permissionStore'])->name('permission.store');

});

    // category route
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category','index')->name('category.index');
        Route::post('/category','store')->name('category.store');
        Route::get('/category/create','create')->name('category.create');
        Route::get('/category/{category}/show','show')->name('category.show');
        Route::get('/category/{category}/edit','edit')->name('category.edit');
        Route::put('/category/{category}/update','update')->name('category.update');
        Route::delete('/category/{category}/delete','destroy')->name('category.destroy');

    });


//User auth route

Route::get('/user/login', [UserAuthController::class, 'login'])->name('user.login');
Route::get('/user/sign-up', [UserAuthController::class, 'registation'])->name('user.registation');





Route::get('/test',function(){
    // $role = Role::create(['name'=>'user']);
    // $permission = Permission::create(['name' => 'see user']);

    $role = Role::find(3);
    // $role->givePermissionTo('see user');

    $user = User::find(3);
    $user->assignRole($role);
});

    // Route::get( '/test', function(){
    //     return User::all()->random()->id;
    // });


