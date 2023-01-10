<?php

use App\Http\Controllers\ProductPackagingDetailController;
use App\Http\Controllers\ProductPriceConversionController;
use Illuminate\Support\Facades\Route;

use function App\Helper\getProductData;
use function App\Helper\getProductVariants;

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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('product-packaging-detail', ProductPackagingDetailController::class);

Route::get('product-price-conversion', [ProductPriceConversionController::class, 'index'])->name('product-price-conversion.index');

Route::get('get-product-data', [ProductPriceConversionController::class, 'getProductData'])->name('get-product-data');
Route::get('get-product-package-type', [ProductPriceConversionController::class, 'getProductPackageType'])->name('get-product-package-type');
