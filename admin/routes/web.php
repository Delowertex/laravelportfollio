<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\LoginController;


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

Route::get('/', [HomeController::class, 'homeIndex'])->middleware('loginCheck');
Route::get('/visitor', [VisitorController::class, 'visitIndex'])->middleware('loginCheck');

//Admin Panel Service Management
Route::get('/service', [ServiceController::class, 'serviceIndex'])->middleware('loginCheck');
Route::get('/getservicedata', [ServiceController::class, 'getServiceData'])->middleware('loginCheck');
Route::post('/deleteservice', [ServiceController::class, 'serviceDelete'])->middleware('loginCheck');
Route::post('/detailsservice', [ServiceController::class, 'getServiceDatails'])->middleware('loginCheck');
Route::post('/updateservice', [ServiceController::class, 'serviceUpdate'])->middleware('loginCheck');
Route::post('/addservice', [ServiceController::class, 'serviceAdd'])->middleware('loginCheck');

//Admin Panel Course Management
Route::get('/courses', [CourseController::class, 'courseIndex'])->middleware('loginCheck');
Route::get('/getcoursedata', [CourseController::class, 'getCourseData'])->middleware('loginCheck');
Route::post('/coursdetail', [CourseController::class, 'getCourseDatails'])->middleware('loginCheck');
Route::post('/deleteservice', [CourseController::class, 'courseDelete'])->middleware('loginCheck');
Route::post('/updatecourse', [CourseController::class, 'courseUpdate'])->middleware('loginCheck');
Route::post('/addcourse', [CourseController::class, 'courseAdd'])->middleware('loginCheck');

//Admin Panel Others
//Route::get('/services', [ServicesController::class, 'ServiceIndex']);
Route::get('/getservicdata', [ServicesController::class, 'getServiceData'])->middleware('loginCheck');
Route::post('/servicedelete', [ServicesController::class, 'getserviceDelete'])->middleware('loginCheck');
Route::post('/servicedetail', [ServicesController::class, 'getServiceDetails'])->middleware('loginCheck');
Route::post('/serviceupdate', [ServicesController::class, 'getserviceUpdate'])->middleware('loginCheck');
Route::post('/serviceadded', [ServicesController::class, 'getserviceAdded'])->middleware('loginCheck');

//Admin Panel Project Section
Route::get('/project', [ProjectController::class, 'projectIndex'])->middleware('loginCheck');
Route::get('/getprojectdata', [ProjectController::class, 'getProjectData'])->middleware('loginCheck');
Route::post('/projectdelete', [ProjectController::class, 'getProjectDelete'])->middleware('loginCheck'); 
Route::post('/projectdetail', [ProjectController::class, 'getProjectDelail'])->middleware('loginCheck');
Route::post('/projectupdate', [ProjectController::class, 'getprojectUpdate'])->middleware('loginCheck');
Route::post('/productadded', [ProjectController::class, 'productsAdded'])->middleware('loginCheck');


//Admin Panel Section
Route::get('/contact', [ContactController::class, 'contactIndex'])->middleware('loginCheck');
Route::get('/getcontactdata', [ContactController::class, 'getContactData'])->middleware('loginCheck');
Route::post('/contactdelete', [ContactController::class, 'getContactDelete'])->middleware('loginCheck');

//admin panel review section
Route::get('/review', [ReviewController::class, 'reviewIndex'])->middleware('loginCheck');
Route::get('/getreviewtdata', [ReviewController::class, 'getReviewtData'])->middleware('loginCheck');
Route::post('/reviewdelete', [ReviewController::class, 'getReviewDelete'])->middleware('loginCheck');
Route::post('/reviewdetail', [ReviewController::class, 'getReviewtDelail'])->middleware('loginCheck');
Route::post('/reviewupdate', [ReviewController::class, 'getReviewtUpdate'])->middleware('loginCheck');
Route::post('/reviewadded', [ReviewController::class, 'reviewsAdd'])->middleware('loginCheck');


//Admin Login
Route::get('/login', [LoginController::class, 'loginUser']);
Route::post('/onlogin', [LoginController::class, 'onLogin']);
Route::get('/onlogout', [LoginController::class, 'onLogout']);


Route::get('/gallery', [PhotoController::class, 'photoIndex']);
Route::post('/uploadphoto', [PhotoController::class, 'uploadPhoto']);
Route::get('/photojson', [PhotoController::class, 'PhotoJson']);
Route::get('/PhotoJsonbyid/{id}', [PhotoController::class, 'PhotoJsonbyid']);

