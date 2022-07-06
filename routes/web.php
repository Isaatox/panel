<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Auth::routes();
Route::redirect('/', '/home');

Auth::routes(['verify' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/qcm/{qcm}', [App\Http\Controllers\QCMController::class, 'index'])->name('qcm')->middleware(['auth']);
Route::post('/qcm/{qcm}', [App\Http\Controllers\QCMController::class, 'store'])->name('qcm.store')->middleware(['auth']);
Route::get('/qcm', [App\Http\Controllers\QCMController::class, 'create'])->name('qcm.create')->middleware(['auth']);
Route::get('/discord', [\App\Http\Controllers\HomeController::class, 'discord'])->name('discord')->middleware(['auth']);
Route::get('/discord/redirect', [\App\Http\Controllers\HomeController::class, 'callback'])->middleware(['auth']);
Route::get('/admin', [\App\Http\Controllers\HomeController::class, 'admin'])->middleware(\App\Http\Middleware\Admin::class)->name('admin');
Route::get('/admin/{question}', [\App\Http\Controllers\HomeController::class, 'show'])->middleware(\App\Http\Middleware\Admin::class)->name('question.edit');
Route::post('/admin/{question}', [\App\Http\Controllers\HomeController::class, 'edit'])->middleware(\App\Http\Middleware\Admin::class);

Route::get('/admin/question/add',[\App\Http\Controllers\HomeController::class, 'view'])->middleware(\App\Http\Middleware\Admin::class)->name('question.view');
Route::post('/admin/question/add/approve', [\App\Http\Controllers\HomeController::class, 'add'])->middleware(\App\Http\Middleware\Admin::class)->name('question.add');
Route::get('/admin/question/delete/{question}',[\App\Http\Controllers\HomeController::class, 'supr'])->middleware(\App\Http\Middleware\Admin::class)->name('question.delete');
