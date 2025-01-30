<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource('exams', ExamController::class);
Route::resource('grades', GradeController::class);
Route::get('/upload-mark', [ExamController::class, 'uploadMark']);
Route::post('/upload-marks', [ExamController::class, 'uploadMarks'])->name('uploadMarks');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');


