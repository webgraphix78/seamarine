<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/bcrypt/get', [App\Http\Controllers\HomeController::class, 'getBCryptHash'])->name('get-bcrypt-hash');
//Reports
Route::post('/reports/get-counts', [App\Http\Controllers\ReportsController::class, 'getCounts'])->name('get-reports-count-list');

// Mobile app auth
// Define a route middleware for the mobile request authenticator
Route::post('/authenticate', [App\Http\Controllers\UserController::class, 'validateUser'])->name('validate-user');
Route::post('/authenticate-token', [App\Http\Controllers\UserController::class, 'validateUserToken'])->name('validate-token');

// Role
Route::post('/role/get', [App\Http\Controllers\RoleController::class, 'get'])->name('get-role-list');
// User
Route::post('/user/get', [App\Http\Controllers\UserController::class, 'get'])->name('get-user-list');
// Department
Route::post('/department/get', [App\Http\Controllers\DepartmentController::class, 'get'])->name('get-department-list');
// Customer
Route::post('/customer/get', [App\Http\Controllers\CustomerController::class, 'get'])->name('get-customer-list');
// Country
Route::post('/country/get', [App\Http\Controllers\CountryController::class, 'get'])->name('get-country-list');
// InspectionLocation
Route::post('/inspectionlocation/get', [App\Http\Controllers\InspectionLocationController::class, 'get'])->name('get-inspectionlocation-list');
// CleaningLocation
Route::post('/cleaninglocation/get', [App\Http\Controllers\CleaningLocationController::class, 'get'])->name('get-cleaninglocation-list');
// Surveyor
Route::post('/surveyor/get', [App\Http\Controllers\SurveyorController::class, 'get'])->name('get-surveyor-list');
// Company
Route::post('/company/get', [App\Http\Controllers\CompanyController::class, 'get'])->name('get-company-list');
// Tank
Route::post('/tanktype/get', [App\Http\Controllers\TankTypeController::class, 'get'])->name('get-tank-list');
// Tcode
Route::post('/tcode/get', [App\Http\Controllers\TcodeController::class, 'get'])->name('get-tcode-list');
// Cleaning
Route::post('/cleaning/get', [App\Http\Controllers\CleaningController::class, 'get'])->name('get-cleaning-list');
Route::post('/cleaning/get-record/{cleaningId}', [App\Http\Controllers\CleaningController::class, 'getRecord'])->name('get-cleaning-record');
// Drybox
Route::post('/drybox/get', [App\Http\Controllers\DryboxController::class, 'get'])->name('get-drybox-list');
Route::post('/drybox/get-record/{dryboxId}', [App\Http\Controllers\DryboxController::class, 'getRecord'])->name('get-drybox-record');
// Media
Route::post('/media/get-images', [App\Http\Controllers\MediaGalleryController::class, 'getImages'])->name('get-images-list');
Route::get('/media/view/{mediaId}/{randomId}', [App\Http\Controllers\MediaGalleryController::class, 'viewFile'])->name('view-media');
Route::post('/media/add', [App\Http\Controllers\MediaGalleryController::class, 'uploadFile'])->name('upload-media');
Route::post('/media/delete', [App\Http\Controllers\MediaGalleryController::class, 'deleteFile'])->name('delete-media');
Route::post('/media/delete-all', [App\Http\Controllers\MediaGalleryController::class, 'deleteFile'])->name('delete-all-media');

// ImoConditionStatus
Route::post('/imoconditionstatus/get', [App\Http\Controllers\ImoConditionStatusController::class, 'get'])->name('get-imoconditionstatus-list');
// Imo1
Route::post('/imo1/get', [App\Http\Controllers\Imo1Controller::class, 'get'])->name('get-imo1-list');
Route::post('/imo1/get-record/{imo1Id}', [App\Http\Controllers\Imo1Controller::class, 'getRecord'])->name('get-imo1-record');
// Imo5Condition
Route::post('/imo5condition/get', [App\Http\Controllers\Imo5ConditionController::class, 'get'])->name('get-imo5condition-list');
Route::post('/imo5condition/get-record/{imo5Id}', [App\Http\Controllers\Imo5ConditionController::class, 'getRecord'])->name('get-imo5condition-record');

