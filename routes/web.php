<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ItemController;
// routes/web.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestockController;

Route::get('/admin/restock', [RestockController::class, 'index'])->name('restock.index');
Route::post('/admin/restock', [RestockController::class, 'store'])->name('restock.store');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin', [AuthController::class, 'showDashboard'])->name('admin.dashboard');
Route::get('/admin_dashboard', [AuthController::class, 'showDashboard'])->name('admin.dashboard');
// Route::middleware('auth')->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
// });
// routes/web.php
Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
Route::get('/admin/history', [OrderController::class, 'orderHistory'])->name('admin.history');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');





// Route::get('/admin', function () {
//     return view('admin'); // Ang 'admin' ay tumutukoy sa 'admin.blade.php' file sa views folder.
// });


// use App\Http\Controllers\AdminController;

// Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
// Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');


Route::get('/', [OrderController::class, 'index'])->name('kiosk.index');
Route::post('/add-to-order', [OrderController::class, 'addToOrder'])->name('order.add');
Route::post('/remove-from-order', [OrderController::class, 'removeFromOrder'])->name('order.remove');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/orders/view', [OrderController::class, 'viewOrders'])->name('orders.view');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/admin/orders', [OrderController::class, 'viewOrders'])->name('admin.orders');
Route::get('/order/{orderNumber}', [OrderController::class, 'viewOrder'])->name('order.view');


// Show the form to add a new item
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

// Store the newly created item
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

Route::get('items', [ItemController::class, 'index'])->name('items.index');

Route::resource('items', ItemController::class);

Route::post('/order/update', [OrderController::class, 'update'])->name('order.update');

Route::get('/menu/search', [ItemController::class, 'search'])->name('menu.search');

Route::get('/menu/category/{category}', [ItemController::class, 'showCategory'])->name('menu.category');




// In routes/web.php
Route::patch('/order/{id}/complete', [OrderController::class, 'completeOrder'])->name('order.complete');

