<?php

use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\AssociatePartnerController;
use App\Http\Controllers\SuperAdmin\Auth\ChangePasswordController;
use App\Http\Controllers\SuperAdmin\Auth\ForgotPasswordController;
use App\Http\Controllers\SuperAdmin\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\Auth\MyAccountController;
use App\Http\Controllers\SuperAdmin\Auth\ResetPasswordController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\HospitalController;
use App\Http\Controllers\SuperAdmin\HospitalDocumentController;
use App\Http\Controllers\SuperAdmin\Claims\ClaimController;
use App\Http\Controllers\SuperAdmin\Claims\ClaimantController;
use App\Http\Controllers\SuperAdmin\Claims\BorrowerController;
use App\Http\Controllers\SuperAdmin\Claims\PatientController;
use App\Http\Controllers\SuperAdmin\UtilityController;
use App\Http\Controllers\SuperAdmin\BillEntryController;
use App\Http\Controllers\SuperAdmin\Claims\AssessmentController;
use App\Http\Controllers\SuperAdmin\Claims\AssessmentFormController;
use App\Http\Controllers\SuperAdmin\Claims\ClaimProcessingController;
use App\Http\Controllers\SuperAdmin\Claims\DischargeStatusController;
use App\Http\Controllers\SuperAdmin\Claims\DocumentReimbursementController;
use App\Http\Controllers\SuperAdmin\Claims\LendingStatusController;
use App\Http\Controllers\SuperAdmin\Claims\ICClaimStatusController;
use App\Http\Controllers\SuperAdmin\Pending\PendingPreAssessmentController;
use App\Http\Controllers\SuperAdmin\Pending\PendingClaimProcessingController;
use App\Http\Controllers\SuperAdmin\Pending\PendingFinalAssessmentController;
use App\Http\Controllers\SuperAdmin\Authorizations\HospitalAuthorizationController;
use App\Http\Controllers\SuperAdmin\Authorizations\ClaimantAuthorizationController;
use App\Http\Controllers\SuperAdmin\Authorizations\BorrowerAuthorizationController;
use App\Http\Controllers\SuperAdmin\AssigningStatus\AssigningStatusPreAssessmentController;
use App\Http\Controllers\SuperAdmin\AssigningStatus\AssigningStatusClaimProcessingController;
use App\Http\Controllers\SuperAdmin\AssigningStatus\AssigningStatusFinalAssessmentController;
use App\Http\Controllers\SuperAdmin\Authorizations\HospitalTieUpAuthorizationController;
use App\Http\Controllers\SuperAdmin\Authorizations\HospitalEmanelmentStatusAuthorizationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\TpaCompanyController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'super-admin', 'as' => 'super-admin.'], function () {

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
    | Admin Import Export Route
    |--------------------------------------------------------------------------
    */

    Route::get('admins/import-export',[AdminController::class,'importExport'])->name('admins.import-export');
    Route::post('admins/import',[AdminController::class,'import'])->name('admins.import');
    Route::get('admins/export',[AdminController::class,'export'])->name('admins.export');

     /*
    |--------------------------------------------------------------------------
    | Admins Route
    |--------------------------------------------------------------------------
    */

    Route::resource('admins', AdminController::class);
    Route::post('admin/change-pasword', [AdminController::class, 'changePassword'])->name('admins.change-password');

    /*
    |--------------------------------------------------------------------------
    | Users Import Export Route
    |--------------------------------------------------------------------------
    */

    Route::get('users/import-export',[UserController::class,'importExport'])->name('users.import-export');
    Route::post('users/import',[UserController::class,'import'])->name('users.import');
    Route::get('users/export',[UserController::class,'export'])->name('users.export');

    /*
    |--------------------------------------------------------------------------
    | Users Route
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);
    Route::post('user/change-pasword', [UserController::class, 'changePassword'])->name('users.change-password');

    /*
    |--------------------------------------------------------------------------
    | Admin Import Export Route
    |--------------------------------------------------------------------------
    */

    Route::get('associate-partners/import-export',[AssociatePartnerController::class,'importExport'])->name('associate-partners.import-export');
    Route::post('associate-partners/import',[AssociatePartnerController::class,'import'])->name('associate-partners.import');
    Route::get('associate-partners/export',[AssociatePartnerController::class,'export'])->name('associate-partners.export');


    /*
    |--------------------------------------------------------------------------
    | Hospitals Route
    |--------------------------------------------------------------------------
    */

    Route::get('hospitals/import-export',[HospitalController::class,'importExport'])->name('hospitals.import-export');
    Route::post('hospitals/import',[HospitalController::class,'import'])->name('hospitals.import');
    Route::get('hospitals/export',[HospitalController::class,'export'])->name('hospitals.export');

    Route::resource('hospitals', HospitalController::class);
    Route::resource('hospital-documents', HospitalDocumentController::class);
    Route::delete('hospitals/hospital-delete/{id}/{eid}', [HospitalController::class, 'destroyCompany'])->name('hospitals.hospital-delete');

    Route::put('hospitals/tie-ups/{id}', [HospitalController::class, 'updateHospitalTieUps'])->name('hospitals.tie-ups');

    Route::put('hospitals/infrastructures/{id}', [HospitalController::class, 'updateHospitalInfrastructure'])->name('hospitals.infrastructures');

    Route::put('hospitals/facility/{id}', [HospitalController::class, 'updateHospitalFacility'])->name('hospitals.facility');

    Route::put('hospitals/department/{id}', [HospitalController::class, 'updateHospitalDepartment'])->name('hospitals.department');

    Route::put('hospitals/documets/{id}', [HospitalController::class, 'updateHospitalDocuments'])->name('hospital-documents.update');

    Route::post('hospitals/empanelment-status-store', [HospitalController::class, 'storeHospitalEmpanelmentStatus'])->name('hospitals.empanelment-status-store');

    Route::put('hospitals/empanelment-status/{id}', [HospitalController::class, 'updateHospitalEmpanelmentStatus'])->name('hospitals.empanelment-status');

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
    | Borrower Route
    |--------------------------------------------------------------------------
    */

    Route::resource('borrowers', BorrowerController::class);
    Route::put('borrowers-update/{id}', [BorrowerController::class, 'updateBorrower'])->name('borrowers.borrowers-update');

    /*
    |--------------------------------------------------------------------------
    | Document Reimursement Route
    |--------------------------------------------------------------------------
    */

    Route::resource('document-reimbursement', DocumentReimbursementController::class);
    Route::get('documents/view/{id}', [DocumentReimbursementController::class, 'showDocument'])->name('view-claim-documents');
    Route::post('document-reimbursement/update-document/{id}',[DocumentReimbursementController::class, 'updateDocument'])->name('document-reimbursement.update-document');

    /*
    |--------------------------------------------------------------------------
    | Assessment Status Controller Route
    |--------------------------------------------------------------------------
    */

    Route::put('update-assessment-status/{id}', [AssessmentController::class, 'updateAssessmentStatus'])->name('assessment-status.update-assessment-status');

    Route::resource('assessment-status', AssessmentController::class);

    Route::get('assessment-status/{claim_id}/kypform', [AssessmentController::class, 'kypform'])->name('assessment-status.kypform');
    Route::post('assessment-status/savepartone', [AssessmentController::class, 'savepartone'])->name('assessment-status.savepartone');
    Route::get('assessment-status/{claim_id}/createKYPPDF', [AssessmentController::class, 'createKYPPDF'])->name('assessment-status.createKYPPDF');

    Route::get('assessment-status/{claim_id}/treatmentform', [AssessmentController::class, 'treatmentform'])->name('assessment-status.treatmentform');
    Route::post('assessment-status/saveparttwo', [AssessmentController::class, 'saveparttwo'])->name('assessment-status.saveparttwo');
    Route::get('assessment-status/{claim_id}/createtreatmentPDF', [AssessmentController::class, 'createtreatmentPDF'])->name('assessment-status.createtreatmentPDF');

    /*
    |--------------------------------------------------------------------------
    | Lending Status Controller Route
    |--------------------------------------------------------------------------
    */

    Route::resource('lending-status', LendingStatusController::class);
    

    Route::put('lending-status-update/{id}', [LendingStatusController::class, 'updateLendingStatus'])->name('lending-status.lending-status-update');


    /*
    |--------------------------------------------------------------------------
    | Insurance Company Claim Status Controller Route
    |--------------------------------------------------------------------------
    */

    Route::resource('icclaim-status', ICClaimStatusController::class);

    /*
    |--------------------------------------------------------------------------
    | Discharge Status Controller Route
    |--------------------------------------------------------------------------
    */

    Route::resource('discharge-status', DischargeStatusController::class);
    Route::put('update-discharge-status/{id}', [DischargeStatusController::class, 'updateDischargeStatus'])->name('discharge-status.update-discharge-status');

    /*
    |--------------------------------------------------------------------------
    | Claim Processing Controller Route
    |--------------------------------------------------------------------------
    */

    Route::resource('claim-processing', ClaimProcessingController::class);
    Route::put('claim-processing-update/{id}', [ClaimProcessingController::class, 'updateClaimProcessing'])->name('claim-processing.claim-processing-update');

    Route::resource('assessment-form', AssessmentFormController::class);

    Route::get('claims/bill-entry', [ClaimController::class, 'billEntry'])->name('bill-entry');

    Route::resource('bill-entries', BillEntryController::class);

    Route::get('tpa-delete-file/{id}/{field}', [TpaCompanyController::class, 'deleteFile'])->name('delete-tpa-file');

    Route::resource('tpa', TpaCompanyController::class);


    /*
    |--------------------------------------------------------------------------
    | Claims Route
    |--------------------------------------------------------------------------
    */


    Route::get('claims/processing', [ClaimController::class, 'processing'])->name('claims.processing');
    Route::post('claims/processing', [ClaimController::class, 'saveClaimProcessing'])->name('claims.processing');
    Route::get('claims/assessment-status', [ClaimController::class, 'assessmentStatus'])->name('claims.assessment-status');



    Route::put('claims/update-insurance-policy/{id}', [ClaimController::class, 'updateInsurancePolicy'])->name('claims.update-insurance-policy');



    Route::get('claimants/lending-status/{id}', [ClaimantController::class, 'lendingStatus'])->name('claimants.lending-status');
    Route::get('claimants/discharge-status/{id}', [ClaimantController::class, 'dischargeStatus'])->name('claimants.discharge-status');
    Route::post('claimants/discharge-status/{id}', [ClaimantController::class, 'saveDischargeStatus'])->name('claimants.save-discharge-status');
    Route::post('claimants/lending-status/{id}', [ClaimantController::class, 'saveLendingStatus'])->name('claimants.save-lending-tatus');

    Route::get('claimants/patient/{id}', [ClaimantController::class, 'fetchPaitientData'])->name('claimants.fetch-patient');

    Route::get('claimants/claimant/{id}', [ClaimantController::class, 'fetchClaimentData'])->name('claimants.fetch-claimant');

    Route::post('claimants/update-borrower-details/{id}', [ClaimantController::class, 'borrowerDetails'])->name('claimants.update-borrower-details');

    Route::post('claims/save_assesment_status',[ClaimController::class,'saveAssesmentStatus'])->name('claims.save_assesment_status');


    /*
    |--------------------------------------------------------------------------
    | Patients Route
    |--------------------------------------------------------------------------
    */
    Route::get('patients/documents-reimbursement', [PatientController::class, 'documentsReimbursement']);

    Route::post('patients/documents-reimbursement/{id}', [PatientController::class, 'saveDocumentsReimbursement'])->name('patients.save-documents-reimbursement');
    Route::post('patients/documents-reimbursement-1/{id}', [PatientController::class, 'saveDocumentsReimbursement1'])->name('patients.save-documents-reimbursement-1');
    Route::post('patients/documents-reimbursement-2/{id}', [PatientController::class, 'saveDocumentsReimbursement2'])->name('patients.save-documents-reimbursement-2');
    Route::post('patients/documents-reimbursement-3/{id}', [PatientController::class, 'saveDocumentsReimbursement3'])->name('patients.save-documents-reimbursement-3');
    Route::post('patients/documents-reimbursement-4/{id}', [PatientController::class, 'saveDocumentsReimbursement4'])->name('patients.save-documents-reimbursement-4');
    Route::resource('patients', PatientController::class);

    /*
    |--------------------------------------------------------------------------
    | Authorization Rights Route
    |--------------------------------------------------------------------------
    */

    Route::resource('hospital-authorizations', HospitalAuthorizationController::class);
    Route::resource('hospital-tie-up-authorizations', HospitalTieUpAuthorizationController::class);
    Route::resource('hospital-empstatus-authorizations', HospitalEmanelmentStatusAuthorizationController::class);
    Route::resource('claimant-authorizations', ClaimantAuthorizationController::class);
    Route::resource('borrower-authorizations', BorrowerAuthorizationController::class);


    Route::resource('assigning-pre-assessment', AssigningStatusPreAssessmentController::class);
    Route::resource('assigning-claim-processing', AssigningStatusClaimProcessingController::class);
    Route::resource('assigning-final-assessment', AssigningStatusFinalAssessmentController::class);


    Route::resource('pending-pre-assessment', PendingPreAssessmentController::class);
    Route::resource('pending-claim-processing', PendingClaimProcessingController::class);
    Route::resource('pending-final-assessment', PendingFinalAssessmentController::class);


    /*
    |--------------------------------------------------------------------------
    | Associate partners Route
    |--------------------------------------------------------------------------
    */

    Route::resource('associate-partners', AssociatePartnerController::class);

    Route::put('associate-partners/vendor-services/{id}', [AssociatePartnerController::class, 'updateVendorServices'])->name('associate-partners.vendor-services');
    Route::put('associate-partners/sales-services/{id}', [AssociatePartnerController::class, 'updateSalesServices'])->name('associate-partners.sales-services');

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

    Route::get('get.hospital-doctors/{id}', [UtilityController::class,'getHospitalDoctors'])->name('get.hospital-doctors');

    Route::post('hospitals/doctor-delete/{id}',[HospitalController::class,'deleteDoctor'])->name('hospitals.doctor-delete');

    Route::get('get-retail-policies/{policy}', [UtilityController::class,'getRetailPolicies'])->name('get.retail_policies');

    Route::get('dataforselect2', [UtilityController::class,'getdataforselect2'])->name('dataforselect2');

});
