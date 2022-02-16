<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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



//register and login

Route::get('/', [UserController::class, 'index']); 

Route::get('/index', [UserController::class, 'index']); 

Route::post('/getCategoryByName', [UserController::class, 'getCategoryTaskList']); 

Route::get('/register', [UserController::class, 'register']); 

Route::post('post-register',[UserController::class, 'postRegister']); 

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('post-login', [UserController::class, 'postLogin']); 

Route::get('logout', [UserController::class, 'logout']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

    Route::get('/index',[UserController::class, 'adminIndex']);

    //admin profile

    Route::get('/profile-admin', [UserController::class, 'profileAdmin'])->name('profile');

    //users details

    Route::get('/user-details',[UserController::class, 'userDetails']); 

    //active and inactive of user

    Route::post('/changeStatusOfUser', [UserController::class, 'changeStatusOfUser']);

    //task by user

    Route::get('/add-task',[UserController::class, 'adminAddTask']); 

    Route::post('/add-task-post',[UserController::class, 'adminAddTaskPost']); 

    Route::get('/task-details', [UserController::class, 'adminTaskDetails']); 

    Route::get('/edit-task/{id}', [UserController::class, 'taskEdit']);  

    Route::post('/update-task/{id}', [UserController::class, 'taskUpdate']); 

    Route::get('/delete-task/{taskId}', [UserController::class, 'taskDelete']); 


    //Manage task menu

    Route::get('/manage-task-menu', [UserController::class, 'manageTaskMenu']);  

    Route::post('/saveTask', [UserController::class, 'saveTaskMenu']);  


});

