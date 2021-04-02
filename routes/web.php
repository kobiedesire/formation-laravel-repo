<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Produit;
use App\Mail\NouveauProduitAjoutee;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProduitController;
use App\Notifications\NouveauProduitNotification;

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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';



Route::get('/', [MainController::class, 'afficheAcceuil'])->name('accueil');

Route::get('procedure/{param}', [MainController::class, 'afficheProcedure'])->name('procedure');

//Route::middleware(["auth", "isAdmin"])->prefix("admin")->group(function(){

    Route::get('ajouter-produit', [MainController::class, 'ajoutProduit'])->name('a.produit');

    Route::get('ajout2', [MainController::class, 'ajoutProduitEncore'])->name('a.p');

    Route::get('produits/ajouter', [MainController::class, 'ajouterProduit'])->name('produit.ajout');
    
    Route::get('produits/modifier/{produit}', [MainController::class, 'edit'])->name('produits.modifier');

    Route::get("export-excel", [MainController::class, "excelExport"])->name("excel.export");

    Route::put('produits/update/{id}', [MainController::class, 'updateProduit'])->name('produits.update');

    Route::get('modification/{id}', [MainController::class, 'modifierProduit']);

    Route::post('produits/engregistrer', [MainController::class, 'enregistrerProduit'])->name('produits.enregister');

//});



Route::get('list-produits', [MainController::class, 'getList'])->name('list');


Route::get('supprimer/{id}', [MainController::class, 'supprimer'])->name('delete');

Route::get('deletecommande/{id}', [MainController::class, 'deletecommande'])->name('deletecommande');

Route::get('ajoutercommande/{id}', [MainController::class, 'ajoutercommande'])->name('ajoutercommande');

Route::get('produits/liste', [MainController::class, 'getList'])->name('produits.liste');

route::get("test-collections", [ProduitController::class, "index"]);



Route::resource('produits', ProduitController::class);


Route::get("send-mail", [MainController::class, "sendMail"]);

Route::get("test-mail", function(){
    $produit = Produit::first();
    return new NouveauProduitAjoutee($produit);
});

Route::get("test-notification", function(){
$user = User::first();
$produit = Produit::first();
$user->notify(new NouveauProduitNotification($produit));

dd("Notification envoyée !");
});
