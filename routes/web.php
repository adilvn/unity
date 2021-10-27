<?php

use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Home;
use App\Http\Controllers\About;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// Home Route
Route::get('/', [Home::class, 'index'])->name('home');


// Not Login Routes
Route::middleware('notAdminLogin')->group(function () {
    Route::post('/admin-login', [UserController::class, 'loginSuperAdmin'])->name('admin-login');
    Route::get('/admin', function () {
        return view('admin.content.login');
    })->name('admin');
});


// Admin Routes
Route::middleware('adminAuth')->group(function () {
    Route::post('/admin-logout', [adminLoginController::class, 'adminLogout'])->name('admin-logout');
    Route::get('/admin/dashboard', [adminLoginController::class, 'adminDashboard'])->name('admin-dashboard');

    // Career
    Route::get('/admin/careers', [CareerController::class, 'getCareers'])->name('get-careers');
    Route::get('/admin/career/add', [CareerController::class, 'addCareer'])->name('add-career');
    Route::post('/admin/career/save', [CareerController::class, 'saveCareer'])->name('save-career');
    Route::get('/admin/careers/edit/{id}', [CareerController::class, 'editCareers'])->name('edit-careers');
    Route::post('/admin/careers/update/{id}', [CareerController::class, 'updateCareer'])->name('update-careers');
    Route::get('/admin/career/status/{id}', [CareerController::class, 'updateCareerStatus'])->name('update-career-status');
    Route::get('/admin/career/delete/{id}', [CareerController::class, 'deleteCareer'])->name('delete-career');

    //FAQs
    Route::get('/admin/faqs', [FaqsController::class, 'getFaqs'])->name('get-faqs');
    Route::get('/admin/faqs/add', [FaqsController::class, 'addFaq'])->name('add-faq');
    Route::post('/admin/faqs/save', [FaqsController::class, 'saveFaq'])->name('save-faq');
    Route::get('/admin/faqs/edit/{id}', [FaqsController::class, 'editFaq'])->name('edit-faq');
    Route::post('/admin/faqs/update/{id}', [FaqsController::class, 'updateFaq'])->name('update-faq');
    Route::get('/admin/faqs/status/{id}', [FaqsController::class, 'updateFaqStatus'])->name('update-faq-status');
    Route::get('/admin/faqs/delete/{id}', [FaqsController::class, 'deleteFaq'])->name('delete-faq');

    //Super Admin Routes
    Route::middleware('superAuth')->group(function () {
        Route::get('/admin/create', [UserController::class, 'createAdmin'])->name('create-admin');
        Route::post('/admin/store/admin', [UserController::class, 'storeAdmin'])->name('store-admin');
        Route::get('/admin/users/admins', [UserController::class, 'getAdmins'])->name('get-admins');
        Route::get('/admin/users/admins/status/{id}', [UserController::class, 'updateAdminStatus'])->name('admin-status-update');
        Route::get('/admin/users/admins/edit/{id}', [UserController::class, 'editAdmin'])->name('edit-admin');
        Route::post('/admin/users/admins/update/{id}', [UserController::class, 'updateAdmin'])->name('update-admin');
        Route::get('/admin/users/admins/delete/{id}', [UserController::class, 'deleteAdmin'])->name('delete-admin');

        Route::get('admin/users/donators', [UserController::class, 'showDonators'])->name('show-donators');
        Route::get('admin/users/donators/status/{id}', [UserController::class, 'updateDonatorStatus'])->name('donator-status-update');
        Route::get('admin/users/donators/delete/{id}', [UserController::class, 'deleteDonator'])->name('delete-donator');

        Route::get('admin/users/businesses', [UserController::class, 'showBusinesses'])->name('show-businesses');
        Route::get('admin/users/businesses/status/{id}', [UserController::class, 'updateBusinessesStatus'])->name('businesses-status-update');
        Route::get('admin/users/businesses/delete/{id}', [UserController::class, 'deleteBusinesses'])->name('delete-businesses');
    });
});

