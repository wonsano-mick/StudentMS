<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClubSocietyController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\CurrentClassController;
use App\Http\Controllers\NewAdmissionController;
use App\Http\Controllers\GraduateStudentController;
use App\Http\Controllers\GeneratePDFReportController;
use App\Http\Controllers\HouseOfAffiliationController;

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

Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class);
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('idleLogout', [UserController::class, 'idleLogout'])->name('users.idlelogout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');

    ////////////////////// Class Routes //////////////////////////////////////////////////////////////////////
    Route::resource('/current-class', CurrentClassController::class);
    Route::get('/current-class/class-members/{ClassName}', [CurrentClassController::class, 'classList']);
    Route::delete('/current-class/{id}/delete', [CurrentClassController::class, 'destroy']);

    ////////////////////// Houses of Affiliation /////////////////////////////////////////////////////////////
    Route::resource('/houses', HouseOfAffiliationController::class);
    Route::get('/houses/house-members/{HouseName}', [HouseOfAffiliationController::class, 'houseList']);
    Route::delete('/houses/{id}/destroy', [HouseOfAffiliationController::class, 'destroy'])->name('houses.destroy');
    Route::get('/houses/archive/{HouseName}', [HouseOfAffiliationController::class, 'archive'])->name('houses.archive');

    ////////////////////// Students Routes ////////////////////////////////////////////////////////////////////
    Route::resource('/students', StudentController::class);
    Route::delete('/students/{id}/delete', [StudentController::class, 'destroy']);
    Route::get('/students/profile/{id}', [StudentController::class, 'profile'])->name('students.profile');
    Route::post('/students/delete', [StudentController::class, 'destroy'])->name('students.delete');
    Route::get('/students/sports/delete/{id}', [StudentController::class, 'deleteSports'])->name('sports.deleteSports');
    Route::post('/students/sports/create', [StudentController::class, 'createSports'])->name('students.createSports');
    Route::post('/students/scholarship/create', [StudentController::class, 'createScholarship'])->name('students.createScholarship');
    Route::get('/students/scholarship/delete/{id}', [StudentController::class, 'deleteScholarship'])->name('students.deleteScholarship');
    Route::post('/students/parents/edit/{id}', [StudentController::class, 'editParents'])->name('students.parents');
    Route::post('/students/certificate/create', [StudentController::class, 'createCertificate'])->name('students.createCertificate');
    Route::get('/students/certificate/delete/{id}', [StudentController::class, 'deleteCert'])->name('students.deleteCert');
    Route::post('/students/lastSchool/create', [StudentController::class, 'createLastSchool'])->name('students.createLastSchool');
    Route::post('/students/lastSchool/edit/{id}', [StudentController::class, 'editLastSchool'])->name('students.ediyLastSchool');
    Route::get('/students/confirmDelete/{id}', [StudentController::class, 'deleteShow'])->name('students.delete.deleteShow');
    Route::post('/students/clubs/store', [StudentController::class, 'createClub'])->name('students.createClub');
    Route::get('/students/clubs/delete/{id}', [StudentController::class, 'deleteClub'])->name('students.deleteClub');
    Route::post('/students/positions/store', [StudentController::class, 'createPosition'])->name('students.createPosition');
    Route::get('/students/positions/delete/{id}', [StudentController::class, 'deletePosition'])->name('students.deletePosition');

    ///////////////////////// Set Term / Academic Year ///////////////////////////////////////////////////////////
    Route::get('/term', [StudentController::class, 'term'])->name('term');
    Route::post('/setTerm', [StudentController::class, 'setTerm'])->name('setTerm');

    ///////////////////////////////// Withdrawn Students /////////////////////////////////////////////////////////
    Route::get('/withdrawn-students', [StudentController::class, 'withdrawnStudents'])->name('withdrawn-students');
    Route::get('/withdrawn-students/profile/{id}', [StudentController::class, 'withdrawnProfile'])->name('withdrawn-students.profile');

    //////////////////////////////// Dismissed Students Route ///////////////////////////////////////////////////
    Route::get('/dismissed-students', [StudentController::class, 'dismissedStudents'])->name('dismissed-students');
    Route::get('/dismissed-students/profile/{id}', [StudentController::class, 'dismissedProfile'])->name('dismissed-students.profile');

    //////////////////////////////// Transfered Students Route ///////////////////////////////////////////////////
    Route::get('/transfer-students', [StudentController::class, 'transferStudents'])->name('transfer-students');
    Route::get('/transfer-students/profile/{id}', [StudentController::class, 'transferProfile'])->name('transfer-students.profile');

    ////////////////////////// Graduates Route ////////////////////////////////////////////
    Route::resource('/graduates', GraduateStudentController::class);
    Route::get('/graduates/profile/{id}', [GraduateStudentController::class, 'profile'])->name('graduates.profile');

    ////////////////////// Scholarships Routes ///////////////////////////////////////////////////////////////
    Route::resource('/scholarships', ScholarshipController::class);
    Route::delete('/scholarships/{id}/delete', [ScholarshipController::class, 'destroy'])->name('scholarships.destroy');
    Route::get('/scholarships/beneficiaries/{ScholarshipName}', [ScholarshipController::class, 'scholarshipList']);

    ////////////////////// Clubs Routes ///////////////////////////////////////////////////////////////
    Route::resource('/clubs', ClubSocietyController::class);
    Route::delete('/clubs/{id}/delete', [ClubSocietyController::class, 'destroy'])->name('scholarships.destroy');
    Route::get('/clubs/members/{ClubName}', [ClubSocietyController::class, 'clubList']);

    ////////////////////// New Admission Routes ///////////////////////////////////////////////////////
    Route::resource('/admissions', NewAdmissionController::class);
    Route::get('/admissions/{id}/register', [NewAdmissionController::class, 'register'])->name('admissions.register');
    Route::post('/admissions/registerStudent', [NewAdmissionController::class, 'registerStudent'])->name('admissions.registerStudent');
    Route::get('/admissions.archive', [NewAdmissionController::class, 'archive'])->name('admissions.archive');

    ////////////////////////// Back Up Database ////////////////////////////////
    Route::get('backup-database', [HomeController::class, 'backUpDatabase']);

    ////////////////////// Generate PDF Reports //////////////////////////////////////////////////////////////
    Route::get('/print-class-list/{class_name}', [GeneratePDFReportController::class, 'printClassList']);
    Route::get('/students/print/{id}', [GeneratePDFReportController::class, 'printStudentProfile'])->name('students.print');
    Route::get('/admissions/print/{id}', [GeneratePDFReportController::class, 'admissionLetter'])->name('admissions.print');

    ///////////////////// Residence Routes /////////////////////////////////////////////////////////////////////
    Route::get('/residence/{day}', [StudentController::class, 'day'])->name('residence');
    Route::get('/residence/boarders/{boarding}', [StudentController::class, 'boarding'])->name('residence.boarders');
    Route::get('/residence/archive/{status}', [StudentController::class, 'archive'])->name('residence.archive');

    ////////////////////// Student Population Statistics /////////////////////////////////////////////////////
    Route::get('/males/population', [StudentController::class, 'males'])->name('males.population');

    ////////////////////// Contact Route ////////////////////////////////////////////////////////////////////
    Route::resource('/contact', ContactController::class);
});

Auth::routes();

/////////////////////// School Info //////////////////////////////////////////////////////////////////////
Route::resource('/schoolInfo', SchoolController::class);
