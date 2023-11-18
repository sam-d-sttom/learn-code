<?php

// use TCG\Voyager\Facades\Voyager;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ChapterController;

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();


    //Courses routes
    //All courses
    Route::get('/courses', [CourseController::class, 'index'])->middleware('admin.user');   

    //show create course form
    Route::get('/courses/create', [CourseController::class, 'create'])->middleware('admin.user');   
    
    //store course
    Route::post('/courses', [CourseController::class, 'store'])->middleware('admin.user');   
   
    //show single course
    Route::get('/courses/{course}', [CourseController::class, 'show'])->middleware('admin.user');   
   
    //show edit course form
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware('admin.user');   

    //update course
    Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware('admin.user'); 
    
    //delete course
    Route::delete('/courses/{course}', [CourseController::class, 'delete'])->middleware('admin.user');   


    //chapters routes
    //all chapters
    Route::get('/chapters', [ChapterController::class, 'redirectToCourses'])->middleware('admin.user');

    //view a chapter
    Route::get('/courses/{course}/chapters/view', [ChapterController::class, 'show'])->middleware('admin.user');   

    //show add new chapter form
    Route::get('/courses/{course}/chapters/create', [ChapterController::class, 'create'])->middleware('admin.user'); 
    
    //store new chapter
    Route::post('/courses/{course}/chapters', [ChapterController::class, 'store'])->middleware('admin.user');   

    //show edit chapter form 
    Route::get('/courses/{course}/chapters', [ChapterController::class, 'redirectToCourses'])->middleware('admin.user');   
    Route::get('/courses/{course}/chapters/edit', [ChapterController::class, 'edit'])->middleware('admin.user');   
    
    //update chapter
    Route::get('/chapters/{chapter}', [ChapterController::class, 'redirectToCourses'])->middleware('admin.user');   
    Route::put('/chapters/{chapter}', [ChapterController::class, 'update'])->middleware('admin.user');   
    
    //pay for a chapter
    Route::get('/courses/{course}/chapters/pay', [ChapterController::class, 'pay'])->middleware('admin.user');   

    
    
    //Wallet route
    //show wallet main page
    Route::get('/wallet', [WalletController::class, 'index'])->middleware('admin.user');   

    //show Top up wallet
    Route::get('/wallet/top-up', [WalletController::class, 'topUp'])->middleware('admin.user');   
    
    
    
});  