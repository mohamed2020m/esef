<?php

use App\Http\Controllers\Bac\BacController;
use App\Http\Controllers\licence\LicenceController;
use App\Http\Controllers\Matiere\MatiereController;
use App\Http\Controllers\Filiere\FiliereController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\condidat\CondidatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PostFiliereController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard',[HomeController::class,'dashboard'])->name('dashboard');
    Route::get('verification/user/{id}',[HomeController::class,'verification']);

    Route::get('/verification/data/user',[HomeController::class,'verification_recu']);

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

    /** les routes pour charafeddine */
    Route::get('/user-management',[HomeController::class,'userManagement'])->name('user-management');
    Route::get('/NumberOfCandidatePerMonth',[HomeController::class,'numberOfCandidate'])->name('ncandidats');
    Route::get('/NumberOfCandidateCurrentMonth',[HomeController::class,'monthsDB'])->name('ncandidatsCurrentMonth');
    // Route::get('/user-management_{filiere_id}',[HomeController::class,'display_candidat'])->name('display_candidats');
    Route::get('/user-management-{id}',[InfoUserController::class,'detailUser'])->name('user-detail');
    Route::get('condidatures-export/{id}', [InfoUserController::class,'export'])->name('condidatures.export');
    Route::get('delete/user/{id}',[InfoUserController::class,'deleteUser']);
    Route::post('/user-profile/update',[InfoUserController::class,'updateProfile']);


    /** les routes pour condidats */
    Route::get('condidat-academique',[CondidatController::class,'donneeCondidat']);
    Route::post('condidat/acadimiques',[CondidatController::class,'storeDonneCondidat']);
    Route::get('dossier-personnelle',[CondidatController::class,'viewDossier']);
    Route::post('ps/filiere/pre-insc',[CondidatController::class,'inscription_in_filiere']);
    Route::get('/download/recu/{id}',[CondidatController::class,'downloadPdf']);

    //routes pour tables filieres

    Route::get('/condidature',[PostFiliereController::class,'index']);
    Route::get('/get/mt/filiere/{id}',[PostFiliereController::class,'matieres']);

    /** fin les routes pour charafeddine */

    Route::get('/admin-create',[UserController::class,'createadmin'])->name('administrateurs');
    Route::post('/admin-store',[UserController::class,'storeadmin'])->name('store');


    /* debut les routes de abdessamad* */

    //test
    Route::get('users', [UserController::class,'index'])->name('users-inscrits');
    Route::post('usersStore', [UserController::class,'store'])->name('users');

    //Gestion des utilisateurs
    Route::get('utilisateurs', [UserController::class,'afficher'])->name('Gestion_des_candidats_inscrits');

    //This is used to send AJAX POST request to fetch the datatables data.
    Route::get('getUtilisateurs',[UserController::class,'getUtilisateurs'])->name('getUtilisateurs');
    Route::put('/state/{id}',[UserController::class,'state'])->name('state');

    Route::get('/candidats',[HomeController::class,'select_filiere'])->name('selectFiliere');
    Route::get('/candidatsList',[HomeController::class,'showCandidats'])->name('candidats');
    Route::get('/candidats-{id}',[InfoUserController::class,'detailUser'])->name('user-detail');
    Route::get('/candidat-delete-{id}',[InfoUserController::class,'deleteCandidat']);

    Route::get('/Accueil', function () {return view('session/Accueil');})->name('Accueil');
    // Route::get('/inscription',[UserController::class,'index']);
	/* debut des routes pour entitie bac  * */
    Route::get('bac', [BacController::class,'index'])->name('Gestion_Baccalaureat');
    Route::get('/bac-create',[BacController::class,'create']);
    Route::post('/table/bac_create',[BacController::class,'store']);
    Route::get('/bac/delete-{id}',[BacController::class,'delete']);
    Route::get('/updatebac-{id}',[BacController::class,'edit']);
    Route::post('bac_update/{id}',[BacController::class,'update']);
	/* fin des routes pour entitie bac* */

	/* debut des routes pour entitie matiere  * */
	Route::get('matiere', [MatiereController::class,'index'])->name('Gestion_Matieres');
    Route::get('/matiere-create',[MatiereController::class,'create']);
    Route::post('/matiere/create',[MatiereController::class,'store']);
    Route::get('/update-{id}',[MatiereController::class,'edit']);
    Route::post('/matiere/update/{id}',[MatiereController::class,'update']);
    Route::get('/matiere-delete-{id}',[MatiereController::class,'delete']);
	       /* fin des routes pour entitie matiere* */

		   /* debut des routes pour entitie licence  * */
	Route::get('licence', [LicenceController::class,'index'])->name('Gestion_Licences');
 	Route::get('/licence-create',[LicenceController::class,'create']);
	Route::post('/table/licence_create',[LicenceController::class,'store']);
	Route::get('/licence-update-{id}',[LicenceController::class,'edit']);
	Route::post('licence_update/{id}',[LicenceController::class,'update']);
	Route::get('/licence-delete-{id}',[LicenceController::class,'delete']);
		    /* fin des routes pour entitie licence* */


                /* debut des routes pour entitie filiere* */
    Route::get('filiere', [FiliereController::class,'show'])->name('Gestion_Filieres');
    Route::get('/filiere-create',[FiliereController::class,'index']);
    Route::post('/filiere/create',[FiliereController::class,'create']);
    Route::post('filiere/update/{id}',[FiliereController::class,'update']);
    Route::get('/filiere-update-{id}',[FiliereController::class,'edit']);
    Route::get('/filiere/delete-{id}',[FiliereController::class,'delete']);

    /* fin les routes de abdessamad* */
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/inscription', [RegisterController::class, 'create']);
    Route::post('/inscription', [RegisterController::class, 'store']);
    Route::get('/Accueil', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password-{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

    Route::get('/auth-verify-email-{verification_code}',[RegisterController::class,'verify_email'])->name('verify_email');
});


