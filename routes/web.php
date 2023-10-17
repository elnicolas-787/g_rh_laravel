<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AffichageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EchelonController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\FormationEmployeeController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ReceptionCongeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [AuthController::class, 'index']);

Route::middleware(['isAdmin'])->group(function () {
    Route::resource('utilisateurs', UtilisateurController::class);
    Route::resource('directions', DirectionController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('echelons', EchelonController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('professions', ProfessionController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('absences', AbsenceController::class);
    Route::resource('formations', FormationController::class);
    Route::resource('missions', MissionController::class);
    Route::resource('formation_employee', FormationEmployeeController::class);
    Route::resource('conges', CongeController::class);
    Route::get('boite-receptions-absences', [ReceptionCongeController::class, 'getAllAbsence']);
    Route::get('boite-receptions-conges', [ReceptionCongeController::class, 'getAllConge']);
    Route::resource('contrats', ContratController::class);
    Route::get('/get_employee/{id}', [ContratController::class, 'getEmployeeName']);
    Route::get('/tableau_de_bord', [DashboardController::class, 'index']);
    Route::put('/decision_conge/{id}', [DecisionController::class, 'actionConge']);
    Route::put('/decision_absence/{id}', [DecisionController::class, 'actionAbsence']);
    Route::get('/demande_accepter_conges', [DecisionController::class, 'getCongeAccepter']);
    Route::get('/demande_refuser_conges', [DecisionController::class, 'getCongeRefuser']);
    Route::get('/demande_accepter_absences', [DecisionController::class, 'getAbsenceAccepter']);
    Route::get('/demande_refuser_absences', [DecisionController::class, 'getAbsenceRefuser']);
    Route::get('/liste_employee_cdd', [AffichageController::class, 'getContratCdd']);
    Route::get('/liste_employee_cdi', [AffichageController::class, 'getContratCdi']);
    Route::get('/liste_toute_employee', [AffichageController::class, 'getAllEmployee']);
    Route::get('/liste_employee_cinq_ans_service', [AffichageController::class, 'getAnneeService']);
    Route::post('/verifier-email', 'VerificationController@verifierEmail')->name('verifier.email');
});

Route::resource('conges', CongeController::class);
Route::resource('absences', AbsenceController::class);
Route::get('/get_employee/{id}', [ContratController::class, 'getEmployeeName']);
Route::get('/registre', [AuthController::class, 'registre']);
Route::post('/post_registre', [AuthController::class, 'postRegistre'])->name('post_registre');
Route::post('/post_login', [AuthController::class, 'postLogin'])->name('post_login');
Route::get('/deconnecter', [AuthController::class, 'deconnexion'])->name('deconnecter');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
