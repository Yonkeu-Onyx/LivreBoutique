<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OuvrageController;

use App\Models\Livre;
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

//Route::get('/', function () {
  //  return view('welcome');
//});
//Route::get('/', [CategorieController::class, 'getCategoriesWelcome']);
Route::get('/', function () {
    return view('login');
});


Route::get('/login', function () {
    return view('login');
});
Route::get('/addUser', function () {
    return view('addUser');
});
Route::get('/addClient', function () {
    return view('addClient');
});
Route::get('/addLivre', function () {
    return view('addLivre');
});
//Route::get('/gestionnaire', function () {
  //  return view('gestionnaireDashboard');
//});
Route::get('/admin', function () {
    return view('adminDashboard');
});
/*                          ---ROUTES POUR L'EDITEUR---                      */


Route::get(
    '/editeur',
    [LivreController::class, 'getLivres']
);

Route::get('/editerLivre', function () {
    return view('Editeur.editerLivre');
});
Route::get('/addCategorie', function () {
    return view('Editeur.addCategorie');
});
Route::get('/addCategorie', [LivreController::class, 'getLivresCat']);

Route::get('/editerLivre/{id}', [LivreController::class, 'editLivre'])->name('editerLivre.editLivre');


Route::get('/categorie', [CategorieController::class, 'getCategories']);

Route::get('/categorie/{id}', [CategorieController::class, 'getCategorie'])->name('editerCategorie.getCategorie');

Route::get('/addCommentaire', function () {
    return view('Editeur.addCommentaire');
});
Route::get(
    '/commentaire',
    [CommentaireController::class, 'getCommentaires']
);
Route::get('/editerCategorie', function () {
    return view('Editeur.editer-categorie');
});
Route::get('/editerCategorie/{id}', [CategorieController::class, 'getCategorie'])->name('editerCategorie.getCategorie');
Route::post('/supCategorie', [CategorieController::class, 'DelLivre'])->name('supCategorie.DelLivre');//supprimer les livres d'une categorie

/*                          ---ROUTES POUR L'ADMINISTRATEUR---                      */

// route admin by safae :

// Route::get('/gereUser', function () {
//     return view('gererUtilisateurs');
// })->name('gereUser.gererUtilisateurs');

Route::get('/admin', function () {
    return view('adminDashboard');
});
Route::get('/AjouterUser', function () {
    return view('AjouterUtilisateur');
})->name('AjouterUser.AjouterUser');

/****************/
Route::get('/getusersImages', [UserController::class, "getUsersImages"])->name('getusersImages');
// modifer user 
Route::get('/ModifierUser/{id}', [UserController::class, 'showUser'])->name('ModifierUser.showUser');
Route::put('/gererUtilisateurs/{id}', [UserController::class, 'update'])->name('gererUtilisateurs.update');
Route::get('/gererUtilisateurs', [UserController::class, 'getUsers'])->name('gererUtilisateurs'); // ✅ à ajouter


// chercher :
Route::get('/rechercheUtilisateur', [UserController::class, 'search'])->name('rechercheUtilisateur');


/*                          ---ROUTES POUR GESTIONNAIRE---                      */
Route::get('/addOuvrage', function () {
    return view('addOuvrage');
});


Route::get('/gestionnaire', function () {
    $livres = Livre::all(); // récupère tous les ouvrages
    return view('gestionnaireDashboard', ['livre' => $livres]);
})->name('gestionnaire.dashboard');



Route::post('/livres/increment/{id}', [OuvrageController::class, 'increment'])->name('livres.increment');
Route::post('/livres/decrement/{id}', [OuvrageController::class, 'decrement'])->name('livres.decrement');




Route::get('/livres', [OuvrageController::class, 'index'])->name('livres.index');
Route::get('/livres/recherche-stock', [OuvrageController::class, 'rechercheParStock'])->name('livres.rechercheStock');

Route::get('/RouteModifier/{id}', [OuvrageController::class, 'edit'])->name('RouteModifier.edit');

Route::put('/livres/{id}', [OuvrageController::class, 'update'])->name('livres.update');




Route::get('/ventes', [App\Http\Controllers\SalesController::class, 'index'])
    ->name('ventes.index');

Route::get('/ventesparclient', [App\Http\Controllers\SalesParClientController::class, 'index'])
    ->name('ventesparclient.index');


Route::delete('/livres/{id}', [App\Http\Controllers\OuvrageController::class, 'destroy'])->name('livres.destroy');


