<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AAROController;
use App\Http\Controllers\LoginController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/AARO/Insert_Student', [StudentController::class, 'create'])->name('Insert_Student');
Route::post('Insert_Student', [StudentController::class, 'store'])->name('Student_InsertNewStudent');
Route::get('/AARO/StudentIndex', [StudentController::class, 'index'])->name('student.index');
Route::delete('/AARO/StudentIndex/{student}', [StudentController::class, 'StudentDelete'])->name('student.delete');
Route::get('/StudentSearch', [StudentController::class, 'StudentSearch'])->name('student.search');



Route::get('/AARO/Insert_Lecturer', [LecturerController::class, 'create'])->name('Lecturer.create');
Route::post('Lecturer.create', [LecturerController::class, 'store'])->name('Lecturer.store');
Route::get('/AARO/LecturerIndex', [LecturerController::class, 'LecturerIndex'])->name('lecturer.index');
Route::get('/AARO/LecturerEdit/{id}', [LecturerController::class, 'LecturerEdit'])->name('lecturer.edit');
Route::post('AARO/LecturerUpdate/{id}', [LecturerController::class, 'LecturerUpdate'])->name('lecturer.update');
Route::delete('/AARO/LecturerDelete/{id}', [LecturerController::class, 'LecturerDelete'])->name('lecturer.delete');
Route::get('/LecturerSearch', [LecturerController::class, 'LecturerSearch'])->name('lecturer.search');



Route::get('/AARO/Insert_Subject', [SubjectController::class, 'create'])->name('subject.create');
Route::post('subject.create', [SubjectController::class, 'store'])->name('subject.store');
Route::get('/AARO/SubjectIndex', [SubjectController::class, 'SubjectList'])->name('subject.index');
Route::get('/AARO/SubjectEdit/{id}', [SubjectController::class, 'SubjectEdit'])->name('subject.edit');
Route::post('AARO/SubjectUpdate/{id}', [SubjectController::class, 'SubjectUpdate'])->name('subject.update');
Route::delete('/AARO/SubjectDelete/{id}', [SubjectController::class, 'SubjectDelete'])->name('subject.delete');
Route::get('/SubjectSearch', [SubjectController::class, 'SubjectSearch'])->name('subject.search');



Route::post('/timetable/enroll',[TimetableController::class, 'TimetableEnroll'])->name('timetable.enroll');


Route::get('/AARO/Insert_AARO', [AAROController::class, 'create'])->name('AARO.create');
Route::post('AARO.create', [AAROController::class, 'store'])->name('AARO.store');
Route::get('/AARO/AAROIndex', [AAROController::class, 'AAROIndex'])->name('AARO.index');
Route::delete('/AARO/AAROIndex/{AAROID}', [AAROController::class, 'AARODelete'])->name('AARO.delete');
Route::get('/AAROSearch', [AAROController::class, 'AAROSearch'])->name('AARO.search');



Route::middleware('guest')->group(function () {
    Route::get('/Login', [LoginController::class, 'showLoginForm'])->name('login');
    // Other routes...
});


Route::post('/Login', [LoginController::class, 'login']);
Route::post('/Logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/Student/Dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');


Route::get('/Student/StudentEdit/{id}', [StudentController::class, 'StudentEdit'])->name('student.edit');
Route::Post('/Student/StudentUpdate/{id}', [StudentController::class, 'update'])->name('student.update');

Route::get('/Lecturer/LecturerDashboard', [LecturerController::class, 'LecturerDashboard'])->name('lecturer.dashboard');
Route::get('/Lecturer/viewTimetable', [LecturerController::class, 'viewTimetable'])->name('lecturer.timetable');

Route::get('/', [TimetableController::class, 'index'])->name('subject.list');
Route::post('/AARO/SubjectIndex', [TimetableController::class, 'enrollSubjects'])->name('timetable.enroll');