<?php

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
    return view('welcome');
});
Route::get('/firedata', 'HomeController@getTables')->name('firedata');
Route::get('/victimsdata', 'HomeController@getVictimsData')->name('victimsdata');
Route::get('/victimsdata-more-info', 'HomeController@getMoreInfo')->name('victimsdata-more-info');
Route::get('/victims-more-info-socialwork', 'HomeController@getMoreInfoSocialWork')->name('victims-more-info-socialwork');

Route::get('/final-list', 'HomeController@getFinalList')->name('final-list');
Route::get('/editdata', 'HomeController@getEditList')->name('editdata');
Route::get('/verifiedlist', 'HomeController@getVerifiedList')->name('verifiedlist');
Route::get('/qrcode-id-list', 'HomeController@getQRCodes')->name('qrcode-id-list');
Route::get('/assistance', 'HomeController@getAssistanceSummary')->name('assitance');

Route::get('/search', 'HomeController@search')->name('firedata');
Route::get('/search-victims-info', 'HomeController@searchInfo')->name('victimsdata');
Route::get('/search-victims-more-info', 'HomeController@searchMoreInfo')->name('victimsdata-more-info');
Route::get('/search-victims-more-info-socialwork', 'HomeController@searchMoreInfoSocialWork')->name('victims-more-info-socialwork');
Route::get('/search-edit-data', 'HomeController@searchEditData')->name('editdata');
Route::get('/search-partial-list', 'HomeController@searchPartialList')->name('final-list');
Route::get('/search-verified-list', 'HomeController@searchVerifiedList')->name('verifiedlist');
Route::get('/search-assistance-list', 'HomeController@searchAssistance')->name('assistance');

Route::get('/editdata/delete', 'HomeController@delete')->name('editdata');
Route::get('/editdata/update', 'HomeController@updatePage')->name('updatedata');
Route::get('/editdata/update/success', 'HomeController@updateData')->name('editdata');

Route::get('/final-list/pdf', 'HomeController@pdf');
Route::get('/list/verified-pdf', 'HomeController@verifiedPdf');
Route::get('/list/unverified-pdf', 'HomeController@unverifiedPdf');
Route::get('/list/resident-category-pdf', 'HomeController@residentCategoryPdf');
Route::get('/qrcode-id-list/qrcode-id-pdf', 'HomeController@QRCodeIDspdf');
Route::get('/assistance/assistance-pdf', 'HomeController@assistancePdf');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
