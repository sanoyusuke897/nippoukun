<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//日報作成
Route::get('/create', [App\Http\Controllers\CreateController::class, 'index'])->name('create');
Route::get('/copy_create/{daily}', [App\Http\Controllers\CreateController::class, 'copy_create'])->name('copy_create');
Route::get('/create_confirm', [App\Http\Controllers\CreateConfirmController::class, 'index'])->name('create_confirm');
Route::post('/create_complete', [App\Http\Controllers\CreateCompleteController::class, 'index'])->name('create_complete');
Route::get('/list', [App\Http\Controllers\ListController::class, 'index'])->name('list');
Route::post('/list_default', [App\Http\Controllers\ListController::class, 'list_default'])->name('list_default');
Route::post('/home_default', [App\Http\Controllers\HomeController::class, 'home_default'])->name('home_default');
Route::get('/daily', [App\Http\Controllers\DailyController::class, 'index'])->name('daily');
Route::get('/template', [App\Http\Controllers\TemplateController::class, 'index'])->name('template');
Route::get('/template_create', [App\Http\Controllers\TemplateCreateController::class, 'index'])->name('template_create');
Route::get('/template_result', [App\Http\Controllers\TemplateResultCreateController::class, 'index'])->name('template_result');
Route::get('/template_detail/{template}', [App\Http\Controllers\TemplateDetailController::class, 'index'])->name('template_detail');
Route::get('/template_edit/{template}', [App\Http\Controllers\TemplateEditController::class, 'index'])->name('template_edit');
Route::get('/template_edit_result/{template}', [App\Http\Controllers\TemplateEditResultController::class, 'index'])->name('template_edit_result');
Route::get('/template_delete/{template}', [App\Http\Controllers\TemplateDeleteCreateController::class, 'index'])->name('template_delete');
Route::post('/template_ajax', [App\Http\Controllers\TemplateController::class, 'template_ajax'])->name('template_ajax');
Route::get('/daily_detail/{daily}', [App\Http\Controllers\DailyDetailController::class, 'index'])->name('daily_detail');
Route::post('/daily_comment', [App\Http\Controllers\DailyDetailController::class, 'daily_comment'])->name('daily_comment');
Route::post('/daily_like', [App\Http\Controllers\DailyDetailController::class, 'daily_like'])->name('daily_like');
Route::post('/daily_like_delete', [App\Http\Controllers\DailyDetailController::class, 'daily_like_delete'])->name('daily_like_delete');
Route::get('/draft', [App\Http\Controllers\DraftController::class, 'index'])->name('draft');
Route::post('/draft_save', [App\Http\Controllers\CreateController::class, 'draft_save'])->name('draft_save');
Route::get('/draft_add', [App\Http\Controllers\CreateController::class, 'draft_add'])->name('draft_add');
Route::post('/draft_delete', [App\Http\Controllers\CreateController::class, 'draft_delete'])->name('draft_delete');

