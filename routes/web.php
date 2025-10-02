<?php

use App\Http\Controllers\CurriculumController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CurriculumController::class, 'index'])->name('home');
Route::post('/submit-curriculum', [CurriculumController::class, 'store']);
