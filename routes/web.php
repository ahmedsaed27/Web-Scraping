<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\webScraping\WebScrapingController;

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
    return view('welcome');
});

Route::get('scraping' , [WebScrapingController::class , 'scraping']);
Route::get('getData' , [WebScrapingController::class , 'getDataFromJsonFile']);
