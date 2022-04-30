<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Prophecy\Call\Call;

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

// Client
Route::get('/', [ClientController::class, 'index'])->name('index');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
Route::post('/post-checkout', [ClientController::class, 'postCheckout'])->name('postCheckout');

Route::get('/view-by-cat/{name}', [ClientController::class, 'viewByCat'])->name('view-by-cat');

// Cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/update-from-cart', [CartController::class, 'update'])->name('update.from.cart');
Route::get('/delete-from-cart/{id}', [CartController::class, 'delete'])->name('delete.from.cart');

// Auth
Route::get('/login', [ClientAuthController::class, 'login'])->name('login');
Route::get('/register', [ClientAuthController::class, 'register'])->name('register');
Route::post('/post-login', [ClientAuthController::class, 'post_login'])->name('post_login');
Route::post('/post-register', [ClientAuthController::class, 'post_register'])->name('post_register');
Route::get('/logout', [ClientAuthController::class, 'logout'])->name('logout');

// Admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');

// Category
Route::get('/categories', [CategoryController::class, 'categories'])->name('admin.categories');
Route::get('/category/add', [CategoryController::class, 'add'])->name('admin.add.category');
Route::post('/category/save', [CategoryController::class, 'save'])->name('admin.save.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.update.category');
Route::post('/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.delete.category');

// Product
Route::get('/products', [ProductController::class, 'products'])->name('admin.products');
Route::get('/product/add', [ProductController::class, 'add'])->name('admin.add.product');
Route::post('/product/save', [ProductController::class, 'save'])->name('admin.save.product');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.edit.product');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('admin.update.product');
Route::post('/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.delete.product');
Route::get('/product/activate/{id}', [ProductController::class, 'activate'])->name('admin.activate.product');
Route::get('/product/deactivate/{id}', [ProductController::class, 'deactivate'])->name('admin.deactivate.product');

// Slider
Route::get('/sliders', [SliderController::class, 'sliders'])->name('admin.sliders');
Route::get('/slider/add', [SliderController::class, 'add'])->name('admin.add.slider');
Route::post('/slider/save', [SliderController::class, 'save'])->name('admin.save.slider');
Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('admin.edit.slider');
Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('admin.update.slider');
Route::post('/slider/delete/{id}', [SliderController::class, 'delete'])->name('admin.delete.slider');
Route::get('/slider/activate/{id}', [SliderController::class, 'activate'])->name('admin.activate.slider');
Route::get('/slider/deactivate/{id}', [SliderController::class, 'deactivate'])->name('admin.deactivate.slider');

// Pdf
Route::get('/view-pdf/{id}', [PdfController::class, 'view_pdf'])->name('view_pdf');