//Business Routes
Route::middleware('businessAuth')->group(function () {
    Route::get('/business/profile-check', function () {
        return view('business.content.business-profile-check');
    })->name('business-profile-check');
    Route::get('/business/add-product', function () {
        return view('business.content.add-product');
    })->name('business-add-product');
    Route::put('/business/update', [UserController::class, 'updateBusiness'])->name('business-update');
    Route::put('/business/upload-product', [ProductController::class, 'addProduct'])->name('upload-product');
    Route::get('/business/products', [ProductController::class, 'getProducts'])->name('get-products');
    Route::get('/business/product/edit/{id}', [ProductController::class, 'editProduct'])->name('edit-product');
    Route::put('/business/update-product', [ProductController::class, 'updateProduct'])->name('update-product');
    Route::get('/business/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
    Route::get('/business/orders', [OrderController::class, 'getBusinessOrders'])->name('get-business-orders');
    Route::get('/business/payment', [UserController::class, 'businessPayment'])->name('business-payment');
});
Route::middleware('isBusinessActive')->group(function () {
    Route::get('/business/profile', function () {
        return view('business.content.business-profile');
    })->name('business-profile');
});


//Donator Routes
Route::middleware('donatorAuth')->group(function () {
    Route::get('/donator/profile', [DonatorController::class, 'getDonations'])->name('donator-profile');
    Route::post('/donator/update', [UserController::class, 'updateDonator'])->name('donator-update');
    Route::put('/donator/update/image', [UserController::class, 'updateDonatorImg'])->name('donator-update-img');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/order', [OrderController::class, 'confirmOrder'])->name('confirm-order');
});


//User Not Login
Route::middleware('userNotLogin')->group(function () {
    Route::get('/register', function () {
        return view('visitor.content.register');
    })->name('register-page');
    Route::get('/login', function () {
        return view('visitor.content.login');
    })->name('login-page');
});


// Visitor Routes
Route::post('/register/donator', [UserController::class, 'createDonator'])->name('register-donator');
Route::post('/register/business', [UserController::class, 'createBusiness'])->name('register-business');


Route::post('/user/login', [UserController::class, 'visitorLogin'])->name('user-login');
Route::post('/logout', [UserController::class, 'visitorLogout'])->name('logout');
Route::get('/user-logout', [UserController::class, 'userLogout'])->name('user-logout');
Route::get('/gestures', [ProductController::class, 'getGestures'])->name('get-gestures');
Route::get('/gestures/{cat}', [ProductController::class, 'getCatGestures'])->name('get-cat-gestures');


Route::get('/about', [About::class, 'index'])->name('about');
Route::get('contact', function () {
    return view('visitor.content.contact');
})->name('contact');


Route::post('/product/add-cart', [CartController::class, 'addCart'])->name('add-cart');
Route::get('/cart', [CartController::class, 'getCart'])->name('get-cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('update-cart');
Route::get('/cart/delete/{id}', [CartController::class, 'deleteCart'])->name('delete-cart');
Route::get('/product/{url}', [ProductController::class, 'productDetail'])->name('product-detail');


Route::get('/donators', [DonatorController::class, 'getDonators'])->name('get-donators');
Route::post('/donators', [DonatorController::class, 'donatorSearch'])->name('search-donators');
Route::post('/donators/send', [MessageController::class, 'sendMessage'])->name('send-message');

Route::post('/product/review/add', [ReviewController::class, 'addReview'])->name('add-review');


Route::get('faqs', [FaqsController::class, 'showFaqs'])->name('show-faqs');
Route::get('/careers', [VisitorController::class, 'showCareers'])->name('show-careers');
Route::get('/blog', [VisitorController::class, 'showBlog'])->name('show-blog');
Route::get('/blog/poor-children-donation', [VisitorController::class, 'showBlogPost'])->name('show-blog-post');
Route::get('/privacy-policy', function () {
    return view('visitor.content.privacy');
})->name('privacy');
Route::get('/terms-and-conditions', function () {
    return view('visitor.content.terms');
})->name('terms');
