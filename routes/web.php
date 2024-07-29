<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\UserController;
use App\Mail\SendMailOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/about.html', [StaticController::class, 'about'])->name('about');
Route::get('/giohang.html', [StaticController::class, 'giohang'])->name('giohang');
Route::get('/contact.html', [StaticController::class, 'contact'])->name('contact');
// Route::get('/payment.html', [StaticController::class, 'payment'])->name('payment');

// home page
Route::get('/', [ProductController::class, 'home'])->name('home');
// detail page,crud product;
Route::resource('/product', ProductController::class);

// COMMNENT PRODUCT
Route::post('comment', [ProductController::class, 'comment'])->name('product_comment');


// shop page
Route::get('/shop.html', [ProductController::class, 'shop'])->name('shop');
Route::post('/fetchAllProduct', [ProductController::class, 'shoppage'])->name('shoppage');

// PAYMENT
// Route::post('vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay');
// Route::post('momo_payment', [PaymentController::class, 'momo_payment'])->name('momo');
Route::post('payment', [PaymentController::class, 'order'])->name('order');
Route::get("/thanhtoan.html",function(){
    return view("thanhtoan");
});
// Route::get("/giohang.html",function(){
//     return view("giohang");
// });
// cart page    
// Route::resource('/cart', CartController::class);
// Route::post('/apply-voucher', [CartController::class, 'voucher'])->name('apply-voucher');
// Route::post('/update-quantity-cart', [CartController::class, 'changequantitycart'])->name('update-quantity-cart');
// Route::post('/delete-cart', [CartController::class, 'deletecart'])->name('deletecart');

// user
Route::middleware('auth.ifNotLoggedIn')->group(function () {
    // Route::resource('/user', UserController::class);
    Route::get('/thankorder.html', [PaymentController::class, 'thank_order']);
    Route::get('/thankordermomo.html', [PaymentController::class, 'thank_order_momo']);
});
// order detail

Route::post('orderdetail', [UserController::class, 'orderdetail'])->name('order_detail');
Route::post('cancelorder', [UserController::class, 'cancelorder'])->name('cancel_order');

// wishlist
Route::post('wishlist', [UserController::class, 'addwishlist'])->name('add_wishlist');
Route::post('deletewishlist', [UserController::class, 'deletewishlist'])->name('delete_wishlist');
// blog
Route::resource('blogs', BlogController::class);
Route::get('managerblog', [BlogController::class, 'home'])->name('managerblog');

// search
Route::post('search', [ProductController::class, 'search'])->name('product.search');

// sendmail
// Route::get('/sendmail', function () {
//     Mail::to('21211tt4490@mail.tdc.edu.vn')
//         ->send(new SendMailOrder());
// });
// order
Route::resource('orders', OrderController::class);

// admin
Route::get('/admin/login', function () {
    return view('admin.login');
});
Route::get('/managerment', function () {
    return view('admin.index');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::any('{any}', function () {
    return view('notfound');
})->where('any', '.*');
