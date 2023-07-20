<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GardenCenterController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainCategoryController;
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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('showlogin');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/main-category', [MainCategoryController::class, 'index'])->name('main.category.index');
    Route::get('/main-category/create', [MainCategoryController::class, 'create'])->name('main.category.create');
    Route::post('/main-category', [MainCategoryController::class, 'store'])->name('main.category.store');
    Route::get('/main-category/{id}/edit', [MainCategoryController::class, 'edit'])->name('main.category.edit');
    Route::post('/main-category/{id}/update', [MainCategoryController::class, 'update'])->name('main.category.update');
    Route::get('/main-category/{id}/delete', [MainCategoryController::class, 'destroy'])->name('main.category.destroy');
    Route::get('/main-category/{id}/restore', [MainCategoryController::class, 'restore'])->name('main.category.restore');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');

    Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('sub.category.index');
    Route::get('/sub-category/create', [SubCategoryController::class, 'create'])->name('sub.category.create');
    Route::post('/sub-category', [SubCategoryController::class, 'store'])->name('sub.category.store');
    Route::get('/sub-category/{id}/edit', [SubCategoryController::class, 'edit'])->name('sub.category.edit');
    Route::post('/sub-category/{id}/update', [SubCategoryController::class, 'update'])->name('sub.category.update');
    Route::get('/sub-category/{id}/delete', [SubCategoryController::class, 'destroy'])->name('sub.category.destroy');
    Route::get('/sub-category/{id}/restore', [SubCategoryController::class, 'restore'])->name('sub.category.restore');

    Route::get('/garden-center', [GardenCenterController::class, 'index'])->name('garden.center.index');
    Route::get('/garden-center/create', [GardenCenterController::class, 'create'])->name('garden.center.create');
    Route::post('/garden-center', [GardenCenterController::class, 'store'])->name('garden.center.store');
    Route::get('/garden-center/{id}/edit', [GardenCenterController::class, 'edit'])->name('garden.center.edit');
    Route::post('/garden-center/{id}/update', [GardenCenterController::class, 'update'])->name('garden.center.update');
    Route::get('/garden-center/{id}/delete', [GardenCenterController::class, 'destroy'])->name('garden.center.destroy');
    Route::get('/garden-center/{id}/restore', [GardenCenterController::class, 'restore'])->name('garden.center.restore');
    Route::post('/garden-center/delete-image-from-garden-center/{garden_center_id}/{image_id}', [GardenCenterController::class, 'delete_image_from_garden_center'])->name('garden.center.delete.image.from.garden.center');

    Route::get('/item', [ItemController::class, 'index'])->name('item.index');
    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('/item', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::post('/item/{id}/update', [ItemController::class, 'update'])->name('item.update');
    Route::get('/item/{id}/delete', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::get('/item/{id}/restore', [ItemController::class, 'restore'])->name('item.restore');
    Route::post('/item/show-sub-category/{category_id}', [ItemController::class, 'show_sub_category_select'])->name('item.show.sub.category');
    Route::post('/item/delete-image-from-item/{item_id}/{image_id}', [ItemController::class, 'delete_image_from_item'])->name('item.delete.image.from.item');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
