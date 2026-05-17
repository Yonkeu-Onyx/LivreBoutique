<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OuvrageController;
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
Route::post('/createUser', [UserController::class, "store"])->name('createUser.store');
Route::get('/getUser', [UserController::class, "getUser"])->name("getUser.getUser");
Route::post('/createLivre', [LivreController::class, 'store'])->name('createLivre.store');
Route::post('/createClient', [ClientController::class, 'store'])->name('createClient.store');
Route::post('/updateLivre/{id}', [LivreController::class, 'update'])->name('updateLivre.update');


/*                          ---ROUTES POUR L'EDITEUR---                      */
Route::post('/createCategorie', [CategorieController::class, 'store'])->name('createCategorie.store');
Route::post('/createCommentaire', [CommentaireController::class, 'store'])->name('createCommentaire.store');
Route::post('/updateStatus/{id}/{status}', [CommentaireController::class, 'update'])->name('updateStatus.update');
Route::post('/updateCategorie/{id}', [CategorieController::class, 'update'])->name('updateCategorie.update');
Route::post('/addLivreCategorie/{id}', [CategorieController::class, 'addLivre'])->name('addLivreCategorie.addLivre');
Route::delete('/deleteCategorie/{id}', [CategorieController::class, 'delete'])->name('deleteCategorie.delete');

/*                          ---ROUTES POUR L'ADMINISTRATEUR---                      */

Route::get('/getusers', [UserController::class, "getUsers"])->name('getusers.getUsers');
Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete.destroy');
Route::post('/ajout', [UserController::class, 'AddUser'])->name('ajout.AddUser');

/*recuperer les user et les livres dans dashbord de admin*/
// Route::get('/getusersImages', [UserController::class, "getUsersImages"])->name('getusersImages.getUsersImages');

Route::post('/modifierRole/{id}', [UserController::class, 'modifierRole']);


/*                          ---ROUTES POUR GESTIONNAIRE---                      */

Route::post('/modifierLivre', [OuvrageController::class, 'update'])->name('modifierLivre.update');

Route::post('/modifier/{id}',[OuvrageController::class,'update'])->name('modifier.update');

Route::post('/createOuvrage', [OuvrageController::class, 'store'])->name('createOuvrage.store');