<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIAddressController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\JadorMenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', [HomeController::class, 'index'])->name('resto.index');;



/******************** auth routes *******************/
// login function route
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/auth', [UserController::class, 'auth'])->name('user.auth');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/register', [UserController::class, 'createregister'])->name('user.createregister');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::group(['middleware' => 'auth'], function () {

    /********* dashboard routes **************/
    // admin index route
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // categories resources route
    Route::resource('categories', CategorieController::class);
    // search category route
    Route::post('/cats', [CategorieController::class, 'index'])->name('cats.index');

    /************ Orders Route **************/
    // orders resources route
    Route::resource('/orders', OrderController::class);
    // search order route
    Route::post('/orders', [OrderController::class, 'index'])->name('orders.search');
    // update status order route
    Route::put('/orders/updateStatus/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    // get archived prdedr route
    Route::get('ArchiveOrders', [OrderController::class, 'getArchive'])->name('orders.archive');
    Route::put('Unarchive/{id}/order', [OrderController::class, 'unarchive'])->name('order.unarchive');


    /************* menu routes ********************/
    // menus resources route
    Route::resource('Menu', MenuController::class);
    // search menu route
    Route::post('/menus', [MenuController::class, 'index'])->name('menus.search');
    // POPULAR
    Route::put('POPULAR/{id}/Menu', [MenuController::class, 'POPULAR'])->name('menu.popular');
    Route::put('NOTPOPULAR/{id}/Menu', [MenuController::class, 'NONPOPULAR'])->name('menu.NONpopular');
    // get menu by category route
    Route::get('CatMenu/{id}', [MenuController::class, 'getMenuByCategory'])->name('category.menus');

    /*************** reviews *****************************/
    // revwies routes
    Route::resource('reviews', CommentController::class);
    // search user route
    Route::post('/reviewss', [CommentController::class, 'index'])->name('reviews.search');
    // get all archive reviews  reviews.archive
    Route::get('Archivereviews', [CommentController::class, 'getArhcive'])->name('reviews.archive');
    // Unarchive review route
    Route::put('Unarchive/{id}/review', [CommentController::class, 'Unarchive'])->name('review.unarchive');

    /*************** Couriers *****************************/
    Route::resource('/couriers', CourierController::class);

    /*************** shipping *****************************/
    Route::resource('/street', StreetController::class);

    // resource cost
    Route::resource('/cost', CostController::class);
    // search cost
    Route::post('/cost/search', [CostController::class, 'index'])->name('cost-search.index');



    /**************8 users accounts profiles ************************/
    // get all users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    // search user route
    Route::post('/users', [UserController::class, 'index'])->name('users.search');
    // remove user acount
    Route::delete('users/{id}', [UserController::class, 'removeAcount'])->name('users.remove');
    // get user profile route
    Route::get('Profile/{id}', [UserController::class, 'profile'])->name('user.profile');
    //  Edit user profile
    Route::get('editProfile/{id}', [UserController::class, 'editProfile'])->name('user.edit');
    //  update user profile
    Route::put('user/{user}/update', [UserController::class, 'updateProfile'])->name('user.update');
    /*********** Archive users functions ***********/
    // get archived prdedr route
    Route::get('ArchiveUsers', [UserController::class, 'getUrchivedAcounts'])->name('users.archive');
    Route::put('Unarchive/{id}/User', [UserController::class, 'Unurchive'])->name('user.unarchive');


    // jador menus resources route
    Route::resource('Jador',   JadorMenuController::class);

    // transaction resources route
    Route::resource('transaction',   TransactionController::class);

    // cart routes
    Route::get('/Cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('Add/Cart/{product}', [CartController::class, 'addMenuToCart'])->name('cart.add');
    Route::put('update/{item}/cart', [CartController::class, 'updateItemInCart'])->name('cart.update');
    Route::delete('remove/{item}/cart', [CartController::class, 'removeItemFromCart'])->name('cart.remove');

    // checkout routes
    Route::get("/checkout", [CheckoutController::class, "index"])->name("checkout.index");
    Route::get("/checkout/street/{villageId}", [CheckoutController::class, "getStreet"])->name("checkout.street");
    Route::get("/checkout/cost/{street}", [CheckoutController::class, "getCost"])->name("checkout.cost");
    Route::post("/checkout", [CheckoutController::class, "store"])->name("checkout.store");

    // GET API ALAMAT
    Route::get("/kelurahan/{idKecamatan}", [APIAddressController::class, "getKelurahan"])->name("address.kelurahan");

    //Payment with Paypal Routes
    Route::get("/handel-payment", [PaypalPaymentController::class, "handelPayment"])->name("make.payment");
    Route::get("/Cancel-payment", [PaypalPaymentController::class, "CancelPayment"])->name("cancel.payment");
    Route::get("/Payment-success", [PaypalPaymentController::class, "SuccessPayment"])->name("success.payment");



    /***************** EXCEL ROUTE *************************/
    /**** USER EXCEL ROUTE ****/
    Route::get('file-import-export', [UserController::class, 'fileImportExport']);
    Route::post('file-import', [UserController::class, 'fileImport'])->name('file-import');
    Route::get('file-export', [UserController::class, 'ExportAllUser'])->name('users-export');
    Route::get('file-export/user/{id}', [UserController::class, 'ExportUser'])->name('Export-User'); // export kola user bohdo

    /**** USER EXCEL ROUTE ****/
    Route::get('file-export-order', [OrderController::class, 'exportAllOrderPDF'])->name('orders-export');
});
