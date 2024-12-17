<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//三択アプリのログイン後のホーム画面

Route::middleware('auth')->group(function () {
    Route::get('/', App\Http\Controllers\Santaku\IndexController::class)->name('index');

    Route::get('/new', App\Http\Controllers\Santaku\NewController::class)->name('new');

    Route::get('/santakuset', App\Http\Controllers\Santaku\SantakusetController::class)->name('santakuset');
    Route::get('/santakusetbasic', App\Http\Controllers\Santaku\SantakusetbasicController::class)->name('santakusetbasic');

    Route::get('/edit/{questionId}', App\Http\Controllers\Santaku\EditController::class)->name('edit');

    Route::get('/list', App\Http\Controllers\Santaku\ListController::class)->name('list');

    Route::get('/question', App\Http\Controllers\Santaku\QuestionController::class)->name('question');

    Route::get('/questionrandom', App\Http\Controllers\Santaku\QuestionRandomController::class)->name('questionrandom');

    Route::post('/create', App\Http\Controllers\Santaku\CreateController::class)->name('create.index');

    Route::get('/answer', App\Http\Controllers\Santaku\AnswerController::class)->name('answer');

    Route::get('/answerrandom', App\Http\Controllers\Santaku\AnswerRandomController::class)->name('answerrandom');

    Route::post('/answer', App\Http\Controllers\Santaku\AnswerController::class)->name('answer.index');

    Route::post('/answerrandom', App\Http\Controllers\Santaku\AnswerRandomController::class)->name('answerrandom.index');

    Route::post('/questionredoing', App\Http\Controllers\Santaku\QuestionRedoingController::class)->name('questionredoing');
    
    
    Route::get('/update/{questionId}', App\Http\Controllers\Santaku\UpdateController::class)->name('update.put');

    //Route::post('/update', App\Http\Controllers\Santaku\UpdateController::class)->name('update.list');
    Route::put('/update/{questionId}', App\Http\Controllers\Santaku\UpdateController::class)->name('update.put');

    Route::delete('/delete/{questionId}', \App\Http\Controllers\Santaku\DeleteController::class)->name('delete');

    Route::delete('/mymemodelete/{questionId}', \App\Http\Controllers\Santaku\MymemodeleteController::class)->name('mymemodelete');

    Route::delete('/kaizendelete/{questionId}', \App\Http\Controllers\Santaku\KaizendeleteController::class)->name('kaizendelete');

    //とき直しモード
    Route::get('/master', App\Http\Controllers\Santaku\MasterController::class);

    Route::get('/incorrect', App\Http\Controllers\Santaku\IncorrectListController::class);

    Route::get('/kaizen/{questionId}', App\Http\Controllers\Santaku\KaizenController::class)->name('kaizen');
    Route::put('/kaizen/{questionId}', App\Http\Controllers\Santaku\KaizenupdateController::class)->name('kaizen.put');
    Route::get('/kaizenlist', App\Http\Controllers\Santaku\KaizenlistController::class)->name('kaizenlist');


    Route::get('/mymemo/{questionId}', App\Http\Controllers\Santaku\MymemoController::class)->name('mymemo');
    Route::put('/mymemo/{questionId}', App\Http\Controllers\Santaku\MymemoupdateController::class)->name('mymemo.put');
    Route::get('/mymemolist', App\Http\Controllers\Santaku\MymemolistController::class)->name('mymemolist');


    Route::post('/check_register', [App\Http\Controllers\TestController::class, 'register'])->name('check.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
