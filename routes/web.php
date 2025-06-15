<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect('home');
});

Route::get('/operation-successful', function () {
	return view('success');
});
Route::get('/operation-canceled', function () {
	return view('canceled');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
	Route::get('/all-masters', [App\Http\Controllers\HomeController::class, 'loadMasters'])->name('load-masters');

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


	// Reports
	Route::post('/reports/download', [App\Http\Controllers\ReportsController::class, 'downloadReport'])->name('download-report');

	// Role
	Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role-list');
	Route::post('/role/save', [App\Http\Controllers\RoleController::class, 'save'])->name('save-role');
	Route::post('/selectrole', [App\Http\Controllers\RoleController::class, 'loadForSelection'])->name('selectrole');
	Route::post('/role/get-permitted-objects', [App\Http\Controllers\RoleController::class, 'getPermittedObjects'])->name('role-objects');

	// User
	Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user-list');
	Route::post('/user/save', [App\Http\Controllers\UserController::class, 'save'])->name('save-user');
	Route::post('/selectuser', [App\Http\Controllers\UserController::class, 'loadForSelection'])->name('selectuser');

	// Department
	Route::get('/department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department-list');
	Route::post('/department/save', [App\Http\Controllers\DepartmentController::class, 'save'])->name('save-department');
	Route::post('/selectdepartment', [App\Http\Controllers\DepartmentController::class, 'loadForSelection'])->name('selectdepartment');
	
	// Customer
	Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer-list');
	Route::post('/customer/save', [App\Http\Controllers\CustomerController::class, 'save'])->name('save-customer');
	Route::post('/selectcustomer', [App\Http\Controllers\CustomerController::class, 'loadForSelection'])->name('selectcustomer');
	// Customer
	Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer-list');
	Route::post('/customer/save', [App\Http\Controllers\CustomerController::class, 'save'])->name('save-customer');
	Route::post('/selectcustomer', [App\Http\Controllers\CustomerController::class, 'loadForSelection'])->name('selectcustomer');
	// Country
	Route::get('/country', [App\Http\Controllers\CountryController::class, 'index'])->name('country-list');
	Route::post('/country/save', [App\Http\Controllers\CountryController::class, 'save'])->name('save-country');
	Route::post('/selectcountry', [App\Http\Controllers\CountryController::class, 'loadForSelection'])->name('selectcountry');
	// InspectionLocation
	Route::get('/inspectionlocation', [App\Http\Controllers\InspectionLocationController::class, 'index'])->name('inspectionlocation-list');
	Route::post('/inspectionlocation/save', [App\Http\Controllers\InspectionLocationController::class, 'save'])->name('save-inspectionlocation');
	Route::post('/selectinspectionlocation', [App\Http\Controllers\InspectionLocationController::class, 'loadForSelection'])->name('selectinspectionlocation');
	// CleaningLocation
	Route::get('/cleaninglocation', [App\Http\Controllers\CleaningLocationController::class, 'index'])->name('cleaninglocation-list');
	Route::post('/cleaninglocation/save', [App\Http\Controllers\CleaningLocationController::class, 'save'])->name('save-cleaninglocation');
	Route::post('/selectcleaninglocation', [App\Http\Controllers\CleaningLocationController::class, 'loadForSelection'])->name('selectcleaninglocation');
	// Surveyor
	Route::get('/surveyor', [App\Http\Controllers\SurveyorController::class, 'index'])->name('surveyor-list');
	Route::post('/surveyor/save', [App\Http\Controllers\SurveyorController::class, 'save'])->name('save-surveyor');
	Route::post('/selectsurveyor', [App\Http\Controllers\SurveyorController::class, 'loadForSelection'])->name('selectsurveyor');
	// Company
	Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company-list');
	Route::post('/company/save', [App\Http\Controllers\CompanyController::class, 'save'])->name('save-company');
	Route::post('/selectcompany', [App\Http\Controllers\CompanyController::class, 'loadForSelection'])->name('selectcompany');
	Route::post('/company/upload-file', [App\Http\Controllers\CompanyController::class, 'uploadFile'])->name('upload-company-file');
	Route::get('/company/view-file/{purpose}/{companyId}/{randomId}', [App\Http\Controllers\CompanyController::class, 'viewFile'])->name('view-company-file');
	// Tank
	Route::get('/tanktype', [App\Http\Controllers\TankTypeController::class, 'index'])->name('tanktype-list');
	Route::post('/tanktype/save', [App\Http\Controllers\TankTypeController::class, 'save'])->name('save-tanktype');
	Route::post('/selecttanktype', [App\Http\Controllers\TankTypeController::class, 'loadForSelection'])->name('selecttanktype');
	// Tcode
	Route::get('/tcode', [App\Http\Controllers\TcodeController::class, 'index'])->name('tcode-list');
	Route::post('/tcode/save', [App\Http\Controllers\TcodeController::class, 'save'])->name('save-tcode');
	Route::post('/selecttcode', [App\Http\Controllers\TcodeController::class, 'loadForSelection'])->name('selecttcode');

	// Cleaning
	Route::get('/cleaning', [App\Http\Controllers\CleaningController::class, 'index'])->name('cleaning-list');
	Route::post('/cleaning/save', [App\Http\Controllers\CleaningController::class, 'save'])->name('save-cleaning');
	Route::post('/cleaning/verify-tank-number', [App\Http\Controllers\CleaningController::class, 'verifyTankNumber'])->name('verify-tank-number');
	Route::post('/selectcleaning', [App\Http\Controllers\CleaningController::class, 'loadForSelection'])->name('selectcleaning');
	Route::get('/cleaning/export-to-pdf/{cleaningId}', [App\Http\Controllers\CleaningController::class, 'exportToPDF'])->name('print-cleaning');
	
	// Drybox
	Route::get('/drybox', [App\Http\Controllers\DryboxController::class, 'index'])->name('drybox-list');
	Route::post('/drybox/save', [App\Http\Controllers\DryboxController::class, 'save'])->name('save-drybox');
	Route::post('/selectdrybox', [App\Http\Controllers\DryboxController::class, 'loadForSelection'])->name('selectdrybox');
	Route::get('/drybox/export-to-pdf/{dryboxId}', [App\Http\Controllers\DryboxController::class, 'exportToPDF'])->name('print-drybox');
	Route::post('/drybox/verify-tank-number', [App\Http\Controllers\DryboxController::class, 'verifyTankNumber'])->name('verify-drybox-number');

	// ImoConditionStatus
	Route::get('/imoconditionstatus', [App\Http\Controllers\ImoConditionStatusController::class, 'index'])->name('imoconditionstatus-list');
	Route::post('/imoconditionstatus/save', [App\Http\Controllers\ImoConditionStatusController::class, 'save'])->name('save-imoconditionstatus');
	Route::post('/selectimoconditionstatus', [App\Http\Controllers\ImoConditionStatusController::class, 'loadForSelection'])->name('selectimoconditionstatus');
	
	// Imo1
	Route::get('/imo1', [App\Http\Controllers\Imo1Controller::class, 'index'])->name('imo1-list');
	Route::get('/imo1/add', [App\Http\Controllers\Imo1Controller::class, 'add'])->name('add-imo1-page');
	Route::get('/imo1/edit/{imo1Id}', [App\Http\Controllers\Imo1Controller::class, 'edit'])->name('edit-imo1-page');
	Route::post('/imo1/duplicate', [App\Http\Controllers\Imo1Controller::class, 'duplicateRecord'])->name('duplicate-imo1-record');
	Route::get('/imo1/view/{imo1Id}', [App\Http\Controllers\Imo1Controller::class, 'view'])->name('view-imo1-page');
	Route::post('/imo1/save', [App\Http\Controllers\Imo1Controller::class, 'save'])->name('save-imo1');
	Route::post('/selectimo1', [App\Http\Controllers\Imo1Controller::class, 'loadForSelection'])->name('selectimo1');
	Route::get('/imo1/export-to-pdf/{imo1ConditionId}', [App\Http\Controllers\Imo1Controller::class, 'exportToPDF'])->name('print-imo1');
	Route::post('/imo1/verify-tank-number', [App\Http\Controllers\Imo1Controller::class, 'verifyTankNumber'])->name('verify-imo1-tank-number');
	Route::get('/imo1/view-file/{imo1Id}/{randomId}', [App\Http\Controllers\Imo1Controller::class, 'viewFile'])->name('view-imo1-file');
	Route::post('/imo1/upload-file', [App\Http\Controllers\Imo1Controller::class, 'uploadFile'])->name('upload-imo1-file');
	Route::post('/imo1/clear-file/{imo1Id}/{randomId}', [App\Http\Controllers\Imo1Controller::class, 'clearFile'])->name('clear-onhire-file');
	
	// Imo5 Condition
	Route::get('/imo5condition', [App\Http\Controllers\Imo5ConditionController::class, 'index'])->name('imo5condition-list');
	Route::get('/imo5condition/add', [App\Http\Controllers\Imo5ConditionController::class, 'add'])->name('add-imo5-page');
	Route::get('/imo5condition/edit/{imo5Id}', [App\Http\Controllers\Imo5ConditionController::class, 'edit'])->name('edit-imo5-page');
	Route::post('/imo5condition/duplicate', [App\Http\Controllers\Imo5ConditionController::class, 'duplicateRecord'])->name('duplicate-imo5-record');
	Route::get('/imo5condition/view/{imo5Id}', [App\Http\Controllers\Imo5ConditionController::class, 'view'])->name('view-imo5-page');
	Route::post('/imo5condition/save', [App\Http\Controllers\Imo5ConditionController::class, 'save'])->name('save-imo5condition');
	Route::post('/selectimo5condition', [App\Http\Controllers\Imo5ConditionController::class, 'loadForSelection'])->name('selectimo5condition');
	Route::get('/imo5condition/export-to-pdf/{imo5ConditionId}', [App\Http\Controllers\Imo5ConditionController::class, 'exportToPDF'])->name('print-imo5');
	Route::post('/imo5condition/verify-tank-number', [App\Http\Controllers\Imo5ConditionController::class, 'verifyTankNumber'])->name('verify-imo5-tank-number');

	// ShipperSurvey
	Route::get('/shippersurvey', [App\Http\Controllers\ShipperSurveyController::class, 'index'])->name('shippersurvey-list');
	Route::post('/shippersurvey/save', [App\Http\Controllers\ShipperSurveyController::class, 'save'])->name('save-shippersurvey');
	Route::post('/selectshippersurvey', [App\Http\Controllers\ShipperSurveyController::class, 'loadForSelection'])->name('selectshippersurvey');
	Route::post('/shippersurvey/verify-tank-number', [App\Http\Controllers\ShipperSurveyController::class, 'verifyTankNumber'])->name('verify-shippersurvey-tank-number');
	Route::get('/shippersurvey/export-to-pdf/{shipperSurveyId}', [App\Http\Controllers\ShipperSurveyController::class, 'exportToPDF'])->name('print-shippersurvey');

	// Weightment
	Route::get('/weightment', [App\Http\Controllers\WeightmentController::class, 'index'])->name('weightment-list');
	Route::post('/weightment/save', [App\Http\Controllers\WeightmentController::class, 'save'])->name('save-weightment');
	Route::post('/selectweightment', [App\Http\Controllers\WeightmentController::class, 'loadForSelection'])->name('selectweightment');
	Route::get('/weightment/export-to-pdf/{weightmentId}', [App\Http\Controllers\WeightmentController::class, 'exportToPDF'])->name('print-weightment');

	// Onhire
	Route::get('/onhire', [App\Http\Controllers\OnhireController::class, 'index'])->name('onhire-list');
	Route::get('/onhire/add', [App\Http\Controllers\OnhireController::class, 'add'])->name('add-onhire-page');
	Route::get('/onhire/edit/{onhireId}', [App\Http\Controllers\OnhireController::class, 'edit'])->name('edit-onhire-page');
	Route::post('/onhire/duplicate', [App\Http\Controllers\OnhireController::class, 'duplicateRecord'])->name('duplicate-onhire-record');
	Route::get('/onhire/view/{onhireId}', [App\Http\Controllers\OnhireController::class, 'view'])->name('view-onhire-page');
	Route::post('/onhire/save', [App\Http\Controllers\OnhireController::class, 'save'])->name('save-onhire');
	Route::post('/selectonhire', [App\Http\Controllers\OnhireController::class, 'loadForSelection'])->name('selectonhire');
	Route::get('/onhire/export-to-pdf/{imo1ConditionId}', [App\Http\Controllers\OnhireController::class, 'exportToPDF'])->name('print-onhire');
	Route::post('/onhire/upload-file', [App\Http\Controllers\OnhireController::class, 'uploadFile'])->name('upload-onhire-file');
	Route::get('/onhire/view-file/{purpose}/{onhireId}/{randomId}', [App\Http\Controllers\OnhireController::class, 'viewFile'])->name('view-onhire-file');
	Route::post('/onhire/clear-file/{purpose}/{onhireId}/{randomId}', [App\Http\Controllers\OnhireController::class, 'clearFile'])->name('clear-onhire-file');

	// JointSurvey
	Route::get('/jointsurvey', [App\Http\Controllers\JointSurveyController::class, 'index'])->name('jointsurvey-list');
	Route::post('/jointsurvey/save', [App\Http\Controllers\JointSurveyController::class, 'save'])->name('save-jointsurvey');
	Route::post('/selectjointsurvey', [App\Http\Controllers\JointSurveyController::class, 'loadForSelection'])->name('selectjointsurvey');
	Route::get('/jointsurvey/export-to-pdf/{jointsurveyId}', [App\Http\Controllers\JointSurveyController::class, 'exportToPDF'])->name('print-jointsurvey');

	// ReferEquipment
	Route::get('/referequipment', [App\Http\Controllers\ReferEquipmentController::class, 'index'])->name('referequipment-list');
	Route::post('/referequipment/save', [App\Http\Controllers\ReferEquipmentController::class, 'save'])->name('save-referequipment');
	Route::post('/selectreferequipment', [App\Http\Controllers\ReferEquipmentController::class, 'loadForSelection'])->name('selectreferequipment');
	Route::get('/referequipment/edit/{id}', [App\Http\Controllers\ReferEquipmentController::class, 'edit'])->name('edit-referequipment-page');
	Route::post('/referequipment/duplicate', [App\Http\Controllers\ReferEquipmentController::class, 'duplicateRecord'])->name('duplicate-referequipment-page');
	Route::get('/referequipment/view-file/{id}/{fieldName}/{size}/{randomId}', [App\Http\Controllers\ReferEquipmentController::class, 'viewFile'])->name('view-referequipment-file');
	Route::get('/referequipment/export-to-pdf/{id}', [App\Http\Controllers\ReferEquipmentController::class, 'exportToPDF'])->name('print-referequipment');
	Route::post('/referequipment/upload-file', [App\Http\Controllers\ReferEquipmentController::class, 'uploadFile'])->name('upload-referequipment-file');
	Route::post('/referequipment/clear-file/{id}/{randomId}', [App\Http\Controllers\ReferEquipmentController::class, 'clearFile'])->name('clear-referequipment-file');
	Route::post('/referequipment/delete', [App\Http\Controllers\ReferEquipmentController::class, 'deleteRecord'])->name('deletereferequipment');
	Route::get('/referequipment/add', [App\Http\Controllers\ReferEquipmentController::class, 'add'])->name('add-referequipment-page');
	Route::get('/referequipment/view/{id}', [App\Http\Controllers\ReferEquipmentController::class, 'view'])->name('view-referequipment-page');

	// Cscre
	Route::get('/cscre', [App\Http\Controllers\CscreController::class, 'index'])->name('cscre-list');
	Route::post('/cscre/save', [App\Http\Controllers\CscreController::class, 'save'])->name('save-cscre');
	Route::post('/selectcscre', [App\Http\Controllers\CscreController::class, 'loadForSelection'])->name('selectcscre');
	Route::get('/cscre/edit/{id}', [App\Http\Controllers\CscreController::class, 'edit'])->name('edit-cscre-page');
	Route::post('/cscre/duplicate', [App\Http\Controllers\CscreController::class, 'duplicateRecord'])->name('duplicate-cscre-page');
	Route::get('/cscre/view-file/{id}/{fieldName}/{size}/{randomId}', [App\Http\Controllers\CscreController::class, 'viewFile'])->name('view-cscre-file');
	Route::get('/cscre/export-to-pdf/{id}', [App\Http\Controllers\CscreController::class, 'exportToPDF'])->name('print-cscre');
	Route::post('/cscre/upload-file', [App\Http\Controllers\CscreController::class, 'uploadFile'])->name('upload-cscre-file');
	Route::post('/cscre/clear-file/{id}/{randomId}', [App\Http\Controllers\CscreController::class, 'clearFile'])->name('clear-cscre-file');
	Route::post('/cscre/delete', [App\Http\Controllers\CscreController::class, 'deleteRecord'])->name('deletecscre');
	Route::get('/cscre/add', [App\Http\Controllers\CscreController::class, 'add'])->name('add-cscre-page');
	Route::get('/cscre/view/{id}', [App\Http\Controllers\CscreController::class, 'view'])->name('view-cscre-page');

	// EquipmentInspection
	Route::get('/equipmentinspection', [App\Http\Controllers\EquipmentInspectionController::class, 'index'])->name('equipmentinspection-list');
	Route::post('/equipmentinspection/save', [App\Http\Controllers\EquipmentInspectionController::class, 'save'])->name('save-equipmentinspection');
	Route::post('/selectequipmentinspection', [App\Http\Controllers\EquipmentInspectionController::class, 'loadForSelection'])->name('selectequipmentinspection');
	Route::get('/equipmentinspection/edit/{id}', [App\Http\Controllers\EquipmentInspectionController::class, 'edit'])->name('edit-equipmentinspection-page');
	Route::post('/equipmentinspection/duplicate', [App\Http\Controllers\EquipmentInspectionController::class, 'duplicateRecord'])->name('duplicate-equipmentinspection-page');
	Route::get('/equipmentinspection/view-file/{id}/{fieldName}/{size}/{randomId}', [App\Http\Controllers\EquipmentInspectionController::class, 'viewFile'])->name('view-equipmentinspection-file');
	Route::get('/equipmentinspection/export-to-pdf/{id}', [App\Http\Controllers\EquipmentInspectionController::class, 'exportToPDF'])->name('print-equipmentinspection');
	Route::post('/equipmentinspection/upload-file', [App\Http\Controllers\EquipmentInspectionController::class, 'uploadFile'])->name('upload-equipmentinspection-file');
	Route::post('/equipmentinspection/clear-file/{id}/{randomId}', [App\Http\Controllers\EquipmentInspectionController::class, 'clearFile'])->name('clear-equipmentinspection-file');
	Route::post('/equipmentinspection/delete', [App\Http\Controllers\EquipmentInspectionController::class, 'deleteRecord'])->name('deleteequipmentinspection');
	Route::get('/equipmentinspection/add', [App\Http\Controllers\EquipmentInspectionController::class, 'add'])->name('add-equipmentinspection-page');
	Route::get('/equipmentinspection/view/{id}', [App\Http\Controllers\EquipmentInspectionController::class, 'view'])->name('view-equipmentinspection-page');

	// Stuffing
	Route::get('/stuffing', [App\Http\Controllers\StuffingController::class, 'index'])->name('stuffing-list');
	Route::post('/stuffing/save', [App\Http\Controllers\StuffingController::class, 'save'])->name('save-stuffing');
	Route::post('/selectstuffing', [App\Http\Controllers\StuffingController::class, 'loadForSelection'])->name('selectstuffing');
	Route::get('/stuffing/edit/{id}', [App\Http\Controllers\StuffingController::class, 'edit'])->name('edit-stuffing-page');
	Route::post('/stuffing/duplicate', [App\Http\Controllers\StuffingController::class, 'duplicateRecord'])->name('duplicate-stuffing-page');
	Route::get('/stuffing/view-file/{id}/{fieldName}/{size}/{randomId}', [App\Http\Controllers\StuffingController::class, 'viewFile'])->name('view-stuffing-file');
	Route::get('/stuffing/export-to-pdf/{id}', [App\Http\Controllers\StuffingController::class, 'exportToPDF'])->name('print-stuffing');
	Route::post('/stuffing/upload-file', [App\Http\Controllers\StuffingController::class, 'uploadFile'])->name('upload-stuffing-file');
	Route::post('/stuffing/clear-file/{id}/{randomId}', [App\Http\Controllers\StuffingController::class, 'clearFile'])->name('clear-stuffing-file');
	Route::post('/stuffing/delete', [App\Http\Controllers\StuffingController::class, 'deleteRecord'])->name('deletestuffing');
	Route::get('/stuffing/add', [App\Http\Controllers\StuffingController::class, 'add'])->name('add-stuffing-page');
	Route::get('/stuffing/view/{id}', [App\Http\Controllers\StuffingController::class, 'view'])->name('view-stuffing-page');

	// GasFreeReport
	Route::get('/gasfreereport', [App\Http\Controllers\GasFreeReportController::class, 'index'])->name('gasfreereport-list');
	Route::post('/gasfreereport/save', [App\Http\Controllers\GasFreeReportController::class, 'save'])->name('save-gasfreereport');
	Route::post('/selectgasfreereport', [App\Http\Controllers\GasFreeReportController::class, 'loadForSelection'])->name('selectgasfreereport');
	Route::get('/gasfreereport/edit/{id}', [App\Http\Controllers\GasFreeReportController::class, 'edit'])->name('edit-gasfreereport-page');
	Route::post('/gasfreereport/duplicate', [App\Http\Controllers\GasFreeReportController::class, 'duplicateRecord'])->name('duplicate-gasfreereport-page');
	Route::get('/gasfreereport/view-file/{id}/{fieldName}/{size}/{randomId}', [App\Http\Controllers\GasFreeReportController::class, 'viewFile'])->name('view-gasfreereport-file');
	Route::get('/gasfreereport/export-to-pdf/{id}', [App\Http\Controllers\GasFreeReportController::class, 'exportToPDF'])->name('print-gasfreereport');
	Route::post('/gasfreereport/upload-file', [App\Http\Controllers\GasFreeReportController::class, 'uploadFile'])->name('upload-gasfreereport-file');
	Route::post('/gasfreereport/clear-file/{id}/{randomId}', [App\Http\Controllers\GasFreeReportController::class, 'clearFile'])->name('clear-gasfreereport-file');
	Route::post('/gasfreereport/delete', [App\Http\Controllers\GasFreeReportController::class, 'deleteRecord'])->name('deletegasfreereport');
	Route::get('/gasfreereport/add', [App\Http\Controllers\GasFreeReportController::class, 'add'])->name('add-gasfreereport-page');
	Route::get('/gasfreereport/view/{id}', [App\Http\Controllers\GasFreeReportController::class, 'view'])->name('view-gasfreereport-page');
	Route::post('/gasfreereport/verify-tank-number', [App\Http\Controllers\GasFreeReportController::class, 'verifyTankNumber'])->name('verify-gasfreereport-tank-number');

	// Dmcc
	Route::get('/dmcc', [App\Http\Controllers\DmccController::class, 'index'])->name('dmcc-list');
	Route::post('/dmcc/save', [App\Http\Controllers\DmccController::class, 'save'])->name('save-dmcc');
	Route::post('/selectdmcc', [App\Http\Controllers\DmccController::class, 'loadForSelection'])->name('selectdmcc');
	Route::get('/dmcc/edit/{id}', [App\Http\Controllers\DmccController::class, 'edit'])->name('edit-dmcc-page');
	Route::post('/dmcc/duplicate', [App\Http\Controllers\DmccController::class, 'duplicateRecord'])->name('duplicate-dmcc-page');
	Route::get('/dmcc/view-file/{id}/{fieldName}/{size}/{randomId}', [App\Http\Controllers\DmccController::class, 'viewFile'])->name('view-dmcc-file');
	Route::get('/dmcc/export-to-pdf/{id}', [App\Http\Controllers\DmccController::class, 'exportToPDF'])->name('print-dmcc');
	Route::post('/dmcc/upload-file', [App\Http\Controllers\DmccController::class, 'uploadFile'])->name('upload-dmcc-file');
	Route::post('/dmcc/clear-file/{id}/{randomId}', [App\Http\Controllers\DmccController::class, 'clearFile'])->name('clear-dmcc-file');
	Route::post('/dmcc/delete', [App\Http\Controllers\DmccController::class, 'deleteRecord'])->name('deletedmcc');
	Route::get('/dmcc/add', [App\Http\Controllers\DmccController::class, 'add'])->name('add-dmcc-page');
	Route::get('/dmcc/view/{id}', [App\Http\Controllers\DmccController::class, 'view'])->name('view-dmcc-page');
	Route::post('/dmcc/verify-tank-number', [App\Http\Controllers\DmccController::class, 'verifyTankNumber'])->name('verify-dmcc-tank-number');

	// DepotConditionSurvey
	Route::get('/depotconditionsurvey', [App\Http\Controllers\DepotConditionSurveyController::class, 'index'])->name('depotconditionsurvey-list');
	Route::post('/depotconditionsurvey/save', [App\Http\Controllers\DepotConditionSurveyController::class, 'save'])->name('save-depotconditionsurvey');
	Route::post('/selectdepotconditionsurvey', [App\Http\Controllers\DepotConditionSurveyController::class, 'loadForSelection'])->name('selectdepotconditionsurvey');
	Route::get('/depotconditionsurvey/edit/{id}', [App\Http\Controllers\DepotConditionSurveyController::class, 'edit'])->name('edit-depotconditionsurvey-page');
	Route::post('/depotconditionsurvey/duplicate', [App\Http\Controllers\DepotConditionSurveyController::class, 'duplicateRecord'])->name('duplicate-depotconditionsurvey-page');
	Route::get('/depotconditionsurvey/view-file/{id}/{fieldName}/{size}/{randomId}', [App\Http\Controllers\DepotConditionSurveyController::class, 'viewFile'])->name('view-depotconditionsurvey-file');
	Route::get('/depotconditionsurvey/export-to-pdf/{id}', [App\Http\Controllers\DepotConditionSurveyController::class, 'exportToPDF'])->name('print-depotconditionsurvey');
	Route::post('/depotconditionsurvey/upload-file', [App\Http\Controllers\DepotConditionSurveyController::class, 'uploadFile'])->name('upload-depotconditionsurvey-file');
	Route::post('/depotconditionsurvey/clear-file/{id}/{randomId}', [App\Http\Controllers\DepotConditionSurveyController::class, 'clearFile'])->name('clear-depotconditionsurvey-file');
	Route::post('/depotconditionsurvey/delete', [App\Http\Controllers\DepotConditionSurveyController::class, 'deleteRecord'])->name('deletedepotconditionsurvey');
	Route::get('/depotconditionsurvey/add', [App\Http\Controllers\DepotConditionSurveyController::class, 'add'])->name('add-depotconditionsurvey-page');
	Route::get('/depotconditionsurvey/view/{id}', [App\Http\Controllers\DepotConditionSurveyController::class, 'view'])->name('view-depotconditionsurvey-page');
	Route::get('/depotconditionsurvey/view-file/{depotconditionsurveyId}/{randomId}', [App\Http\Controllers\DepotConditionSurveyController::class, 'viewFile'])->name('view-depotconditionsurvey-file');
	Route::post('/depotconditionsurvey/verify-tank-number', [App\Http\Controllers\DepotConditionSurveyController::class, 'verifyTankNumber'])->name('verify-depotconditionsurvey-tank-number');

});
// OnhireMain
Route::get('/onhiremain', [App\Http\Controllers\OnhireMainController::class, 'index'])->name('onhiremain-list');
Route::post('/onhiremain/save', [App\Http\Controllers\OnhireMainController::class, 'save'])->name('save-onhiremain');
Route::post('/selectonhiremain', [App\Http\Controllers\OnhireMainController::class, 'loadForSelection'])->name('selectonhiremain');
// OnhireAncillary
Route::get('/onhireancillary', [App\Http\Controllers\OnhireAncillaryController::class, 'index'])->name('onhireancillary-list');
Route::post('/onhireancillary/save', [App\Http\Controllers\OnhireAncillaryController::class, 'save'])->name('save-onhireancillary');
Route::post('/selectonhireancillary', [App\Http\Controllers\OnhireAncillaryController::class, 'loadForSelection'])->name('selectonhireancillary');
// OnhireUnitnr
Route::get('/onhireunitnr', [App\Http\Controllers\OnhireUnitnrController::class, 'index'])->name('onhireunitnr-list');
Route::post('/onhireunitnr/save', [App\Http\Controllers\OnhireUnitnrController::class, 'save'])->name('save-onhireunitnr');
Route::post('/selectonhireunitnr', [App\Http\Controllers\OnhireUnitnrController::class, 'loadForSelection'])->name('selectonhireunitnr');
