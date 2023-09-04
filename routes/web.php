<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Task_statusController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckRole;

// ログインしていない場合のミドルウェアグループ

Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'showLogin'])->name('login');
    Route::post('/toppage', [UserController::class, 'exeLogin'])->name('top');
    Route::get('/reset', [UserController::class, 'showReset'])->name('reset');
    Route::post('/reset', [UserController::class, 'exeReset'])->name('pass_reset');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/top', [UserController::class, 'showTop'])->name('user.toppage');
    // ログアウト
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    // システム管理者向けルート
    Route::middleware(['checkRole:0'])->group(function () {
        Route::get('/list_user', [UserController::class, 'showList_user'])->name('list_user');
        Route::get('/user_edit/{id}', [UserController::class, 'showUser_edit'])->name('user_edit');
        Route::post('/user_update', [UserController::class, 'exeUpdate_user'])->name('user_update');
        Route::post('/user_delete/{id}', [UserController::class, 'exeUser_delete'])->name('user_delete');
        Route::get('/make_user', [UserController::class, 'showMake_user'])->name('make_user');
        Route::post('/list_user', [UserController::class, 'exeMake_user'])->name('create_user');
    });

    // 一般ユーザー向けルート
    Route::middleware(['checkRole:1'])->group(function () {
        Route::get('/task_register', [TaskController::class, 'showTask_register'])->name('task_register');
        Route::get('/task_list', [TaskController::class, 'showTask_list'])->name('task_list');
        Route::post('/task', [TaskController::class, 'exeTask'])->name('task');
        Route::get('/task_edit/{id}', [TaskController::class, 'showTask_edit'])->name('task_edit');
        Route::post('/task_update', [TaskController::class, 'exeTask_update'])->name('task_update');
        Route::post('/task_delete/{id}', [TaskController::class, 'exeDelete'])->name('delete');
        Route::match(['get', 'post'], '/status_register/{id}', [TaskController::class, 'showStatus_register'])->name('status_register');
        Route::get('/status_list', [Task_statusController::class, 'showStatus_list'])->name('status_list');
        Route::post('/status_post', [Task_statusController::class, 'exeStatus_post'])->name('status_post');
        Route::post('/status_delete/{id}', [Task_statusController::class, 'exeStatus_delete'])->name('status_delete');
        Route::get('/status_edit/{id}', [Task_statusController::class, 'showStatus_edit'])->name('status_edit');
        Route::post('/status_update', [Task_statusController::class, 'exeStatus_update'])->name('status_update');
        Route::post('/status_list/increase-like/{id}', [Task_statusController::class, 'increaseLikeCount'])->name('increase-like');
   });

});

