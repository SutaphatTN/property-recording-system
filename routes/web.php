<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\MaintenanceController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    //maintenance store general
    Route::get('/maintenance/create/general', [MaintenanceController::class, 'createGeneral'])->name('maintenance.createGeneral');
    Route::post('/maintenance/store/general', [MaintenanceController::class, 'storeGeneral'])->name('maintenance.storeGeneral');

    //maintenance store from qr code
    Route::get('/maintenance/create/qrCode/{asset_id}', [MaintenanceController::class, 'createFromQr'])->name('maintenance.createFromQr');
    Route::post('/maintenance/store/qrCode', [MaintenanceController::class, 'storeFromQr'])->name('maintenance.storeFromQr');

    //maintenance audit
    Route::get('/maintenance/view-audit', [MaintenanceController::class, 'viewAudit'])->name('maintenance.viewAudit');
    Route::get('/maintenance/{id}/edit-audit', [MaintenanceController::class, 'editAudit'])->name('maintenance.editAudit');
    Route::put('/maintenance/{id}/audit', [MaintenanceController::class, 'updateAudit'])->name('maintenance.updateAudit');

    //maintenance approval
    Route::get('/maintenance/view-approval', [MaintenanceController::class, 'viewApproval'])->name('maintenance.viewApproval');
    Route::get('/maintenance/{id}/view-moreApproval', [MaintenanceController::class, 'viewMoreApproval'])->name('maintenance.viewMoreApproval');
    Route::put('/maintenance/{id}/approve', [MaintenanceController::class, 'approve'])->name('maintenance.approve');
    Route::put('/maintenance/{id}/reject', [MaintenanceController::class, 'reject'])->name('maintenance.reject');

    //finish
    Route::post('/maintenance/{id}/finish', [MaintenanceController::class, 'finish'])->name('maintenance.finish');

    //maintenance result approval
    Route::get('/maintenance/view-result-approval', [MaintenanceController::class, 'viewResultApproval'])->name('maintenance.viewResultApproval');

    //search
    Route::get('/maintenance/search', [MaintenanceController::class, 'search'])->name('maintenance.search');

    //asset
    Route::get('assetData/{id}/view-more', [AssetController::class, 'viewMore'])->name('assetData.viewMore');
    Route::get('/company/{companyId}', [AssetController::class, 'getByCompany']);

    //asset storeAsset
    Route::get('/assetData/createAsset', [AssetController::class, 'createAsset'])->name('assetData.createAsset');
    Route::post('/assetData/storeAsset', [AssetController::class, 'storeAsset'])->name('assetData.storeAsset');

    //asset print QrCode
    Route::get('assetData/print-all', [AssetController::class, 'printAll'])->name('assetData.printAll');
    Route::post('assetData/pdf/print-all', [AssetController::class, 'downloadPrintAll'])->name('assetData.downloadPrintAll');
    Route::get('assetData/pdf/print-one/{id}', [AssetController::class, 'downloadPrintOne'])->name('assetData.downloadPrintOne');

    //asset excel
    Route::get('assetData/excel', [AssetController::class, 'excel'])->name('assetData.excel');
    Route::post('assetData/print/excel', [AssetController::class, 'printExcel'])->name('assetData.printExcel');

    //report money
    Route::get('assetData/report-money', [AssetController::class, 'reportMoney'])->name('assetData.reportMoney');
    Route::get('assetData/report-money/export', [AssetController::class, 'exportExcel'])->name('assetData.exportExcel');

    //asset maintenance
    Route::resource('maintenance', MaintenanceController::class);

    //asset information
    Route::resource('assetData', AssetController::class);
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
