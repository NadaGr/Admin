<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PromoServiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatistiquesController;
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//Route Pour Tble Categorie
Route::get('/getCategories',[CategorieController::class,'getAllCategorie']);//->name('dashboard');
Route::post('/addCategorie',[CategorieController::class,'addCategorie'])->name('add.categorie');
Route::get('/getcategoriebyid/{id}',[CategorieController::class,'getCategorieById']);
Route::get('/getcatbyname/{nom_categorie}',[CategorieController::class,'getCategorieByName']);
Route::post('/updatecat/{id}',[CategorieController::class,'Update'])->name('categorie.update');
Route::delete('/deletecategorie/{id}',[CategorieController::class,'deleteCategorie']);
Route::post('/updatecategorie/{id}',[CategorieController::class,'updateCat'])->name('categorie.updatecat');
 
//Route concernant Tabl promotion 
Route::post('/addPromotion',[PromotionController::class,'addPromotion'])->name('add.promo');
Route::get('/getAllPromo',[PromotionController::class,'getAllPromotion']);
Route::get('/getAllPromobyid/{id}',[PromotionController::class,'getPromotionById']);
Route::post('/updatepromo/{id}',[PromotionController::class,'Update'])->name('promo.update');
Route::delete('/deletePromo/{id}',[PromotionController::class,'deletePromotion']);
//Route concernant Tabl service
Route::get('/getallservice',[ServiceController::class,'getAllService']);
Route::get('/getservicecat',[ServiceController::class,'getAllServiceWithCategorie'])->name('get.data');
Route::post('/addservice',[ServiceController::class,'insertService'])->name('add.service');;
Route::delete('/deleteservice/{id}',[ServiceController::class,'deleteService']);
Route::get('/FindByName/{nom_service}',[ServiceController::class,'FindByName']);
Route::post('/updateservice/{id}',[ServiceController::class,'Update'])->name('service.update');
Route::get('/FindById/{id}',[ServiceController::class,'FindById']);



Route::get('/getAllPS',[PromoServiceController::class,'getAll']);
Route::post('/savepromoserv',[PromoServiceController::class,'saveServicesToPromos'])->name("save.PS");
Route::delete('/deletePromoService/{id1}/{id2}',[PromoServiceController::class,'deletePromoService']);

Route::get('/getAllClient',[ClientController::class,'getAllClient']);
Route::post('/adduser',[ClientController::class,'add']);
Route::post('/addClient',[ClientController::class,'addClient']);
Route::delete('/deleteClient/{id}',[ClientController::class,'delete']);
Route::get('/FindByName/{nom_user}',[ClientController::class,'FindByName']);
Route::post('/Updateclient/{id}',[ClientController::class,'Update'])->name('client.update');
Route::get('/getClient/{id}',[ClientController::class,'filter'])->name('client.find');
Route::get('/getHist/{id}',[ClientController::class,'historique_client'])->name('client.hist');
Route::get('/getpoints/{id}',[ClientController::class,'calculPoints']);

Route::get('/getAllClient',[ClientController::class,'getAllClient']);
Route::post('/adduser',[ClientController::class,'add']);
Route::post('/addClient',[ClientController::class,'addClient']);
Route::delete('/deleteClient/{id}',[ClientController::class,'delete']);
Route::get('/FindByName/{nom_user}',[ClientController::class,'FindByName']);
Route::post('/Updateclient/{id}',[ClientController::class,'Update'])->name('client.update');

Route::get('/getAllReserv',[ReservationController::class,'getAllReservation']);
Route::post('/addReserv',[ReservationController::class,'addResrvation']);
Route::post('/accepter',[ReservationController::class,'Accepter'])->name('reservation.accepter');
Route::get('/refuser',[ReservationController::class,'Refuser'])->name('reservation.refuser');
Route::post('/confirmer',[ReservationController::class,'Confirmer'])->name('reservation.confirmer'); 
Route::get('/getReservationaccepter',[ReservationController::class,'getReservationaccepter']);
Route::get('/getReservationconfirmer',[ReservationController::class,'getReservationconfirmer']);
Route::get('/points/{id}',[ReservationController::class,'calculer'])->name('reservation.points');
Route::get('/Acceptpoints',[ReservationController::class,'AccepterwithPoints'])->name('reservation.acceptpoints');
Route::get('/count',[StatistiquesController::class,'dashboard'])->name('dashboard');
//Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});
Route::get('/LService', function () {
    return view('Liste_Service');
});
Route::get('/', function () {
    return view('auth/login');
});
Route::get('/ajout_service', function () {
    return view('Ajouter_Service');
});
Route::get('/client', function () {
    return view('Liste_Client');
});
Route::get('/reservation', function () {
    return view('Liste_Reservation');
});
Route::get('/promotion', function () {
    return view('Liste_Promotion');
});

Route::get('/HistoriqueClient', function () {
    return view('HistoriqueClient');
});
Route::get('/test', function () {
    return view('test');
});