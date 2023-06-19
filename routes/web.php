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

    // Route::get('/', function () {
    //     return view('welcome');

    // });
// Route::resource('/form', [App\Http\Controllers\HomePageController::class]);
// Route::get('/form', [App\Http\Controllers\Patient\IntakePageController::class, 'index'])->name('form');
// Route::post('/form', [App\Http\Controllers\Patient\IntakePageController::class, 'store'])->name('form.store');
// Route::get('/intake', [App\Http\Controllers\Patient\EmailIntakeController::class, 'index']);
// Route::post('/intake', [App\Http\Controllers\Patient\EmailIntakeController::class, 'store'])->name('intake.store');


// Route::get('/login', function () {return view('auth.login');})->name('login');
// Auth::routes();

// Route::get('/users_profile', [App\Http\Controllers\PatientController::class, 'users_profile'])->name('users_profile');
// Route::get('/home', [App\Http\Controllers\Patient\DashboradController::class, 'index'])->name('home');
// Route::get('/patient_dashboard', [App\Http\Controllers\Patient\DashboradController::class, 'index'])->name('patient_dashboard');
// Route::get('/order_management', [App\Http\Controllers\HomeController::class, 'order_management'])->name('order_management');

// Route::resource('patient_profile', App\Http\Controllers\Patient\PatientProfileController::class);
// Route::post('/patient_profile/updatePassword/{id}', [App\Http\Controllers\Patient\PatientProfileController::class, 'updatePassword'])->name('patient_profile.updatePassword');

// Route::get('/pincode/{pincode}', [App\Http\Controllers\Ajax\AjaxController::class, 'pincode']);

// Route::get('/form/{email}', [App\Http\Controllers\Patient\IntakePageController::class, 'index'])->name('form');

// Route::post('/createmedication', [App\Http\Controllers\PatientController::class, 'createmedication'])->name('admin.createmedication');

// Route::get('/users_form', [App\Http\Controllers\PatientController::class, 'users_form'])->name('users_form');

// Route::webhooks('webhook');
// Route::webhooks('webhookOrder');


// Route::get('/', function () {

//     return view('patient/email');
// });

// Auth::routes();
// Route::get('/login', function () {return view('auth.login');})->name('login');
// Route::post('/intake', [App\Http\Controllers\Patient\EmailIntakeController::class, 'store'])->name('intake.store');
// Route::get('/form/{email}', [App\Http\Controllers\Patient\IntakePageController::class, 'index'])->name('form');
// Route::post('/form', [App\Http\Controllers\Patient\IntakePageController::class, 'store'])->name('form.store');
// Route::get('/users_profile', [App\Http\Controllers\PatientController::class, 'users_profile'])->name('users_profile');
// Route::get('/home', [App\Http\Controllers\Patient\DashboradController::class, 'index'])->name('home');
// Route::get('/patient_dashboard', [App\Http\Controllers\Patient\DashboradController::class, 'index'])->name('patient_dashboard');
// =======
Route::get('/', function () {

    return view('welcome');
})->name('/');

Auth::routes();
Route::get('/login', function () {return view('auth.login');})->name('login');
Route::get('/intake/{mId}/{bId}/{qId}', [App\Http\Controllers\Patient\EmailIntakeController::class, 'create'])->name('intake');
Route::post('/intake', [App\Http\Controllers\Patient\EmailIntakeController::class, 'store'])->name('intake.store');
Route::get('/personalInfo/{email}/{mId}/{bId}/{qId}', [App\Http\Controllers\Patient\PatientPersonalInfo::class, 'index'])->name('personalInfo');
Route::post('/personalInfo', [App\Http\Controllers\Patient\PatientPersonalInfo::class, 'store'])->name('personalInfo.store');
Route::get('/form/{userId}/{mId}/{qId}', [App\Http\Controllers\Patient\IntakePageController::class, 'index'])->name('form');
Route::post('/form', [App\Http\Controllers\Patient\IntakePageController::class, 'store'])->name('form.store');
//After patient login
Route::get('/home', [App\Http\Controllers\Patient\DashboradController::class, 'index'])->name('home');


Route::get('/patient_dashboard', [App\Http\Controllers\Patient\DashboradController::class, 'index'])->name('patient_dashboard');

Route::get('/patient_prescription/{pId}/{cId}', [App\Http\Controllers\Patient\PatientPrescription::class, 'create'])->name('patient_prescription');



Route::get('/users_profile', [App\Http\Controllers\PatientController::class, 'users_profile'])->name('users_profile');

Route::get('/order_management', [App\Http\Controllers\HomeController::class, 'order_management'])->name('order_management');
Route::resource('patient_profile', App\Http\Controllers\Patient\PatientProfileController::class);
Route::post('/patient_profile/updatePassword/{id}', [App\Http\Controllers\Patient\PatientProfileController::class, 'updatePassword'])->name('patient_profile.updatePassword');
Route::get('/pincode/{pincode}', [App\Http\Controllers\Ajax\AjaxController::class, 'pincode']);
Route::post('/createmedication', [App\Http\Controllers\PatientController::class, 'createmedication'])->name('admin.createmedication');
Route::get('/users_form', [App\Http\Controllers\PatientController::class, 'users_form'])->name('users_form');
// Route::webhooks('webhook');
// Route::webhooks('webhookOrder');

Route::webhooks('/webhooks/md-integrations', 'webhookMDI');
Route::webhooks('/webhooks/precision-compounding-pharmacy', 'webhookOrder');

