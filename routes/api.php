<?php

use App\Http\Controllers\CountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('user', UserController::class);

Route::get('department',[DepartmentController::class,'depart_all'])->name('depart_all');
Route::get('all_leaves', [LeaveController::class, 'all_leaves'])->name('all_leaves');
Route::put('update_leave_status/{id}', [LeaveController::class, 'update_leave_status'])->name('update_leave_status');

//count
Route::get('count_user', [CountController::class, 'count_user'])->name('count_user');
Route::get('count_department', [CountController::class, 'count_department'])->name('count_department');

//Leave
Route::get('filter_leave_date', [LeaveController::class, 'filter_leave_date'])->name('filter_leave_date');
Route::get('today_leave_user', [LeaveController::class, 'today_leave_list'])->name('today_leave_list');  
Route::post('add_leave', [LeaveController::class,'add_leave'])->name('add_leave');  



//Employee
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('auth:api')->group(function(){
    Route::get('login_details', [LoginController::class, 'login_details'])->name('login_details');
    
//Firebase Notification
Route::post('save_token',  [NotificationController::class, 'saveToken'])->name('saveToken');
Route::post('send_notification', [NotificationController::class, 'sendNotification'])->name('sendNotification');
    
    
});
