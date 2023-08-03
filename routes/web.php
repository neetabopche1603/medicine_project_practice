<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/blankPage',function(){
return view('adminPanel.blankPage.index');
});


// ADMIN LOGIN
Route::get('admin', [AdminController::class, 'adminLoginView'])->name('adminLoginView');
Route::post('admin-login', [AdminController::class, 'adminLogin'])->name('adminLogin');
// ADMIN LOGOUT
Route::get('adminLogout', [AdminController::class, 'adminLogout'])->name('adminLogout');

// ADMIN LOGIN END


// ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'adminDashboardView')->name('dashboard');
    });   //HOMECONTROLLER CLOUSER

// ------------------------------------COMPANY CONTROLLER ROUTES--------------------------------
Route::controller(CompanyController::class)->group(function(){

    Route::get('company','index')->name('company');
    Route::post('company-add','addCompany')->name('addCompany');

    Route::get('company-edit/{id}','editCompany')->name('editCompany');
    Route::post('company-edit','updateCompany')->name('updateCompany');

    Route::post('company-delete','deleteCompany')->name('deleteCompany');
    Route::post('company-deletesData','multipleDeleteCompany')->name('multipleDeleteCompany');

}); //COMPANY CONTROLLER CLOUSER

// --------------CATEGORY CONTROLLER ROUTES-----------------
Route::controller(CategoryController::class)->group(function(){
Route::get('category','index')->name('category');

Route::post('category-add','categoryStore')->name('categoryStore');

Route::get('category-edit/{id}','categoryEdit')->name('categoryEdit');
Route::post('category-update','categoryUpdate')->name('categoryUpdate');

Route::post('category-delete','categoryDelete')->name('categoryDelete');
Route::post('category-deleted','multipleDeleteCategory')->name('multipleDeleteCategory');


});  //CATEGORY CONTROLLER CLOUSER

// ----------------------------PRODUCT CONTROLLER ROUTES------------------------
Route::controller(ProductController::class)->group(function(){
    Route::get('product','products')->name('products');
    Route::get('product-view/{id}','viewProduct')->name('viewProduct');
    Route::post('toggleStatus/{item}', 'toggleStatus')->name('toggleStatus');

    Route::get('product-add','addProductForm')->name('addProductForm');
    Route::post('product-add','productStore')->name('productStore');

    Route::get('product-edit/{id}','editProductForm')->name('editProductForm');
    Route::post('product-edit-image','productUpdateTimeDeleteImg')->name('productUpdateTimeDeleteImg');
    Route::post('product-update','productUpdate')->name('productUpdate');

    Route::get('product-delete/{id}','productDelete')->name('productDelete');
    Route::post('product-destroy','productDestroy')->name('productDestroy');


});  //PRODUCT CONTROLLER CLOUSER

}); // PREFIX, NAME , MIDDLEWARE CLOUSER


Route::get('/', function () {
    return view('frontend.home');
})->name('frontend.index');

Route::get('/about-us', function () {
    return view('frontend.about');
})->name('frontend.about');

Route::get('/contact-us', function () {
    return view('frontend.contact');
})->name('frontend.contact');

Route::get('/shop', function () {
    return view('frontend.shop');
})->name('frontend.shop');

Route::get('/shop-single', function () {
    return view('frontend.shop_single');
})->name('frontend.shopSingle');


Route::get('/cart', function () {
    return view('frontend.cart');
})->name('frontend.cart');


Route::get('/checkout', function () {
    return view('frontend.checkout');
})->name('frontend.checkout');

Route::get('/thank-you', function () {
    return view('frontend.thankyou');
})->name('frontend.thankyou');


// https://themewagon.github.io/pharma/shop-single.html