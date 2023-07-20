<?php

use App\Http\Controllers\Hospital\AdminController;
use App\Http\Controllers\Hospital\UserController;
use App\Http\Controllers\Hospital\AssociatePartnerController;
use App\Http\Controllers\Hospital\Auth\ChangePasswordController;
use App\Http\Controllers\Hospital\Auth\ForgotPasswordController;
use App\Http\Controllers\Hospital\Auth\LoginController;
use App\Http\Controllers\Hospital\Auth\MyAccountController;
use App\Http\Controllers\Hospital\Auth\ResetPasswordController;
use App\Http\Controllers\Hospital\DashboardController;
use App\Http\Controllers\Hospital\HospitalController;
use App\Http\Controllers\Hospital\HospitalDocumentController;
use App\Http\Controllers\Hospital\Claims\ClaimController;
use App\Http\Controllers\Hospital\Claims\PatientController;
use App\Http\Controllers\Hospital\Claims\ClaimantController;
use App\Http\Controllers\Hospital\Claims\BorrowerController;
use App\Http\Controllers\Hospital\Claims\AssessmentController;
use App\Http\Controllers\Hospital\Claims\ClaimProcessingController;
use App\Http\Controllers\Hospital\Claims\DischargeStatusController;
use App\Http\Controllers\Hospital\Claims\DocumentReimbursementController;
use App\Http\Controllers\Hospital\Claims\LendingStatusController;
use App\Http\Controllers\Hospital\UtilityController;
use App\Http\Controllers\Hospital\Claims\ICClaimStatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Hospital Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'hospital', 'as' => 'hospital.'], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes | LOGIN | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/update', [ResetPasswordController::class, 'reset'])->name('password.update');


    /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Admins Route
    |--------------------------------------------------------------------------
    */

    Route::resource('admins', AdminController::class);
    Route::get('admins/import-export',[AdminController::class,'importExport'])->name('admins.import-export');
    Route::post('admins/import',[AdminController::class,'import'])->name('admins.import');
    Route::get('admins/export',[AdminController::class,'export'])->name('admins.export');
    Route::post('admin/change-pasword', [AdminController::class, 'changePassword'])->name('admins.change-password');

    /*
    |--------------------------------------------------------------------------
    | Users Route
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);
    Route::get('users/import-export',[UserController::class,'importExport'])->name('users.import-export');
    Route::post('users/import',[UserController::class,'import'])->name('users.import');
    Route::get('users/export',[UserController::class,'export'])->name('users.export');
    Route::post('user/change-pasword', [UserController::class, 'changePassword'])->name('users.change-password');

    /*
    |--------------------------------------------------------------------------
    | Hospitals Route
    |--------------------------------------------------------------------------
    */

    Route::resource('hospitals', HospitalController::class);

    Route::resource('hospital-documents', HospitalDocumentController::class);

    Route::delete('hospitals/hospital-delete/{id}/{eid}', [HospitalController::class, 'destroyCompany'])->name('hospitals.hospital-delete');

    Route::put('hospitals/tie-ups/{id}', [HospitalController::class, 'updateHospitalTieUps'])->name('hospitals.tie-ups');

    Route::put('hospitals/infrastructures/{id}', [HospitalController::class, 'updateHospitalInfrastructure'])->name('hospitals.infrastructures');

    Route::put('hospitals/facility/{id}', [HospitalController::class, 'updateHospitalFacility'])->name('hospitals.facility');

    Route::put('hospitals/department/{id}', [HospitalController::class, 'updateHospitalDepartment'])->name('hospitals.department');

    Route::post('hospitals/empanelment-status-store', [HospitalController::class, 'storeHospitalEmpanelmentStatus'])->name('hospitals.empanelment-status-store');

    Route::put('hospitals/empanelment-status/{id}', [HospitalController::class, 'updateHospitalEmpanelmentStatus'])->name('hospitals.empanelment-status');

    Route::put('hospitals/documets/{id}', [HospitalController::class, 'updateHospitalDocuments'])->name('hospital-documents.update');


    Route::post('hospital/change-pasword', [HospitalController::class, 'changePassword'])->name('hospitals.change-password');

