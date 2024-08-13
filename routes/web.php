<?php

use App\Http\Controllers\Ambulance\AmbulanceControllerNoApi;
use App\Http\Controllers\Calls\CallsControllerNoApi;
use App\Http\Controllers\Conductor\ConductorControllerNoApi;
use App\Http\Controllers\Dashboard\DashboardControllerNoApi;
use App\Http\Controllers\Dispatch\DispatchControllerNoApi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RolesPermisos\RolePermissionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hospital\HospitalControllerNoApi;
use App\Http\Controllers\Incident\IncidentControllerNoApi;
use App\Http\Controllers\Pages\PagesControllerNoApi;
use App\Http\Controllers\Patient\PatientControllerNoApi;
use App\Http\Controllers\Response\ResponseControllerNoApi;
use App\Http\Controllers\Usuario\UserControllerNoApi;
use App\Models\User;

Auth::routes();

Route::get('/', [HomeController::class, 'root'])->name('root');

Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [HomeController::class, 'index'])->where('any', '^(?!users|roles|patient|incident|calls|conductor|ambulance|dispatch|dashboards).*$')->name('index');
// Route::resource('roles', RolePermissionsController::class);
// Route::resource('users', UserControllerNoApi::class);
// Route::resource('patient', PatientControllerNoApi::class);
// Route::resource('incident', IncidentControllerNoApi::class);
// Route::resource('calls', CallsControllerNoApi::class);
// Route::resource('conductor', ConductorControllerNoApi::class);
// Route::resource('ambulance', AmbulanceControllerNoApi::class);
// Route::resource('dispatch', DispatchControllerNoApi::class);
// Route::resource('hospital', HospitalControllerNoApi::class);
// Route::resource('response', ResponseControllerNoApi::class);
// Route::resource('pages', PagesControllerNoApi::class);
// Route::get('/dashboard', [DashboardControllerNoApi::class, 'index'])->name('/dashboard');

// Route::get('/', function () {
//     $user = auth()->user();
//     if(!canAccessPage($user->role, 'root')){
//         abort(403,'No tienes permiso para acceder a esta página.');
//     } else {
//         return app(HomeController::class)->root();
//     }
// })->name('root');


// Route::get('users', [UserControllerNoApi::class, 'index'])->name('users.index');
// Route::get('users/{user}/edit', [UserControllerNoApi::class, 'edit'])->name('users.edit');
// Route::delete('users/{user}', [UserControllerNoApi::class, 'destroy'])->name('users.destroy');
// Route::get('users/create', [UserControllerNoApi::class, 'create'])->name('users.create');
Route::put('users/{user}', [UserControllerNoApi::class, 'update'])->name('users.update');
Route::post('users', [UserControllerNoApi::class, 'store'])->name('users.store');

Route::get('users/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'users.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(UserControllerNoApi::class)->create();
})->name('users.create');

Route::get('users/{user}', function ($user_id) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'users.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(UserControllerNoApi::class)->show($user_id);
})->name('users.show');

Route::get('users/{user}/edit', function ($user_id) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'users.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(UserControllerNoApi::class)->edit($user_id);
})->name('users.edit');


Route::delete('users/{user}', function ($user_id) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'users.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(UserControllerNoApi::class)->destroy($user_id);
})->name('users.destroy');

Route::get('users', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'users.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(UserControllerNoApi::class)->index();
})->name('users.index');
// canAccessPage($user->role, 'users.index') ? Route::get('users', [UserControllerNoApi::class, 'index'])->name('users.index') : abort(403, 'No tienes permiso para acceder a esta página.');

Route::get('users/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'users.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(UserControllerNoApi::class)->create();
})->name('users.create');

// Index
Route::get('patient', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'patient.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PatientControllerNoApi::class)->index();
})->name('patient.index');

// Create
Route::get('patient/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'patient.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PatientControllerNoApi::class)->create();
})->name('patient.create');

// Show
Route::get('patient/{patient}', function ($patientId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'patient.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PatientControllerNoApi::class)->show($patientId);
})->name('patient.show');

// Edit
Route::get('patient/{patient}/edit', function ($patientId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'patient.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PatientControllerNoApi::class)->edit($patientId);
})->name('patient.edit');

// Destroy
Route::delete('patient/{patient}', function ($patientId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'patient.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PatientControllerNoApi::class)->destroy($patientId);
})->name('patient.destroy');

// Store
Route::post('patient', [PatientControllerNoApi::class, 'store'])->name('patient.store');

