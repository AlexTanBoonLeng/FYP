<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\Auth\LoginController;

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


Route::get('/AARO/Insert_Lecturer', [LecturerController::class, 'create'])->name('Lecturer.create');
Route::post('Lecturer.create', [LecturerController::class, 'store'])->name('Lecturer.store');


Route::get('/AARO/Insert_Subject', [SubjectController::class, 'create'])->name('subject.create');
Route::post('subject.create', [SubjectController::class, 'store'])->name('subject.store');

Route::get('/AARO/StudentIndex', [StudentController::class, 'index'])->name('student.index');
Route::get('/AARO/StudentIndex/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/student/{student}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/AARO/StudentIndex/{student}', [StudentController::class, 'StudentDelete'])->name('student.delete');
Route::get('/StudentSearch', [StudentController::class, 'StudentSearch'])->name('student.search');


Route::get('/AARO/LecturerIndex', [LecturerController::class, 'LecturerIndex'])->name('lecturer.index');
Route::get('/AARO/LecturerEdit/{id}', [LecturerController::class, 'LecturerEdit'])->name('lecturer.edit');
Route::post('AARO/LecturerUpdate/{id}', [LecturerController::class, 'LecturerUpdate'])->name('lecturer.update');
Route::delete('/AARO/LecturerIndex/{id}', [LecturerController::class, 'LecturerDelete'])->name('lecturer.delete');
Route::get('/LecturerSearch', [LecturerController::class, 'LecturerSearch'])->name('lecturer.search');



Route::get('/Login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/Login', [LoginController::class, 'login']);

Route::prefix('student')->group(function () {
   
    Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');
    
});

// Lecturer Routes
Route::prefix('lecturer')->group(function () {
   
    Route::get('/dashboard', 'LecturerController@dashboard')->name('lecturer.dashboard');
  
});

// Logout Route
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/AARO/SubjectIndex', [SubjectController::class, 'SubjectList'])->name('subject.index');
Route::get('/AARO/SubjectEdit/{id}', [SubjectController::class, 'SubjectEdit'])->name('subject.edit');
Route::post('AARO/SubjectUpdate/{id}', [SubjectController::class, 'SubjectUpdate'])->name('subject.update');
Route::delete('/AARO/SubjectDelete/{id}', [SubjectController::class, 'SubjectDelete'])->name('subject.delete');
Route::get('/SubjectSearch', [SubjectController::class, 'SubjectSearch'])->name('subject.search');



// Route to display the timetable
Route::get('/AARO/Insert_Timetable', [TimetableController::class, 'TimetableIndex'])->name('timetable.index');

// Route to add a new subject to the timetable
Route::get('/timetable/create', [TimetableController::class, 'TimetableCreate'])->name('timetable.create');
Route::post('/timetable', [TimetableController::class, 'TimetableStore'])->name('timetable.store');

// Route to edit a subject in the timetable
Route::get('/timetable/{id}/edit', [TimetableController::class, 'edit'])->name('timetable.edit');
Route::put('/timetable/{id}', [TimetableController::class, 'update'])->name('timetable.update');

// Route to delete a subject from the timetable
Route::delete('/timetable/{id}', [TimetableController::class, 'destroy'])->name('timetable.delete');

