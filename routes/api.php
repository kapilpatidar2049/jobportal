<?php

use App\Http\Controllers\Jobportal\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/skills',[JobController::class,'getskills']);