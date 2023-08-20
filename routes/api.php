<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//class routs
Route::get('clss', 'ClssController@getAllClss');
Route::get('clss/{id}', 'ClssController@getClss');
Route::post('clss', 'ClssController@createClss');
Route::put('clss/{id}', 'ClssController@updateClss');
Route::delete('clss/{id}','ClssController@deleteClss');

//vote routs
Route::get('vote', 'VoteController@getAllVote');
Route::get('vote/{id}', 'VoteController@getVote');
Route::post('vote', 'VoteController@createVote');
Route::put('vote/{id}', 'VoteController@updateVote');
Route::delete('vote/{id}','VoteController@deleteVote');

//course routs
Route::get('course', 'CourseController@getAllCourse');
Route::get('course/{id}', 'CourseController@getCourse');
Route::post('course', 'CourseController@createCourse');
Route::put('course/{id}', 'CourseController@updateCourse');
Route::delete('course/{id}','CourseController@deleteCourse');

//address routs
Route::get('address', 'AddressController@getAllAddress');
Route::get('address/{id}', 'AddressController@getAddress');
Route::post('address', 'AddressController@createAddress');
Route::put('address/{id}', 'AddressController@updateAddress');
Route::delete('address/{id}','AddressController@deleteAddress');

//address routs
Route::get('account', 'AccountController@getAllAccount');
Route::get('account/{id}', 'AccountController@getAccount');
Route::post('account', 'AccountController@createAccount');
Route::put('account/{id}', 'AccountController@updateAccount');
Route::delete('account/{id}','AccountController@deleteAccount');

//role routs
Route::get('role', 'RoleController@getAllrole');
Route::get('role/{id}', 'RoleController@getrole');
Route::post('role', 'RoleController@createrole');
Route::put('role/{id}', 'RoleController@updaterole');
Route::delete('role/{id}','RoleController@deleterole');


// user routs
Route::post('/register','UserController@register');
Route::post('/login','UserController@authenticate');
Route::get('/userlist', 'UserController@userlist');
Route::post('/getuser', 'UserController@getauthuser');
Route::post('/userupdate', 'UserController@userupdate');
Route::post('/changepassword/{id}', 'UserController@changepassword');
Route::get('/userdelete/{id}', 'UserController@userdelete');
Route::get('open', 'DataController@open');
Route::get('/userprofile/{id}', 'UserController@userprofile');
Route::post('/updatebalance', 'UserController@updateBalance');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
});

//message routs
Route::get('message/{userid}/{senderid}', 'MessageController@getmessage');
Route::post('newmessage', 'MessageController@createmessage');
Route::put('updatemessage/{id}', 'MessageController@updatemessage');
Route::delete('delmessage/{id}','MessageController@deletemessage');
Route::get('messagelist/{id}', 'MessageController@getmessagelist');


//notification routs
Route::get('notification', 'NotificationController@getAllnotification');
Route::get('notification/{id}', 'NotificationController@getnotification');
Route::post('notification', 'NotificationController@createnotification');
Route::put('notification/{id}', 'NotificationController@updatenotification');
Route::delete('notification/{id}','NotificationController@deletenotification');


//post routs
Route::get('post', 'PostController@getAllpost');
Route::get('post/{id}', 'PostController@getpost');
Route::post('post', 'PostController@createpost');
Route::put('post/{id}', 'PostController@updatepost');
Route::delete('post/{id}','PostController@deletepost');

//advertisement routs
Route::get('advertisement', 'AdvertisementController@getAlladvertisement');
Route::get('advertisement/{id}', 'AdvertisementController@getadvertisement');
Route::post('advertisement', 'AdvertisementController@createadvertisement');
Route::put('advertisement/{id}', 'AdvertisementController@updateadvertisement');
Route::delete('advertisement/{id}','AdvertisementController@deleteadvertisement');


//review routs
Route::get('review', 'ReviewController@getAllreview');
Route::get('review/{id}', 'ReviewController@getreview');
Route::post('review', 'ReviewController@createreview');
Route::put('review/{id}', 'ReviewController@updatereview');
Route::delete('review/{id}','ReviewController@deletereview');

//comment routs
Route::get('comment', 'CommentController@getAllcomment');
Route::get('comment/{id}', 'CommentController@getcomment');
Route::post('comment', 'CommentController@createcomment');
Route::put('comment/{id}', 'CommentController@updatecomment');
Route::delete('comment/{id}','CommentController@deletecomment');

//package routs
Route::post('package', 'PackageController@createpackage');
Route::get('packagelist/{id}', 'PackageController@packageList');
Route::get('getpackage/{id}', 'PackageController@getPackage');
Route::get('allpackage', 'PackageController@allPackage');