// Update
Route::put('patient/{patient}', [PatientControllerNoApi::class, 'update'])->name('patient.update');


// Index
Route::get('incident', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'incident.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(IncidentControllerNoApi::class)->index();
})->name('incident.index');

// Create
Route::get('incident/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'incident.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(IncidentControllerNoApi::class)->create();
})->name('incident.create');

// Show
Route::get('incident/{incident}', function ($incidentId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'incident.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(IncidentControllerNoApi::class)->show($incidentId);
})->name('incident.show');

// Edit
Route::get('incident/{incident}/edit', function ($incidentId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'incident.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(IncidentControllerNoApi::class)->edit($incidentId);
})->name('incident.edit');

// Destroy
Route::delete('incident/{incident}', function ($incidentId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'incident.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(IncidentControllerNoApi::class)->destroy($incidentId);
})->name('incident.destroy');

// Store
Route::post('incident', [IncidentControllerNoApi::class, 'store'])->name('incident.store');

// Update
Route::put('incident/{incident}', [IncidentControllerNoApi::class, 'update'])->name('incident.update');

// Index
Route::get('calls', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'calls.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(CallsControllerNoApi::class)->index();
})->name('calls.index');

// Create
Route::get('calls/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'calls.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(CallsControllerNoApi::class)->create();
})->name('calls.create');

// Show
Route::get('calls/{call}', function ($callId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'calls.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(CallsControllerNoApi::class)->show($callId);
})->name('calls.show');

// Edit
Route::get('calls/{call}/edit', function ($callId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'calls.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(CallsControllerNoApi::class)->edit($callId);
})->name('calls.edit');

// Destroy
Route::delete('calls/{call}', function ($callId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'calls.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(CallsControllerNoApi::class)->destroy($callId);
})->name('calls.destroy');

// Store
Route::post('calls', [CallsControllerNoApi::class, 'store'])->name('calls.store');

// Update
Route::put('calls/{call}', [CallsControllerNoApi::class, 'update'])->name('calls.update');

// Index
Route::get('conductor', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'conductor.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(ConductorControllerNoApi::class)->index();
})->name('conductor.index');

// Create
Route::get('conductor/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'conductor.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(ConductorControllerNoApi::class)->create();
})->name('conductor.create');

// Show
Route::get('conductor/{conductor}', function ($conductorId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'conductor.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(ConductorControllerNoApi::class)->show($conductorId);
})->name('conductor.show');

// Edit
Route::get('conductor/{conductor}/edit', function ($conductorId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'conductor.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(ConductorControllerNoApi::class)->edit($conductorId);
})->name('conductor.edit');

// Destroy
Route::delete('conductor/{conductor}', function ($conductorId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'conductor.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(ConductorControllerNoApi::class)->destroy($conductorId);
})->name('conductor.destroy');

// Store
Route::post('conductor', [ConductorControllerNoApi::class, 'store'])->name('conductor.store');

// Update
Route::put('conductor/{conductor}', [ConductorControllerNoApi::class, 'update'])->name('conductor.update');

// Index
Route::get('ambulance', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'ambulance.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(AmbulanceControllerNoApi::class)->index();
})->name('ambulance.index');

// Create
Route::get('ambulance/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'ambulance.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(AmbulanceControllerNoApi::class)->create();
})->name('ambulance.create');

// Show
Route::get('ambulance/{ambulance}', function ($ambulanceId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'ambulance.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(AmbulanceControllerNoApi::class)->show($ambulanceId);
})->name('ambulance.show');

// Edit
Route::get('ambulance/{ambulance}/edit', function ($ambulanceId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'ambulance.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(AmbulanceControllerNoApi::class)->edit($ambulanceId);
})->name('ambulance.edit');

// Destroy
Route::delete('ambulance/{ambulance}', function ($ambulanceId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'ambulance.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(AmbulanceControllerNoApi::class)->destroy($ambulanceId);
})->name('ambulance.destroy');

// Store
Route::post('ambulance', [AmbulanceControllerNoApi::class, 'store'])->name('ambulance.store');

// Update
Route::put('ambulance/{ambulance}', [AmbulanceControllerNoApi::class, 'update'])->name('ambulance.update');

// Index
Route::get('dispatch', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'dispatch.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(DispatchControllerNoApi::class)->index();
})->name('dispatch.index');

// Create
Route::get('dispatch/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'dispatch.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(DispatchControllerNoApi::class)->create();
})->name('dispatch.create');

