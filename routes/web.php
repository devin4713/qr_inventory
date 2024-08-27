<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

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

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/scan', [InventoryController::class, 'showScanCam'])->name('scan.cam');
Route::post('/detail', [InventoryController::class, 'showDetailPage'])->name('detail.page');
Route::get('/detail/{id}', [InventoryController::class, 'showDetailPage2'])->name('detail.page2');

Route::get('/add', [InventoryController::class, 'showAddCam'])->name('add.cam');
Route::post('/addpage', [InventoryController::class, 'showAddPage'])->name('add.page');
Route::post('/save', [InventoryController::class, 'saveInv'])->name('add.save');

Route::get('/edit', [InventoryController::class, 'showEditCam'])->name('edit.cam');
Route::get('/edit/{id}', [InventoryController::class, 'showEditPage'])->name('edit.page');
Route::post('/edit', [InventoryController::class, 'showEditPage2'])->name('edit.page2');
Route::post('/saveedit/{id}', [InventoryController::class, 'saveEdit'])->name('edit.save');

Route::get('/list', [InventoryController::class, 'showList'])->name('list.page');
Route::delete('/delete/{id}', [InventoryController::class, 'processDelete'])->name('delete.process');
