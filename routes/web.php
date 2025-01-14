<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/quotation', [ExcelController::class, 'showQuotation'])->name('quotation.view');
Route::get('/quotation/search', [ExcelController::class, 'searchQuotation'])->name('search.quotation');
Route::get('/invoice', function () {
    return view('dashboard.invoice');
});

Route::get('/upload', [ExcelController::class, 'showUploadForm']);
Route::post('/upload', [ExcelController::class, 'uploadFile']);
Route::get('/display', function () {
    return view('display');
});

Route::post('/process', [ExcelController::class, 'processData']);

Route::post('/generate-invoice', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');


// Route to view individual quotation details
Route::get('/quotation/{id}', [ExcelController::class, 'viewQuotation'])->name('quotation.view');
