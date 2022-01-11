<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/**
 *  Users API
 */

Route::get('v1/get-users', [\App\Http\Controllers\Api\UserApiController::class, 'getAllUsers']);;
Route::get('v1/get-recent-users', [\App\Http\Controllers\Api\UserApiController::class, 'getRecentUsers']);;
Route::get('v1/get-user-details/{id}', [\App\Http\Controllers\Api\UserApiController::class, 'getUserDetails']);
Route::get('v1/get-user-transactions-summary/{user_id}', [\App\Http\Controllers\Api\UserApiController::class, 'getUserTransactionsSummary']);
Route::post('v1/user-create', [\App\Http\Controllers\Api\UserApiController::class, 'createUser']);
Route::post('v1/user-edit', [\App\Http\Controllers\Api\UserApiController::class, 'updateUser']);
Route::post('v1/user-delete', [\App\Http\Controllers\Api\UserApiController::class, 'deleteUser']);
Route::post('v1/user-search', [\App\Http\Controllers\Api\UserApiController::class, 'searchUser']);
Route::get('v1/user-statistics/{user_id}', [\App\Http\Controllers\Api\UserApiController::class, 'userStatistics']);
Route::post('v1/user-reset-password', [\App\Http\Controllers\Api\UserApiController::class, 'resetPassword']);
Route::post('v1/user-change-password', [\App\Http\Controllers\Api\UserApiController::class, 'changePassword']);
Route::post('search-music', [\App\Http\Controllers\Api\UserApiController::class, 'searchUsers']);


/*
 * Admin API
 */
Route::post('v1/admin-create', [\App\Http\Controllers\Api\AdminApiController::class, 'createAdmin']);
Route::get('v1/admins-get-all', [\App\Http\Controllers\Api\AdminApiController::class, 'getAllAdmins']);
Route::get('v1/get-recent-admins', [\App\Http\Controllers\Api\AdminApiController::class, 'getRecentAdmins']);;
Route::post('v1/admin-update', [\App\Http\Controllers\Api\AdminApiController::class, 'updateAdmin']);
Route::get('v1/admin-details/{id}', [\App\Http\Controllers\Api\AdminApiController::class, 'getAdminDetails']);
Route::post('v1/admin-delete', [\App\Http\Controllers\Api\AdminApiController::class, 'deleteAdmin']);
Route::post('v1/admin-search', [\App\Http\Controllers\Api\AdminApiController::class, 'searchAdmin']);
Route::post('v1/admin-change-password', [\App\Http\Controllers\Api\AdminApiController::class, 'changePassword']);
Route::post('v1/admin-reset-password', [\App\Http\Controllers\Api\AdminApiController::class, 'resetPassword']);

/*
 * Countries API
 */
Route::post('v1/country-create', [\App\Http\Controllers\Api\CountryApiController::class, 'createCountry']);
Route::get('v1/countries-get-all', [\App\Http\Controllers\Api\CountryApiController::class, 'getAllCountries']);
Route::get('v1/countries-get-recent', [\App\Http\Controllers\Api\CountryApiController::class, 'getRecentCountries']);
Route::post('v1/country-update', [\App\Http\Controllers\Api\CountryApiController::class, 'updateCountry']);
Route::get('v1/country-details/{id}', [\App\Http\Controllers\Api\CountryApiController::class, 'getCountryDetails']);
Route::post('v1/country-delete', [\App\Http\Controllers\Api\CountryApiController::class, 'deleteCountry']);
Route::post('v1/countries-search', [\App\Http\Controllers\Api\CountryApiController::class, 'searchAdminCountry']);



/*
 * Payment Methods API
 */
Route::get('v1/payment-methods-list', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'getPaymentMethodsList']);
Route::get('v1/country-payment-methods', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'getCountryPaymentMethods']);
Route::get('v1/get-country-payment-methods/{id}', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'countryPaymentMethods']);
Route::get('v1/payment-methods-details/{id}', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'PaymentMethodDetails']);
Route::post('v1/payment-methods-create', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'createPaymentMethods']);
Route::post('v1/payment-methods-edit', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'updatePaymentMethods']);
Route::post('v1/payment-methods-delete', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'deletePaymentMethods']);
Route::post('v1/payment-methods-search', [\App\Http\Controllers\Api\PaymentMethodApiController::class, 'searchPaymentMethods']);


/*
 * Job Listing API
 */
Route::post('v1/job-listing-create', [\App\Http\Controllers\Api\JobListingApiController::class, 'createJobListing']);
Route::get('v1/job-listing-get-all', [\App\Http\Controllers\Api\JobListingApiController::class, 'getAllJobListings']);
Route::get('v1/open-job-listing-get-all', [\App\Http\Controllers\Api\JobListingApiController::class, 'getAllOpenJobListings']);
Route::get('v1/category-job-listing/{category_id}', [\App\Http\Controllers\Api\JobListingApiController::class, 'categoryJobListings']);
Route::get('v1/get-recent-job-listings', [\App\Http\Controllers\Api\JobListingApiController::class, 'getRecentJobListings']);;
Route::post('v1/job-listing-update', [\App\Http\Controllers\Api\JobListingApiController::class, 'updateJobListing']);
Route::get('v1/job-listing-details/{id}', [\App\Http\Controllers\Api\JobListingApiController::class, 'getJobListingDetails']);
Route::post('v1/job-listing-delete', [\App\Http\Controllers\Api\JobListingApiController::class, 'deleteJobListing']);
Route::post('v1/job-listing-search', [\App\Http\Controllers\Api\JobListingApiController::class, 'searchJobListing']);