/*
    |--------------------------------------------------------------------------
    | Claims Route
    |--------------------------------------------------------------------------
    */

    Route::resource('claims', ClaimController::class);

    /*
    |--------------------------------------------------------------------------
    | Claimant Route
    |--------------------------------------------------------------------------
    */

    Route::resource('claimants', ClaimantController::class);

    /*
    |--------------------------------------------------------------------------
    | Insurance Company Claim Status Controller Route
    |--------------------------------------------------------------------------
    */

    Route::resource('icclaim-status', ICClaimStatusController::class);

    /*
    |--------------------------------------------------------------------------
    | Borrower Route
    |--------------------------------------------------------------------------
    */
    
    Route::resource('borrowers', BorrowerController::class);

    Route::put('borrowers-update/{id}', [BorrowerController::class, 'updateBorrower'])->name('borrowers.borrowers-update');


    Route::resource('document-reimbursement', DocumentReimbursementController::class);

    /*
    |--------------------------------------------------------------------------
    | Assessment Status Controller Route
    |--------------------------------------------------------------------------
    */
    Route::put('update-assessment-status/{id}', [AssessmentController::class, 'updateAssessmentStatus'])->name('assessment-status.update-assessment-status');
    
    Route::resource('assessment-status', AssessmentController::class);

    /*
    |--------------------------------------------------------------------------
    | Lending Status Controller Route
    |--------------------------------------------------------------------------
    */
    
    Route::resource('lending-status', LendingStatusController::class);

    /*
    |--------------------------------------------------------------------------
    | Discharge Status Controller Route
    |--------------------------------------------------------------------------
    */

    Route::put('lending-status-update/{id}', [LendingStatusController::class, 'updateLendingStatus'])->name('lending-status.lending-status-update');
    
    Route::resource('discharge-status', DischargeStatusController::class);

    Route::put('update-discharge-status/{id}', [DischargeStatusController::class, 'updateDischargeStatus'])->name('discharge-status.update-discharge-status');

    /*
    |--------------------------------------------------------------------------
    | Claim Processing Controller Route
    |--------------------------------------------------------------------------
    */
    
    Route::resource('claim-processing', ClaimProcessingController::class);

    Route::put('claim-processing-update/{id}', [ClaimProcessingController::class, 'updateClaimProcessing'])->name('claim-processing.claim-processing-update');

    Route::get('documents/view/{id}', [DocumentReimbursementController::class, 'showDocument'])->name('view-claim-documents');
    Route::post('document-reimbursement/update-document/{id}',[DocumentReimbursementController::class, 'updateDocument'])->name('document-reimbursement.update-document');

    /*
    |--------------------------------------------------------------------------
    | Patients Route
    |--------------------------------------------------------------------------
    */
    Route::resource('patients', PatientController::class);

    /*
    |--------------------------------------------------------------------------
    | Associate partners Route
    |--------------------------------------------------------------------------
    */

    Route::resource('associate-partners', AssociatePartnerController::class);
    Route::get('associate-partners/import-export',[AssociatePartnerController::class,'importExport'])->name('associate-partners.import-export');
    Route::post('associate-partners/import',[AssociatePartnerController::class,'import'])->name('associate-partners.import');
    Route::get('associate-partners/export',[AssociatePartnerController::class,'export'])->name('associate-partners.export');
    Route::put('associate-partners/vendor-services/{id}', [AssociatePartnerController::class, 'updateVendorServices'])->name('associate-partners.vendor-services');
    Route::put('associate-partners/sales-services/{id}', [AssociatePartnerController::class, 'updateSalesServices'])->name('associate-partners.sales-services');

    Route::put('claims/update-insurance-policy/{id}', [ClaimController::class, 'updateInsurancePolicy'])->name('claims.update-insurance-policy');

    Route::get('claimants/patient/{id}', [ClaimantController::class, 'fetchPaitientData'])->name('claimants.fetch-patient');
    
    Route::get('claimants/claimant/{id}', [ClaimantController::class, 'fetchClaimentData'])->name('claimants.fetch-claimant');


     /*
    |--------------------------------------------------------------------------
    | Settings > My Account Route
    |--------------------------------------------------------------------------
    */
    Route::resource('my-account', MyAccountController::class);

    /*
    |--------------------------------------------------------------------------
    | Settings > Change Password Route
    |--------------------------------------------------------------------------
    */
    Route::get('change-password', [ChangePasswordController::class,'changePasswordForm'])->name('password.form');

    Route::post('change-password', [ChangePasswordController::class,'changePassword'])->name('change-password');

    /*
    |--------------------------------------------------------------------------
    | Utility Route
    |--------------------------------------------------------------------------
    */
    Route::get('get-employees-by-department/{department}', [UtilityController::class,'getEmployeesByDepartment'])->name('get.employees');
    Route::post('hospitals/doctor-delete/{id}',[HospitalController::class,'deleteDoctor'])->name('hospitals.doctor-delete');
});
