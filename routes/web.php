<?php

use App\Http\Controllers\RecordsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehiclesController;
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

Route::get('/', function () {
    return redirect('login');
});


Auth::routes();

Route::get('/vehicle-registration-types',[VehiclesController::class,'get_vehicle_registration'])->name('vechicle.registration_types');
Route::get('/vehicle-licence-plate-unique',[VehiclesController::class,'get_vehicle_plates'])->name('vechicle.registration_plates');

Route::get('/vehicle/ofical',[VehiclesController::class,'index_oficial'])->name('vechicle.oficial');
Route::get('/vehicle/residente',[VehiclesController::class,'index_residente'])->name('vechicle.residente');
Route::post('/vehicle/save-of',[VehiclesController::class,'store_vehicle_of'])->name('vechicle.storeof');
Route::post('/vehicle/save-res',[VehiclesController::class,'store_vehicle_res'])->name('vechicle.storeres');

Route::get('/vehicle/show/{id}',[VehiclesController::class,'show'])->name('vehicle.show');


Route::post('/record/check-in',[RecordsController::class,'store_check_in'])->name('records.checkin');
Route::post('/record/check-out',[RecordsController::class,'store_check_out'])->name('records.checkout');

Route::get('/report/report-pay',[ReportController::class,'index'])->name('report.index');
Route::get('/report/report-pay-download',[ReportController::class,'report_pay_pdf'])->name('report.download');

Route::post('/record/close-record',[ReportController::class,'close_report'])->name('records.close');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
