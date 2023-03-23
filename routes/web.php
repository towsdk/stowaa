<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Frontend\Cartcontroller;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\ShippingChargeController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\InventoryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\UserAuth\UserAuthController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\UserDashboardController;

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

    Route::controller(Cartcontroller::class)->middleware(['auth','verified'])->prefix('cart')->name('cart.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');    
        Route::post('/update', 'update')->name('update');
        Route::delete('/delete/{cart}', 'destroy')->name('delete');  
        Route::get('/cheeckout', 'cheeckoutView')->name('cheeckout'); 
     });

    Route::post('/apply/coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');
    Route::post('/apply/charge', [ShippingChargeController::class, 'applyCharge'])->name('apply.charge');

 });


    Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function(){
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dsahboard');
        Route::get('/dashboard/orders', [UserDashboardController::class, 'userOrder'])->name('orders');  
    });

//backend routes
Route::prefix('dashboard')->name('backend.')->group(function(){
    Route::get('/',[BackendController::class, 'dashboardIndex'])->middleware('verified')->name('home');

    Route::group(['middleware' => ['role:super-admin|admin']], function () {
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

    // Coupon route
    Route::controller(CouponController::class)->prefix('coupon')->name('coupon.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::get('/{coupon}/edit','edit')->name('edit');
        Route::put('/{coupon}/update','update')->name('update');
        Route::delete('/{coupon}/delete','destroy')->name('destroy');

    });

    // Coupon route
    Route::controller(ShippingChargeController::class)->prefix('shipping/charge')->name('shipping.charge.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::get('/{ShippingCharge}/edit','edit')->name('edit');
        Route::put('/{ShippingCharge}/update','update')->name('update');
        Route::delete('/{ShippingCharge}/delete','destroy')->name('destroy');

    });

    Route::controller(OrderController::class)->prefix('order')->name('order.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/{order}/show','show')->name('show');
    });

    });


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


// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END