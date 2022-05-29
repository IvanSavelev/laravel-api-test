<?php

declare(strict_types=1);

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentToAssessmentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

Route::get('/assessment', [AssessmentController::class, 'index'])->name('assessment.index');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{id_student}', [StudentController::class, 'show'])->name('students.show');

Route::post('/students_to_assessments', [StudentToAssessmentController::class, 'store'])->name('students_to_assessments.store');
