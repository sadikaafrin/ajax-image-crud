<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;





Route::get('/', [ProductController::class, 'products'])->name('products');
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update.product');
Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('delete.product');
//Route::get('/pagination/paginate-data', [ProductController::class, 'pagination']);
Route::get('/pagination/paginate-data', [ProductController::class, 'pagination'])->name('pagination.paginate-data');
Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('search.product');
// Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
