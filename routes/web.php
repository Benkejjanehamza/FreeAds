<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\MessageController;
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

Auth::routes(['verify' => true]);

Route::get('/accueil', [IndexController::class, 'showIndex']);
Route::get('/loginPage', [IndexController::class, 'loginIndex'])->name('login');
Route::post('/login', [OtherController::class, 'login']);


// register
Route::post('/create', [UserController::class, 'store']);

Route::get('email/verify/{id}/{hash}', [OtherController::class, 'verify'])->name('verification.verify');


Route::middleware(['auth', 'verified'])->group(function () {

    //User
    Route::get('/home', [IndexController::class, 'accueilIndex'])->name('home');
    Route::get('/profil', [IndexController::class, 'myProfilIndex'])->name('myProfil');
    Route::get('/read', [UserController::class, 'read'])->name('readPage');
    Route::put('/update', [UserController::class, 'updateInfo']);
    Route::get('/delete', [UserController::class, 'deleteAccount']);
    Route::post('/logout', [OtherController::class, 'logout']);

    //Annonces
    Route::get('/createAnnonce', [IndexController::class, 'annonceIndex']);
    Route::get('/annonceList', [IndexController::class, 'annonceListIndex']);
    Route::post('/postAnnonce', [AnnonceController::class, 'postAnnoncedb']);
    Route::get('/getAnnonce', [AnnonceController::class, 'getAnnonces']);
    Route::get('/annonce', [IndexController::class, 'annonceShowIndex']);
    Route::get('/allAnnonce', [AnnonceController::class, 'getAllAnnonce']);
    Route::delete('/annonce/{id}', [AnnonceController::class, 'destroy'])->name('annonce.destroy');
    Route::get('/updateForm/{id}', [IndexController::class, 'updateAnnonceIndex'])->name('annonce.update.form');;
    Route::post('/updateAnnonce', [AnnonceController::class, 'updateAnnonce'])->name('annonce.update');

    //filtre
    Route::get('/search', [AnnonceController::class, 'annonceFilter']);

    //Message
    Route::get('/messageView', [IndexController::class, 'messageViewIndex']);
    Route::get('/messagePage', [MessageController::class, 'getMessage']);
    Route::get('/goToMessage', [IndexController::class, 'messagePageIndex']);
    Route::get('/unreadMessage', [MessageController::class, 'countUnreadMessages']);
    Route::post('/sendMessage', [MessageController::class, 'sendMessage']);
    Route::post('/readMessage', [MessageController::class, 'markAsRead']);
});

