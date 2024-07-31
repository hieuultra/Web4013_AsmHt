<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

//admin
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\checkRoleAdminMiddleware;

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


Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/detail/{product_id}', [ProductController::class, 'detail'])->name('productDetail');
Route::get('/products/{category_id}', [ProductController::class, 'products'])->name('productsByCategoryId');


//admin
// Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(['auth', checkRoleAdminMiddleware::class]);
//users
Route::get('/users', [AdminController::class, 'users'])->name('users');
Route::get('/formUpdate', [AdminController::class, 'formUpdate'])->name('formUpdate');

Auth::routes();
//client
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('viewLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/viewEditAcc', [AuthController::class, 'viewEditAcc'])->name('viewEditAcc');
Route::post('/editAcc', [AuthController::class, 'editAcc'])->name('editAcc');

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
    });
