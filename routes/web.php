<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\GuidesController;
use App\Http\Controllers\admin\PaymentMethodController;
use App\Http\Controllers\admin\AdminShowController;
use App\Http\Controllers\admin\PaymentMethodCategoryController;
use App\Http\Controllers\admin\SupportController;
use App\Http\Controllers\admin\ServiceCategoryController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\AdsController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\TimeZoneController;
use App\Http\Controllers\admin\AudienceController;
use App\Http\Controllers\admin\DetailedTargetingController;
use App\Http\Controllers\admin\DetailedTargetingChiledController;
use App\Http\Controllers\admin\EditorAccessController;
use App\Http\Controllers\admin\businessTypeController;

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
    return redirect()->route('login');
});

Route::get('admin/login',[App\Http\Controllers\AdminController::class,'login_form'])->name('login.form');
Route::post('admin-login',[App\Http\Controllers\AdminController::class,'admin_login'])->name('admin.login');

Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/logout',[App\Http\Controllers\AdminController::class,'adminLogout'])->name('admin.logout');
    Route::get('admin/dashboard',[App\Http\Controllers\AdminController::class,'adminDashboard'])->name('admin.dashboard');
    
    Route::post('/dollar-rate-update/{id}', [App\Http\Controllers\AdminController::class, 'dollarRateUpdate'])->name('dollar-rate-update');

    Route::get('/balance-top-up-request', [App\Http\Controllers\admin\BalanceController::class, 'balanceTopUpRequest'])->name('balance-top-up-request');
    Route::get('/balance-confirmed/{id}', [App\Http\Controllers\admin\BalanceController::class, 'balanceConfirmed'])->name('balance-confirmed');
    Route::get('/balance-delete/{id}', [App\Http\Controllers\admin\BalanceController::class, 'balanceDelete'])->name('balance-delete');
    Route::get('/balance-edit/{id}', [App\Http\Controllers\admin\BalanceController::class, 'balanceEdit'])->name('balance-edit');
    Route::post('/update-balance/{id}', [App\Http\Controllers\admin\BalanceController::class, 'updateBalance'])->name('update-balance');

    Route::post('/balanace-request-rejected', [App\Http\Controllers\admin\BalanceController::class, 'balanaceRequestRejected'])->name('balanace-request-rejected');
    Route::get('/add-balance', [App\Http\Controllers\admin\BalanceController::class, 'addBalance'])->name('add-balance');
    Route::post('/user-balance-add', [App\Http\Controllers\admin\BalanceController::class, 'userBalanceAdd'])->name('user-balance-add');

    /*----------- Ad Account-----------*/
    Route::get('/ad-account-list', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountList'])->name('ad-account-list');
    Route::post('/ad-account-multiple-reject', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountMultipleReject'])->name('ad-account-multiple-reject');

    Route::get('/ad-account-daily-spending', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountDailySpending'])->name('ad-account-daily-spending');
    Route::get('/ad-account-card-4-digit', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountCarD4Digit'])->name('ad-account-card-4-digit');
    Route::get('/ad-account-social', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountSocial'])->name('ad-account-social');
    Route::get('/ad-account-business-manager', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBusinessManager'])->name('ad-account-business-manager');


    Route::get('/ad-account-settings', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountSettings'])->name('ad-account-settings');
    Route::post('/ad-account-settings-submit', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountSettingsSubmit'])->name('ad-account-settings-submit');
    
    
    Route::get('/ad-account-status-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountStatusComplete'])->name('ad-account-status-complete');
    Route::post('/ad-account-status-reject', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountStatusReject'])->name('ad-account-status-reject');
    Route::get('/edit-ad-account/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'editAdAccount'])->name('edit-ad-account');
    Route::post('/update-ad-account/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'updateAdAccount'])->name('update-ad-account');
    Route::post('/update-account-name-user/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'updateAccountNameUser'])->name('update-account-name-user');
    
    
    Route::get('/create-ad-account', [App\Http\Controllers\admin\AdAccountController::class, 'createAdAccount'])->name('create-ad-account');
    Route::post('/manual-create-ad-account', [App\Http\Controllers\admin\AdAccountController::class, 'manualCreateAdAccount'])->name('manual-create-ad-account');
    Route::get('/ad-account-create/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountCreate'])->name('ad-account-create');
    Route::post('/ad-account-create-submit/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountCreateSubmit'])->name('ad-account-create-submit');

    Route::get('/ad-account-create-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountCreateRequest'])->name('ad-account-create-request');
    Route::post('/ad-account-request-reject', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRequestReject'])->name('ad-account-request-reject');

    Route::get('/ad-account-top-up-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTopUpRequest'])->name('ad-account-top-up-request');
    Route::get('/ad-account-top-up-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTopUpRequestComplete'])->name('ad-account-top-up-request-complete');
    Route::get('/ad-account-top-up-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTopUpRequestReject'])->name('ad-account-top-up-request-reject');
    Route::get('/ad-account-top-up-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTopUpRequestDelete'])->name('ad-account-top-up-request-delete');
    Route::get('/ad-account-top-up-request-edit/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTopUpRequestEdit'])->name('ad-account-top-up-request-edit');
    Route::post('/ad-account-top-up-request-update/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTopUpRequestUpdate'])->name('ad-account-top-up-request-update');

    Route::get('/ad-account-found-transfer-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountFoundTransferRequest'])->name('ad-account-found-transfer-request');
    Route::get('/ad-account-found-transfer-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountFoundTransferRequestComplete'])->name('ad-account-found-transfer-request-complete');
    Route::post('/ad-account-found-transfer-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountFoundTransferRequestReject'])->name('ad-account-found-transfer-request-reject');
    Route::get('/ad-account-found-transfer-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountFoundTransferRequestDelete'])->name('ad-account-found-transfer-request-delete');


    Route::get('/ad-account-transfer-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTransferRequest'])->name('ad-account-transfer-request');
    Route::get('/ad-account-transfer-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTransferRequestComplete'])->name('ad-account-transfer-request-complete');
    Route::post('/ad-account-transfer-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTransferRequestReject'])->name('ad-account-transfer-request-reject');
    Route::get('/ad-account-transfer-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTransferRequestDelete'])->name('ad-account-transfer-request-delete');

    Route::get('/ad-account-appeal-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountAppealRequest'])->name('ad-account-appeal-request');
    Route::get('/ad-account-appeal-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountAppealRequestComplete'])->name('ad-account-appeal-request-complete');
    Route::post('/ad-account-appeal-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountAppealRequestReject'])->name('ad-account-appeal-request-reject');
    Route::get('/ad-account-appeal-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountAppealRequestDelete'])->name('ad-account-appeal-request-delete');


    Route::get('/ad-account-try-hold-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTryHoldRequest'])->name('ad-account-try-hold-request');
    Route::get('/ad-account-try-hold-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTryHoldRequestComplete'])->name('ad-account-try-hold-request-complete');
    Route::post('/ad-account-try-hold-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTryHoldRequestReject'])->name('ad-account-try-hold-request-reject');
    Route::get('/ad-account-try-hold-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTryHoldRequestDelete'])->name('ad-account-try-hold-request-delete');


    Route::get('/ad-account-bill-failed-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBillFailedRequest'])->name('ad-account-bill-failed-request');
    Route::get('/ad-account-bill-failed-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBillFailedRequestComplete'])->name('ad-account-bill-failed-request-complete');
    Route::post('/ad-account-bill-failed-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBillFailedRequestReject'])->name('ad-account-bill-failed-request-reject');
    Route::get('/ad-account-bill-failed-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBillFailedRequestDelete'])->name('ad-account-bill-failed-request-delete');


    Route::get('/ad-account-bm-link-request-view', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBMLinkRequestView'])->name('ad-account-bm-link-request-view');
    Route::post('/ad-account-bm-link-reply/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBmLinkReply'])->name('ad-account-bm-link-reply');
    Route::get('/ad-account-bm-link-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBmLinkRequestDelete'])->name('ad-account-bm-link-request-delete');

    Route::get('/ad-account-refund-request-view', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRefundRequestView'])->name('ad-account-refund-request-view');
    Route::get('/ad-account-refund-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRefundRequestComplete'])->name('ad-account-refund-request-complete');
    Route::post('/ad-account-refund-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRefundRequestReject'])->name('ad-account-refund-request-reject');
    Route::get('/ad-account-refund-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRefundRequestDelete'])->name('ad-account-refund-request-delete');


    Route::get('/ad-account-replace-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountReplaceRequest'])->name('ad-account-replace-request');
    Route::get('/ad-account-replace-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountReplaceRequestComplete'])->name('ad-account-replace-request-complete');
    Route::post('/ad-account-replace-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountReplaceRequestReject'])->name('ad-account-replace-request-reject');
    Route::get('/ad-account-raplace-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountReplaceRequestDelete'])->name('ad-account-raplace-request-delete');


    Route::get('/ad-account-rename-request', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRenameRequest'])->name('ad-account-rename-request');
    Route::post('/ad-account-rename-request-complete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRenameRequestComplete'])->name('ad-account-rename-request-complete');
    Route::post('/ad-account-rename-request-reject/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRenameRequestReject'])->name('ad-account-rename-request-reject');
    Route::get('/ad-account-rename-request-delete/{id}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRenameRequestDelete'])->name('ad-account-rename-request-delete');

    Route::get('/ad-account-create-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRequestStatusFilter'])->name('ad-account-request-status-filter');
    Route::get('/ad-account-top-up-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTopUpStatusFilter'])->name('ad-account-topup-status-filter');
    Route::get('/ad-account-transfer-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTransferStatusFilter'])->name('ad-account-transfer-status-filter');
    Route::get('/ad-account-appeal-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountAppealStatusFilter'])->name('ad-account-appeal-status-filter');
    Route::get('/ad-account-replace-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountReplaceStatusFilter'])->name('ad-account-replace-status-filter');
    Route::get('/ad-account-rename-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRenameStatusFilter'])->name('ad-account-rename-status-filter');
    Route::get('/ad-account-try-hold-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountTryHoldStatusFilter'])->name('ad-account-try-hold-status-filter');
    Route::get('/ad-account-bill-failed-request/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountBillFailedStatusFilter'])->name('ad-account-bill-failed-status-filter');

    Route::get('/ad-account-refund-request-view/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountRefundStatusFilter'])->name('ad-account-refund-status-filter');

    Route::post('/update-account-data', [App\Http\Controllers\admin\AdAccountController::class, 'updateAccountData'])->name('update-account-data');
    Route::post('/update-ad-account-balance', [App\Http\Controllers\admin\AdAccountController::class, 'updateAddAccountBalance'])->name('update-ad-account-balance');
    Route::post('/update-account-bmi', [App\Http\Controllers\admin\AdAccountController::class, 'updateAccountBmi'])->name('update-account-bmi');
    Route::get('/ad-account-list/{data}', [App\Http\Controllers\admin\AdAccountController::class, 'adAccountStatusFilter'])->name('ad-account-status-filter');


    /*-----End Ad Account------*/





    /*----------- Tiktok Ad Account-----------*/
    Route::get('/tiktok-ad-account-list', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'AdAccountList'])->name('tiktok-ad-account-list');
    Route::post('/tiktok-ad-account-multiple-reject', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'AdAccountMultipleReject'])->name('tiktok-ad-account-multiple-reject');

    Route::get('/tiktok-ad-account-daily-spending', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountDailySpending'])->name('tiktok-ad-account-daily-spending');
    Route::get('/tiktok-ad-account-card-4-digit', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountCarD4Digit'])->name('tiktok-ad-account-card-4-digit');
    Route::get('/tiktok-ad-account-social', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountSocial'])->name('tiktok-ad-account-social');
    Route::get('/tiktok-ad-account-business-manager', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBusinessManager'])->name('tiktok-ad-account-business-manager');


    Route::get('/tiktok-ad-account-settings', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountSettings'])->name('tiktok-ad-account-settings');
    Route::post('/tiktok-ad-account-settings-submit', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountSettingsSubmit'])->name('tiktok-ad-account-settings-submit');
    
    
    Route::get('/tiktok-ad-account-status-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountStatusComplete'])->name('tiktok-ad-account-status-complete');
    Route::post('/tiktok-ad-account-status-reject', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountStatusReject'])->name('tiktok-ad-account-status-reject');
    Route::get('/tiktok-edit-ad-account/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'editAdAccount'])->name('tiktok-edit-ad-account');
    Route::post('/tiktok-update-ad-account/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'updateAdAccount'])->name('tiktok-update-ad-account');
    Route::post('/tiktok-update-account-name-user/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'updateAccountNameUser'])->name('tiktok-update-account-name-user');
    
    
    Route::get('/tiktok-create-ad-account', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'createAdAccount'])->name('tiktok-create-ad-account');
    Route::post('/tiktok-manual-create-ad-account', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'manualCreateAdAccount'])->name('tiktok-manual-create-ad-account');
    Route::get('/tiktok-ad-account-create/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountCreate'])->name('tiktok-ad-account-create');
    Route::post('/tiktok-ad-account-create-submit/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountCreateSubmit'])->name('tiktok-ad-account-create-submit');

    Route::get('/tiktok-ad-account-create-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountCreateRequest'])->name('tiktok-ad-account-create-request');
    Route::post('/tiktok-ad-account-request-reject', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRequestReject'])->name('tiktok-ad-account-request-reject');

    Route::get('/tiktok-ad-account-top-up-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTopUpRequest'])->name('tiktok-ad-account-top-up-request');
    Route::get('/tiktok-ad-account-top-up-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTopUpRequestComplete'])->name('tiktok-ad-account-top-up-request-complete');
    Route::get('/tiktok-ad-account-top-up-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTopUpRequestReject'])->name('tiktok-ad-account-top-up-request-reject');
    Route::get('/tiktok-ad-account-top-up-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTopUpRequestDelete'])->name('tiktok-ad-account-top-up-request-delete');
    Route::get('/tiktok-ad-account-top-up-request-edit/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTopUpRequestEdit'])->name('tiktok-ad-account-top-up-request-edit');
    Route::post('/tiktok-ad-account-top-up-request-update/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTopUpRequestUpdate'])->name('tiktok-ad-account-top-up-request-update');

    Route::get('/tiktok-ad-account-found-transfer-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountFoundTransferRequest'])->name('tiktok-ad-account-found-transfer-request');
    Route::get('/tiktok-ad-account-found-transfer-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountFoundTransferRequestComplete'])->name('tiktok-ad-account-found-transfer-request-complete');
    Route::post('/tiktok-ad-account-found-transfer-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountFoundTransferRequestReject'])->name('tiktok-ad-account-found-transfer-request-reject');
    Route::get('/tiktok-ad-account-found-transfer-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountFoundTransferRequestDelete'])->name('tiktok-ad-account-found-transfer-request-delete');


    Route::get('/tiktok-ad-account-transfer-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTransferRequest'])->name('tiktok-ad-account-transfer-request');
    Route::get('/tiktok-ad-account-transfer-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTransferRequestComplete'])->name('tiktok-ad-account-transfer-request-complete');
    Route::post('/tiktok-ad-account-transfer-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTransferRequestReject'])->name('tiktok-ad-account-transfer-request-reject');
    Route::get('/tiktok-ad-account-transfer-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTransferRequestDelete'])->name('tiktok-ad-account-transfer-request-delete');

    Route::get('/tiktok-ad-account-appeal-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountAppealRequest'])->name('tiktok-ad-account-appeal-request');
    Route::get('/tiktok-ad-account-appeal-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountAppealRequestComplete'])->name('tiktok-ad-account-appeal-request-complete');
    Route::post('/tiktok-ad-account-appeal-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountAppealRequestReject'])->name('tiktok-ad-account-appeal-request-reject');
    Route::get('/tiktok-ad-account-appeal-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountAppealRequestDelete'])->name('tiktok-ad-account-appeal-request-delete');


    Route::get('/tiktok-ad-account-try-hold-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTryHoldRequest'])->name('tiktok-ad-account-try-hold-request');
    Route::get('/tiktok-ad-account-try-hold-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTryHoldRequestComplete'])->name('tiktok-ad-account-try-hold-request-complete');
    Route::post('/tiktok-ad-account-try-hold-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTryHoldRequestReject'])->name('tiktok-ad-account-try-hold-request-reject');
    Route::get('/tiktok-ad-account-try-hold-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTryHoldRequestDelete'])->name('tiktok-ad-account-try-hold-request-delete');


    Route::get('/tiktok-ad-account-bill-failed-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBillFailedRequest'])->name('tiktok-ad-account-bill-failed-request');
    Route::get('/tiktok-ad-account-bill-failed-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBillFailedRequestComplete'])->name('tiktok-ad-account-bill-failed-request-complete');
    Route::post('/tiktok-ad-account-bill-failed-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBillFailedRequestReject'])->name('tiktok-ad-account-bill-failed-request-reject');
    Route::get('/tiktok-ad-account-bill-failed-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBillFailedRequestDelete'])->name('tiktok-ad-account-bill-failed-request-delete');


    Route::get('/tiktok-ad-account-bm-link-request-view', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBMLinkRequestView'])->name('tiktok-ad-account-bm-link-request-view');
    Route::post('/tiktok-ad-account-bm-link-reply/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBmLinkReply'])->name('tiktok-ad-account-bm-link-reply');
    Route::get('/tiktok-ad-account-bm-link-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBmLinkRequestDelete'])->name('tiktok-ad-account-bm-link-request-delete');

    Route::get('/tiktok-ad-account-refund-request-view', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRefundRequestView'])->name('tiktok-ad-account-refund-request-view');
    Route::get('/tiktok-ad-account-refund-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRefundRequestComplete'])->name('tiktok-ad-account-refund-request-complete');
    Route::post('/tiktok-ad-account-refund-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRefundRequestReject'])->name('tiktok-ad-account-refund-request-reject');
    Route::get('/tiktok-ad-account-refund-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRefundRequestDelete'])->name('tiktok-ad-account-refund-request-delete');


    Route::get('/tiktok-ad-account-replace-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountReplaceRequest'])->name('tiktok-ad-account-replace-request');
    Route::get('/tiktok-ad-account-replace-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountReplaceRequestComplete'])->name('tiktok-ad-account-replace-request-complete');
    Route::post('/tiktok-ad-account-replace-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountReplaceRequestReject'])->name('tiktok-ad-account-replace-request-reject');
    Route::get('/tiktok-ad-account-raplace-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountReplaceRequestDelete'])->name('tiktok-ad-account-raplace-request-delete');


    Route::get('/tiktok-ad-account-rename-request', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRenameRequest'])->name('tiktok-ad-account-rename-request');
    Route::post('/tiktok-ad-account-rename-request-complete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRenameRequestComplete'])->name('tiktok-ad-account-rename-request-complete');
    Route::post('/tiktok-ad-account-rename-request-reject/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRenameRequestReject'])->name('tiktok-ad-account-rename-request-reject');
    Route::get('/tiktok-ad-account-rename-request-delete/{id}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRenameRequestDelete'])->name('tiktok-ad-account-rename-request-delete');

    Route::get('/tiktok-ad-account-create-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRequestStatusFilter'])->name('tiktok-ad-account-request-status-filter');
    Route::get('/tiktok-ad-account-top-up-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTopUpStatusFilter'])->name('tiktok-ad-account-topup-status-filter');
    Route::get('/tiktok-ad-account-transfer-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTransferStatusFilter'])->name('tiktok-ad-account-transfer-status-filter');
    Route::get('/tiktok-ad-account-appeal-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountAppealStatusFilter'])->name('tiktok-ad-account-appeal-status-filter');
    Route::get('/tiktok-ad-account-replace-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountReplaceStatusFilter'])->name('tiktok-ad-account-replace-status-filter');
    Route::get('/tiktok-ad-account-rename-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRenameStatusFilter'])->name('tiktok-ad-account-rename-status-filter');
    Route::get('/tiktok-ad-account-try-hold-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountTryHoldStatusFilter'])->name('tiktok-ad-account-try-hold-status-filter');
    Route::get('/tiktok-ad-account-bill-failed-request/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountBillFailedStatusFilter'])->name('tiktok-ad-account-bill-failed-status-filter');

    Route::get('/tiktok-ad-account-refund-request-view/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountRefundStatusFilter'])->name('tiktok-ad-account-refund-status-filter');

    Route::post('/tiktok-update-account-data', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'updateAccountData'])->name('tiktok-update-account-data');
    Route::post('/tiktok-update-ad-account-balance', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'updateAddAccountBalance'])->name('tiktok-update-ad-account-balance');
    Route::post('/tiktok-update-account-bmi', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'updateAccountBmi'])->name('tiktok-update-account-bmi');
    Route::get('/tiktok-ad-account-list/{data}', [App\Http\Controllers\admin\TiktokAdAccountController::class, 'adAccountStatusFilter'])->name('tiktok-ad-account-status-filter');

    /*-----End Tiktok Ad Account------*/




    Route::resource('service', ServiceController::class);
    Route::get('/service-view/{id}', [App\Http\Controllers\admin\ServiceController::class, 'serviceView'])->name('service-view');
    Route::get('/service-buy-request', [App\Http\Controllers\admin\ServiceController::class, 'serviceBuyRequest'])->name('service-buy-request');
    Route::post('/service-buy-request-reject/{id}', [App\Http\Controllers\admin\ServiceController::class, 'serviceBuyRequestReject'])->name('service-buy-request-reject');
    Route::post('/service-buy-request-confirmed/{id}', [App\Http\Controllers\admin\ServiceController::class, 'serviceBuyRequestConfirmed'])->name('service-buy-request-confirmed');

    Route::get('/service-buy-request-delete/{id}', [App\Http\Controllers\admin\ServiceController::class, 'serviceBuyRequestDelete'])->name('service-buy-request-delete');
    
    Route::resource('service-category', ServiceCategoryController::class);

    Route::resource('users', UsersController::class);
    Route::resource('guide', GuidesController::class);
    Route::resource('supports', SupportController::class);

    Route::resource('ads', AdsController::class);
    Route::get('/ad-image-remove/{data}', [App\Http\Controllers\admin\AdsController::class, 'adImageRemove'])->name('ad-image-remove');

    Route::resource('settings', SettingsController::class);
    Route::resource('timeZone', TimeZoneController::class);
    Route::resource('businessType', businessTypeController::class);
    Route::resource('editor-access', EditorAccessController::class);
    Route::resource('audience', AudienceController::class);
    Route::resource('detailed-targeting', DetailedTargetingController::class);
    Route::resource('detailed-targeting-chiled', DetailedTargetingChiledController::class);
    Route::get('/guide-view/{id}', [App\Http\Controllers\admin\GuidesController::class, 'guideView'])->name('guide-view');

    Route::resource('payment-method-category', PaymentMethodCategoryController::class);
    Route::resource('payment-method', PaymentMethodController::class);
    Route::post('/get-payment-type-wise-payment-data', [App\Http\Controllers\admin\PaymentMethodController::class, 'getPaymentTypeWisePaymentMethod'])->name('get-payment-type-wise-payment-data');


    Route::get('/balanace-top-up-report-filter', [App\Http\Controllers\admin\ReportController::class, 'balanaceTopUpReportFilter'])->name('balanace-top-up-report-filter');
    Route::post('/balanace-top-up-report', [App\Http\Controllers\admin\ReportController::class, 'balanaceTopUpReport'])->name('balanace-top-up-report');

    Route::get('/ad-account-balanace-top-up-report-filter', [App\Http\Controllers\admin\ReportController::class, 'adAccountbalanaceTopUpReportFilter'])->name('ad-account-balanace-top-up-report-filter');
    Route::post('/get-ad-account-user-wise', [App\Http\Controllers\admin\ReportController::class, 'getAdAccountUserWise'])->name('get-ad-account-user-wise');
    Route::post('/ad-account-balanace-top-up-report', [App\Http\Controllers\admin\ReportController::class, 'adAccountbalanaceTopUpReport'])->name('ad-account-balanace-top-up-report');
    
    Route::post('/pdf-ad-account-data', [App\Http\Controllers\admin\ReportController::class, 'pdfAdAccountData'])->name('pdf-ad-account-data');
    Route::post('/pdf-account-balance-data', [App\Http\Controllers\admin\ReportController::class, 'pdfAccountBalanceData'])->name('pdf-account-balance-data');

    Route::resource('admins', AdminShowController::class);
    
    
    Route::get('/campaign-request', [App\Http\Controllers\admin\CampaignController::class, 'campaignRequest'])->name('campaign-request');
    Route::get('/resume-campaign-request', [App\Http\Controllers\admin\CampaignController::class, 'resumeCampaignRequest'])->name('resume-campaign-request');
    Route::get('/pause-campaign-request', [App\Http\Controllers\admin\CampaignController::class, 'pauseCampaignRequest'])->name('pause-campaign-request');

    Route::post('/campaign-request-reject/{id}', [App\Http\Controllers\admin\CampaignController::class, 'campaignRequestReject'])->name('campaign-request-reject');
    Route::post('/campaign-request-confirmed/{id}', [App\Http\Controllers\admin\CampaignController::class, 'campaignRequestConfirmed'])->name('campaign-request-confirmed');


    Route::resource('role', RoleController::class);

    Route::get('/balance-top-up-request/{data}', [App\Http\Controllers\admin\BalanceController::class, 'balanaceRequestStatusFilter'])->name('balanace-request-status-filter');

});


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/balance', [App\Http\Controllers\user\BalanceTopUpController::class, 'balance'])->name('balance');
    Route::post('/balance-top-up', [App\Http\Controllers\user\BalanceTopUpController::class, 'balanceTopUp'])->name('balance-top-up');
    Route::get('/ad-account-overview', [App\Http\Controllers\user\AdAccountController::class, 'adAccountOverview'])->name('ad-account-overview');
    Route::get('/ad-account-request-list', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRequestList'])->name('ad-account-request-list');
    Route::get('/created-account', [App\Http\Controllers\user\AdAccountController::class, 'createdAccount'])->name('created-account');

    Route::get('/ad-account-edit/{id}', [App\Http\Controllers\user\AdAccountController::class, 'userAdAccountEdit'])->name('ad-account-edit');
    Route::post('/ad-account-edit-submit/{id}', [App\Http\Controllers\user\AdAccountController::class, 'adAccountEditSubmit'])->name('ad-account-edit-submit');
    

    Route::get('/ad-account-request-edit/{id}', [App\Http\Controllers\user\AdAccountController::class, 'userAdAccountRequestEdit'])->name('ad-account-request-edit');
    Route::post('/ad-account-request-edit-submit/{id}', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRequestEditSubmit'])->name('ad-account-request-edit-submit');
    
    

    Route::get('/ad-account-request', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRequest'])->name('ad-account-request');
    Route::post('/ad-account-request-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRequestSubmit'])->name('ad-account-request-submit');

    Route::get('/ad-account-top-up', [App\Http\Controllers\user\AdAccountController::class, 'adAccountTopUp'])->name('ad-account-top-up');
    Route::post('/ad-account-top-up-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountTopUpSubmit'])->name('ad-account-top-up-submit');


    Route::get('/ad-account-found-transfer', [App\Http\Controllers\user\AdAccountController::class, 'adAccountFoundTransfer'])->name('ad-account-found-transfer');
    Route::post('/ad-account-found-transfer-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountFoundTransferSubmit'])->name('ad-account-found-transfer-submit');
    

    Route::get('/ad-account-transfer', [App\Http\Controllers\user\AdAccountController::class, 'adAccountTransfer'])->name('ad-account-transfer');
    Route::post('/ad-account-transfer-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountTransferSubmit'])->name('ad-account-transfer-submit');

    Route::get('/ad-account-rename', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRename'])->name('ad-account-rename');
    Route::post('/ad-account-rename-request-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRenameRequestSubmit'])->name('ad-account-rename-request-submit');
    

    Route::get('/ad-account-appeal', [App\Http\Controllers\user\AdAccountController::class, 'adAccountAppeal'])->name('ad-account-appeal');
    Route::post('/ad-account-appeal-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountAppealSubmit'])->name('ad-account-appeal-submit');

    Route::get('/ad-account-replace', [App\Http\Controllers\user\AdAccountController::class, 'adAccountReplace'])->name('ad-account-replace');
    Route::post('/ad-account-replace-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountReplaceSubmit'])->name('ad-account-replace-submit');

    Route::get('/ad-account-bm-link-request', [App\Http\Controllers\user\AdAccountController::class, 'adAccountBmLinkRequest'])->name('ad-account-bm-link-request');
    Route::post('/ad-account-bm-link-request-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountBmLinkRequestSubmit'])->name('ad-account-bm-link-request-submit');


    Route::get('/ad-account-refund-request', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRefundRequest'])->name('ad-account-refund-request');
    Route::post('/ad-account-refund-request-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountRefundRequestSubmit'])->name('ad-account-refund-request-submit');

    Route::get('/ad-account-try-hold', [App\Http\Controllers\user\AdAccountController::class, 'adAccountTryHold'])->name('ad-account-try-hold');
    Route::post('/ad-account-try-hold-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountTryHoldSubmit'])->name('ad-account-try-hold-submit');

    Route::get('/ad-account-bill-failed', [App\Http\Controllers\user\AdAccountController::class, 'adAccountBillFailed'])->name('ad-account-bill-failed');
    Route::post('/ad-account-bill-failed-submit', [App\Http\Controllers\user\AdAccountController::class, 'adAccountBillFailedSubmit'])->name('ad-account-bill-failed-submit');


    Route::get('/services', [App\Http\Controllers\user\ServicesController::class, 'services'])->name('services');
    Route::post('/services', [App\Http\Controllers\user\ServicesController::class, 'servicesSearch'])->name('services.search');
    Route::get('/service-details/{id}', [App\Http\Controllers\user\ServicesController::class, 'serviceDetails'])->name('service-details');
    Route::get('/buy-service/{id}', [App\Http\Controllers\user\ServicesController::class, 'buyService'])->name('buy-service');
    Route::get('/service-buy-report', [App\Http\Controllers\user\ServicesController::class, 'serviceBuyReport'])->name('service-buy-report');
    Route::get('/services/{id}', [App\Http\Controllers\user\ServicesController::class, 'servicesCategoryWise'])->name('service-filter');

    
    Route::get('/guides', [App\Http\Controllers\user\ServicesController::class, 'guides'])->name('guides');
    Route::get('/guide-details/{id}', [App\Http\Controllers\user\ServicesController::class, 'guideDetails'])->name('guide-details');

    Route::get('/support', [App\Http\Controllers\user\ServicesController::class, 'support'])->name('support');

    Route::post('/get-payment-type-wise-payment-method', [App\Http\Controllers\admin\PaymentMethodController::class, 'getPaymentTypeWisePaymentMethod'])->name('get-payment-type-wise-payment-method');
    Route::post('/get-payment-account', [App\Http\Controllers\admin\PaymentMethodController::class, 'getPaymentAccount'])->name('get-payment-account');


     Route::get('/balance-top-up-history', [App\Http\Controllers\user\AdAccountController::class, 'balanceTopUpHistory'])->name('balance-top-up-history');
     Route::get('/ad-account-top-up-history', [App\Http\Controllers\user\AdAccountController::class, 'adAccountTopUpHistory'])->name('ad-account-top-up-history');
     Route::get('/transfer-history', [App\Http\Controllers\user\AdAccountController::class, 'transferHistory'])->name('transfer-history');
     Route::get('/appeal-history', [App\Http\Controllers\user\AdAccountController::class, 'appealHistory'])->name('appeal-history');
     Route::get('/replace-history', [App\Http\Controllers\user\AdAccountController::class, 'replaceHistory'])->name('replace-history');
     Route::get('/rename-history', [App\Http\Controllers\user\AdAccountController::class, 'renameHistory'])->name('rename-history');
     Route::get('/service-buy-history', [App\Http\Controllers\user\AdAccountController::class, 'serviceBuyHistory'])->name('service-buy-history');

     Route::get('/create-campaign', [App\Http\Controllers\user\CampaignController::class, 'createCampagin'])->name('create-campaign');
     Route::post('/campaign-submit', [App\Http\Controllers\user\CampaignController::class, 'campaginSubmit'])->name('campaign-submit');
     Route::get('/pending-campaign', [App\Http\Controllers\user\CampaignController::class, 'pendingCampaign'])->name('pending-campaign');
     Route::get('/resume-campaign', [App\Http\Controllers\user\CampaignController::class, 'resumeCampaign'])->name('resume-campaign');
     Route::get('/pause-campaign', [App\Http\Controllers\user\CampaignController::class, 'pauseCampaign'])->name('pause-campaign');


     Route::get('/campaign-pause-submit/{id}', [App\Http\Controllers\user\CampaignController::class, 'campaignPauseSubmit'])->name('campaign-pause-submit');
     Route::get('/campaign-resume-submit/{id}', [App\Http\Controllers\user\CampaignController::class, 'campaignResumeSubmit'])->name('campaign-resume-submit');

}); 

Route::post('/country-wise-district-data', [App\Http\Controllers\user\CampaignController::class, 'countryWiseDistrictData'])->name('country-wise-district-data');
     Route::post('/district-wise-area-data', [App\Http\Controllers\user\CampaignController::class, 'districtWiseAreaData'])->name('district-wise-area-data');
     Route::post('/detailed-targeting-wise-data', [App\Http\Controllers\user\CampaignController::class, 'detailedTargetingWiseData'])->name('detailed-targeting-wise-data');
     Route::post('/detailed-targeting-wise-chiled-data', [App\Http\Controllers\user\CampaignController::class, 'detailedTargetingWiseChiledData'])->name('detailed-targeting-wise-chiled-data');

     

      Route::post('/update-doller-rate', [App\Http\Controllers\admin\UsersController::class, 'updateDollerRate'])->name('update-doller-rate');