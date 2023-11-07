<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CashsaleController;
use App\Http\Controllers\CashThbController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreditsaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DailyCihController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\depositsaleController;
use App\Http\Controllers\expense;
use App\Http\Controllers\expenseCagetoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeDateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoandNameController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\preordersaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\salereturnController;
use App\Http\Controllers\SerialController;
use App\Http\Controllers\StockAdjustController;
use App\Http\Controllers\SubcontrollerController;
use App\Http\Controllers\TakeoutController;
use App\Http\Controllers\UpdateprofileController;
use App\Http\Controllers\UsageContorller;
use App\Http\Controllers\userController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehousePurchaseController;
use App\Http\Controllers\WarehouseStockController;
use App\Models\Creditsale;
use App\Models\CreditsaleDetails;
use Illuminate\Contracts\Session\Session;
use Illuminate\Routing\RouteGroup;
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




Route::get('/', [LoginController::class, 'logoandName']);

Route::post('/signin', [LoginController::class, 'customLogin']);

Route::post('/registration', [LoginController::class, 'customeRegistration']);

Route::get('/forget_password', [ForgetPasswordController::class, 'showForgetPassword']);

Route::post('/forget_password', [ForgetPasswordController::class, 'submitForgetPassword']);

Route::post('/new_password', [ForgetPasswordController::class, 'newPassword']);

Route::get('/reset_password/{token}', [ForgetPasswordController::class, 'showResetPassword'])->name('password.reset');;




//Middlewar Group
Route::middleware('loginCheck')->group(function () {

    Route::get('/get-product-details/{id}', 'App\Http\Controllers\PurchaseController@getProductDetails');

    Route::get('/get-product/{id}', 'App\Http\Controllers\WarehousePurchaseController@getProductDetails');

    Route::resource('/dashboard', DashboardController::class);

    Route::get('/signout', [LoginController::class, 'signOut']);

    Route::resource('category', CategoryController::class);

    Route::resource('subcategory', SubcontrollerController::class);

    Route::resource('customer', CustomerController::class);

    Route::resource('purchase', PurchaseController::class);

    Route::resource('product', ProductController::class);

    Route::resource('cashsale', CashsaleController::class);

    Route::resource('depositsale', depositsaleController::class);

    Route::resource('preordersale', preordersaleController::class);

    Route::resource('salereturn', salereturnController::class);

    Route::resource('expenseCategory', expenseCagetoryController::class);

    Route::resource('expense', expense::class);

    Route::resource('incomedatefilter', IncomeDateController::class);

    Route::resource('expensedatefilter', ExpenseController::class);

    Route::resource('income', IncomeController::class);

    Route::resource('account', AccountController::class);

    Route::resource('logoandname', LogoandNameController::class);

    Route::resource('profileandpassword', UpdateprofileController::class);

    Route::resource('user', userController::class);

    Route::resource('password', PasswordController::class);

    Route::resource('productpending', PendingController::class);

    Route::resource('stockadjustment', StockAdjustController::class);

    Route::resource('serial', SerialController::class);

    Route::get('search_customer', [CustomerController::class, 'search_customer']);

    Route::resource('warehouse', WarehouseController::class);

    Route::resource('warehouseadjustment', WarehouseStockController::class);

    Route::resource('saleClosing', DailyCihController::class);

    Route::resource('cashthb', CashThbController::class);

    Route::resource('warehousepurchase', WarehousePurchaseController::class);

    Route::resource('usageproduct',UsageContorller::class);

    Route::resource('damageproduct', DamageController::class);

    Route::resource('stocktakeout', TakeoutController::class);

    Route::get('getCustomer',[ CustomerController::class,'getCustomer'])->name('selectproducts');

    Route::get('getProduct',[ ProductController::class,'getProduct'])->name('selectp');

    Route::resource('creditsale', CreditsaleController::class);



});
