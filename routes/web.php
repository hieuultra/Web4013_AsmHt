<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;

//admin
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\BillsController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\checkRoleAdminMiddleware;
use Carbon\Carbon;

// Route::get('/', function () {
//     return view('welcome');
// });
// cu phap cu
// Route::get('/', 'HomeController@index')->name('home');

//cu phap moi
//guest
Route::get('/productHome', [HomeController::class, 'productHome'])->name('productHome');
Route::get('/', [HomeController::class, 'index'])->name('home');
//login
Route::get('/login', [AuthController::class, 'viewLogin'])->name('viewLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::get('/loginSuccess', [AuthController::class, 'loginSuccess'])->name('loginSuccess')->middleware('auth');
Route::get('/account', [AuthController::class, 'account'])->name('account');
Route::get('/viewRegister', [AuthController::class, 'viewRegister'])->name('viewRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//login success + admin
Route::middleware('auth')->group(function () {
    Route::get('/loginSuccess', [AuthController::class, 'loginSuccess'])->name('loginSuccess')->middleware('auth');
    Route::middleware(['auth', checkRoleAdminMiddleware::class])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });
});

//client
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/detail/{product_id}', [ProductController::class, 'detail'])->name('productDetail');
Route::get('/products/{category_id}', [ProductController::class, 'products'])->name('productsByCategoryId');
//product_variants
Route::get('/product/variants/images', [ProductController::class, 'getVariantImages'])->name('product.variants.images');
Route::post('/variant-details', [ProductController::class, 'getVariantDetails'])->name('variant.details');




//admin
// Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(['auth', checkRoleAdminMiddleware::class]);

Auth::routes();

Route::get('/listCart', [CartController::class, 'listCart'])->name('cart.listCart');
Route::post('/addCart', [CartController::class, 'addCart'])->name('cart.addCart');
Route::post('/updateCart', [CartController::class, 'updateCart'])->name('cart.updateCart');
//user management
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('viewLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/viewEditAcc', [AuthController::class, 'viewEditAcc'])->name('viewEditAcc');
Route::post('/editAcc', [AuthController::class, 'editAcc'])->name('editAcc');

//order
Route::middleware('auth')->prefix('orders')
    ->as('orders.')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
        Route::put('{id}/update', [OrderController::class, 'update'])->name('update');
    });

//admin
Route::middleware(['auth', checkRoleAdminMiddleware::class])->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashborad', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        //categories
        Route::prefix('category')
            ->as('category.')
            ->group(function () {
                Route::get('/categoryList', [CategoryController::class, 'categoryList'])->name('categoryList');
                Route::get('/viewCateAdd', [CategoryController::class, 'viewCateAdd'])->name('viewCateAdd');
                Route::post('/cateAdd', [CategoryController::class, 'cateAdd'])->name('cateAdd');
                Route::get('/cateUpdateForm/{id}', [CategoryController::class, 'cateUpdateForm'])->name('cateUpdateForm');
                Route::post('/cateUpdate', [CategoryController::class, 'cateUpdate'])->name('cateUpdate');
                Route::delete('/cateDestroy/{id}', [CategoryController::class, 'cateDestroy'])->name('cateDestroy');
            });
        //products
        Route::prefix('products')
            ->as('products.')
            ->group(function () {
                Route::get('/productList', [AdminController::class, 'productList'])->name('productList');
                Route::get('/viewProAdd', [AdminController::class, 'viewProAdd'])->name('viewProAdd');
                Route::post('/productAdd', [AdminController::class, 'productAdd'])->name('productAdd');
                Route::get('/productUpdateForm/{id}', [AdminController::class, 'productUpdateForm'])->name('productUpdateForm');
                Route::post('/productUpdate', [AdminController::class, 'productUpdate'])->name('productUpdate');
                Route::delete('/productDestroy/{id}', [AdminController::class, 'productDestroy'])->name('productDestroy');
            });
        //order
        Route::prefix('bills')
            ->as('bills.')
            ->group(function () {
                Route::get('/',               [BillsController::class, 'index'])->name('index');
                Route::get('/show/{id}',     [BillsController::class, 'show'])->name('show');
                Route::put('{id}/update',    [BillsController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [BillsController::class, 'destroy'])->name('destroy');
            });
        //account
        Route::prefix('account')
            ->as('account.')
            ->group(function () {
                Route::get('/accountList', [AccountController::class, 'accountList'])->name('accountList');
                Route::get('/viewAccAdd', [AccountController::class, 'viewAccAdd'])->name('viewAccAdd');
                Route::post('/accAdd', [AccountController::class, 'accAdd'])->name('accAdd');
                Route::get('/accUpdateForm/{id}', [AccountController::class, 'accUpdateForm'])->name('accUpdateForm');
                Route::post('/accUpdate', [AccountController::class, 'accUpdate'])->name('accUpdate');
                Route::delete('/accDestroy/{id}', [AccountController::class, 'accDestroy'])->name('accDestroy');
            });
    });
    // Route::get('/check-timezone', function () {
    //     return Carbon::now()->format('d-m-Y H:i:s');
    // });