// ShipperSurvey
Route::post('/shippersurvey/get', [App\Http\Controllers\ShipperSurveyController::class, 'get'])->name('get-shippersurvey-list');
Route::post('/shippersurvey/get-record/{shippersurveyId}', [App\Http\Controllers\ShipperSurveyController::class, 'getRecord'])->name('get-shippersurvey-record');
// Weightment
Route::post('/weightment/get', [App\Http\Controllers\WeightmentController::class, 'get'])->name('get-weightment-list');
// Onhire
Route::post('/onhire/get', [App\Http\Controllers\OnhireController::class, 'get'])->name('get-onhire-list');
Route::post('/onhire/get-record/{onhireId}', [App\Http\Controllers\OnhireController::class, 'getRecord'])->name('get-onhire-record');

// OnhireMain
Route::post('/onhiremain/get', [App\Http\Controllers\OnhireMainController::class, 'get'])->name('get-onhiremain-list');
// OnhireAncillary
Route::post('/onhireancillary/get', [App\Http\Controllers\OnhireAncillaryController::class, 'get'])->name('get-onhireancillary-list');
// OnhireUnitnr
Route::post('/onhireunitnr/get', [App\Http\Controllers\OnhireUnitnrController::class, 'get'])->name('get-onhireunitnr-list');
// JointSurvey
Route::post('/jointsurvey/get', [App\Http\Controllers\JointSurveyController::class, 'get'])->name('get-jointsurvey-list');

// ReferEquipment	
Route::post('/referequipment/get', [App\Http\Controllers\ReferEquipmentController::class, 'get'])->name('get-referequipment-list');
Route::post('/referequipment/get-record/{id}', [App\Http\Controllers\ReferEquipmentController::class, 'getRecord'])->name('get-referequipment-record');

// Cscre	
Route::post('/cscre/get', [App\Http\Controllers\CscreController::class, 'get'])->name('get-cscre-list');
Route::post('/cscre/get-record/{id}', [App\Http\Controllers\CscreController::class, 'getRecord'])->name('get-cscre-record');

// EquipmentInspection	
Route::post('/equipmentinspection/get', [App\Http\Controllers\EquipmentInspectionController::class, 'get'])->name('get-equipmentinspection-list');
Route::post('/equipmentinspection/get-record/{id}', [App\Http\Controllers\EquipmentInspectionController::class, 'getRecord'])->name('get-equipmentinspection-record');

// Stuffing	
Route::post('/stuffing/get', [App\Http\Controllers\StuffingController::class, 'get'])->name('get-stuffing-list');
Route::post('/stuffing/get-record/{id}', [App\Http\Controllers\StuffingController::class, 'getRecord'])->name('get-stuffing-record');

// GasFreeReport	
Route::post('/gasfreereport/get', [App\Http\Controllers\GasFreeReportController::class, 'get'])->name('get-gasfreereport-list');
Route::post('/gasfreereport/get-record/{id}', [App\Http\Controllers\GasFreeReportController::class, 'getRecord'])->name('get-gasfreereport-record');

// Dmcc	
Route::post('/dmcc/get', [App\Http\Controllers\DmccController::class, 'get'])->name('get-dmcc-list');
Route::post('/dmcc/get-record/{id}', [App\Http\Controllers\DmccController::class, 'getRecord'])->name('get-dmcc-record');

// DepotConditionSurvey	
Route::post('/depotconditionsurvey/get', [App\Http\Controllers\DepotConditionSurveyController::class, 'get'])->name('get-depotconditionsurvey-list');
Route::post('/depotconditionsurvey/get-record/{id}', [App\Http\Controllers\DepotConditionSurveyController::class, 'getRecord'])->name('get-depotconditionsurvey-record');
