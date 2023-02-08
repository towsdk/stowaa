<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\Cartcontroller;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\InventoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\UserAuth\UserAuthController;
use App\Http\Controllers\Backend\RolePermissionController;

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

//frontend routes

Route::name('frontend.')->group(function(){
    
    Route::controller(FrontendController::class)->group(function(){
        Route::get('/', 'frontendIndex')->name('home');
    });

    Route::controller(ShopController::class)->group(function(){

        Route::get('/shop','index')->name('shop.index');
        Route::get('/shop/{slug}','shopDetails')->name('shop.details');
        Route::post('/shop/single/color','shopColor')->name('shop.color');
        Route::post('/select/size-color','selectSizeColor')->name('color.size.select');
        
    });

    Route::controller(Cartcontroller::class)->prefix('cart')->name('cart.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');    
    });
});



//backend routes
Route::prefix('dashboard')->name('backend.')->group(function(){
    Route::get('/',[BackendController::class, 'dashboardIndex'])->middleware('verified')->name('home');

    // Role and permission routes

    Route::controller(RolePermissionController::class)->prefix('role')->name('role.')->group( function (){
        //
    Route::get('/', 'indexRole')->name('index')->middleware(['role_or_permission:super-admin|see role']);
    Route::get('/create', 'createRole')->name('create')->middleware(['role_or_permission:super-admin|create role']);
    Route::post('/store', 'roleStore')->name('store')->middleware(['role_or_permission:super-admin|create role']);
    Route::get('/edit/{id}', 'editRole')->name('edit')->middleware(['role_or_permission:super-admin|edit role']);
    Route::post('/update/{id}', 'roleUpdate')->name('update')->middleware(['role_or_permission:super-admin|edit role']);

    //permission create route
    Route::post('/permission/store',  'permissionStore')->name('permission.store');
    
    });
    
    


     // category route
     Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::get('/{category}/show','show')->name('show');
        Route::get('/{category}/edit','edit')->name('edit');
        Route::put('/{category}/update','update')->name('update');
        Route::delete('/{category}/delete','destroy')->name('destroy');

    });

     // color route
     Route::controller(ColorController::class)->prefix('color')->name('color.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::get('/{color}/show','show')->name('show');
        Route::get('/{color}/edit','edit')->name('edit');
        Route::put('/{color}/update','update')->name('update');
        Route::delete('/{color}/delete','destroy')->name('destroy');

    });

     // size route
     Route::controller(SizeController::class)->prefix('size')->name('size.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::get('/{size}/show','show')->name('show');
        Route::get('/{size}/edit','edit')->name('edit');
        Route::put('/{size}/update','update')->name('update');
        Route::delete('/{size}/delete','destroy')->name('destroy');

    });

     // product route
     Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/','store')->name('store');
        Route::get('/{product}/show','show')->name('show');
        Route::get('/{product}/edit','edit')->name('edit');
        Route::put('/{product}/update','update')->name('update');
        Route::delete('/{product}/delete','destroy')->name('destroy');
        Route::get('/{product}/restore','restore')->name('restore');
        Route::delete('/{product}/permanent/delete','permanentDelete')->name('permanent.delete');

    });
     // inventories route
     Route::controller(InventoryController::class)->prefix('inventory')->name('inventory.')->group(function(){
        Route::get('/{id}','index')->name('index');
        Route::post('/','store')->name('store');
        Route::get('/{inventory}/show','show')->name('show');
        Route::get('/{inventory}/edit','edit')->name('edit');
        Route::put('/{inventory}/update','update')->name('update');
        Route::delete('/{inventory}/delete','destroy')->name('destroy');
        // Route::get('/{product}/restore','restore')->name('restore');
        // Route::delete('/{product}/permanent/delete','permanentDelete')->name('permanent.delete');

        Route::post('/select/color', 'selectColor')->name('color.select');
    });

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


