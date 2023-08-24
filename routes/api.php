<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Illuminate\Support\Facades\Route;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*buyers*/
Route::resource('buyers',App\Http\Controllers\Buyer\BuyerController::class,['only'=>['index','show']]);
Route::resource('buyers.transactions',App\Http\Controllers\Buyer\BuyerTransactionController::class,['only'=>['index']]);
Route::resource('buyers.sellers',App\Http\Controllers\Buyer\BuyerSellerController::class,['only'=>['index']]);
Route::resource('buyers.categories',App\Http\Controllers\Buyer\BuyerCategoryController::class,['only'=>['index']]);
Route::resource('buyers.products',App\Http\Controllers\Buyer\BuyerProductController::class,['only'=>['index']]);

/*sellers*/
Route::resource('sellers',App\Http\Controllers\Seller\SellerController::class,['only'=>['index','show']]);
Route::resource('sellers.products',App\Http\Controllers\Seller\SellerProductController::class,['except'=>['show','create','edit']]);
Route::resource('sellers.categories',App\Http\Controllers\Seller\SellerCategoryController::class,['only'=>['index']]);
Route::resource('sellers.transactions',App\Http\Controllers\Seller\SellerTransactionController::class,['only'=>['index']]);
Route::resource('sellers.buyers',App\Http\Controllers\Seller\SellerBuyerController::class,['only'=>['index']]);

/*categories*/
Route::resource('categories',App\Http\Controllers\Category\CategoryController::class,['except'=>['create','edit']]);
Route::resource('categories.products',App\Http\Controllers\Category\categoryProductController::class,['only'=>['index']]);
Route::resource('categories.sellers',App\Http\Controllers\Category\CategorySellerController::class,['only'=>['index']]);
Route::resource('categories.transactions',App\Http\Controllers\Category\CategoryTransactionController::class,['only'=>['index']]);
Route::resource('categories.buyers',App\Http\Controllers\Category\CategoryBuyerController::class,['only'=>['index']]);

/*products*/
Route::resource('products',App\Http\Controllers\Product\ProductController::class,['only'=>['index','show']]);
Route::resource('products.transactions',App\Http\Controllers\Product\ProductTransactionController::class,['only'=>['index']]);
Route::resource('products.buyers',App\Http\Controllers\Product\ProductBuyerController::class,['only'=>['index']]);
Route::resource('products.categories',App\Http\Controllers\Product\ProductCategoryController::class,['only'=>['index','update','destroy']]);
Route::resource('products.buyers.transactions',App\Http\Controllers\Product\ProductBuyerTransactionController::class,['only'=>['store']]);

/*transactions*/
Route::resource('transactions',\App\Http\Controllers\Transaction\TransationController::class,['only'=>['index','show']]);
Route::resource('transactions.categories',\App\Http\Controllers\Transaction\TransactionCategoryController::class,['only'=>['index']]);
Route::resource('transactions.sellers',\App\Http\Controllers\Transaction\TransactionSellerController::class,['only'=>['index']]);

/*users*/
Route::resource('users',\App\Http\Controllers\User\UserController::class,['except'=>['create','edit']]);
Route::name('verify')->get('users/verify/{token}',[App\Http\Controllers\User\UserController::class,'verify']);