// Show
Route::get('dispatch/{dispatch}', function ($dispatchId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'dispatch.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(DispatchControllerNoApi::class)->show($dispatchId);
})->name('dispatch.show');

// Edit
Route::get('dispatch/{dispatch}/edit', function ($dispatchId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'dispatch.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(DispatchControllerNoApi::class)->edit($dispatchId);
})->name('dispatch.edit');

// Destroy
Route::delete('dispatch/{dispatch}', function ($dispatchId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'dispatch.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(DispatchControllerNoApi::class)->destroy($dispatchId);
})->name('dispatch.destroy');

// Store
Route::post('dispatch', [DispatchControllerNoApi::class, 'store'])->name('dispatch.store');

// Update
Route::put('dispatch/{dispatch}', [DispatchControllerNoApi::class, 'update'])->name('dispatch.update');

// Index
Route::get('hospital', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'hospital.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(HospitalControllerNoApi::class)->index();
})->name('hospital.index');

// Create
Route::get('hospital/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'hospital.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(HospitalControllerNoApi::class)->create();
})->name('hospital.create');

// Show
Route::get('hospital/{hospital}', function ($hospitalId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'hospital.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(HospitalControllerNoApi::class)->show($hospitalId);
})->name('hospital.show');

// Edit
Route::get('hospital/{hospital}/edit', function ($hospitalId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'hospital.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(HospitalControllerNoApi::class)->edit($hospitalId);
})->name('hospital.edit');

// Destroy
Route::delete('hospital/{hospital}', function ($hospitalId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'hospital.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(HospitalControllerNoApi::class)->destroy($hospitalId);
})->name('hospital.destroy');

// Store
Route::post('hospital', [HospitalControllerNoApi::class, 'store'])->name('hospital.store');

// Update
Route::put('hospital/{hospital}', [HospitalControllerNoApi::class, 'update'])->name('hospital.update');

// Index
Route::get('pages', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'pages.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PagesControllerNoApi::class)->index();
})->name('pages.index');

// Create
Route::get('pages/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'pages.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PagesControllerNoApi::class)->create();
})->name('pages.create');

// Show
Route::get('pages/{page}', function ($pageId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'pages.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PagesControllerNoApi::class)->show($pageId);
})->name('pages.show');

// Edit
Route::get('pages/{page}/edit', function ($pageId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'pages.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PagesControllerNoApi::class)->edit($pageId);
})->name('pages.edit');

// Destroy
Route::delete('pages/{page}', function ($pageId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'pages.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(PagesControllerNoApi::class)->destroy($pageId);
})->name('pages.destroy');

// Store
Route::post('pages', [PagesControllerNoApi::class, 'store'])->name('pages.store');

// Update
Route::put('pages/{page}', [PagesControllerNoApi::class, 'update'])->name('pages.update');

// Index
Route::get('roles', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'roles.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(RolePermissionsController::class)->index();
})->name('roles.index');

// Create
Route::get('roles/create', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'roles.create'), 403, 'No tienes permiso para acceder a esta página.');
    return app(RolePermissionsController::class)->create();
})->name('roles.create');

// Show
Route::get('roles/{role}', function ($roleId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'roles.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(RolePermissionsController::class)->show($roleId);
})->name('roles.show');

// Edit
Route::get('roles/{role}/edit', function ($roleId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'roles.edit'), 403, 'No tienes permiso para acceder a esta página.');
    return app(RolePermissionsController::class)->edit($roleId);
})->name('roles.edit');

// Destroy
Route::delete('roles/{role}', function ($roleId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'roles.destroy'), 403, 'No tienes permiso para acceder a esta página.');
    return app(RolePermissionsController::class)->destroy($roleId);
})->name('roles.destroy');

// Store
Route::post('roles', [RolePermissionsController::class, 'store'])->name('roles.store');

// Update
Route::put('roles/{role}', [RolePermissionsController::class, 'update'])->name('roles.update');


// Index
Route::get('response', function () {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'response.index'), 403, 'No tienes permiso para acceder a esta página.');
    return app(ResponseControllerNoApi::class)->index();
})->name('response.index');

// Show
Route::get('response/{response}', function ($responseId) {
    $user = auth()->user();
    abort_unless(canAccessPage($user->role, 'response.show'), 403, 'No tienes permiso para acceder a esta página.');
    return app(ResponseControllerNoApi::class)->show($responseId);
})->name('response.show');
