<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', 'userController@logout')->name('logout.api');
    Route::get('/user', 'userController@userdata')->name('user.api'); 
    Route::get('/getallcat', 'CategorieAPIController@getAllCategorie');
    Route::get('/getServiceByCat/{id}', 'CategorieAPIController@getServiceByCat');
    Route::get('/getCategorieById/{id}', 'CategorieAPIController@getCategorieById');
    Route::get('/getCategorieByName/{name}', 'CategorieAPIController@getCategorieByName');
    Route::get('/getAllClient', 'ClientAPIController@getAllClient');
    Route::get('/getClientwithId', 'ClientAPIController@getClientwithId');
    Route::get('/userdata', 'ClientAPIController@userdata');
    Route::get('/getallservice', 'SeviceAPIController@getAllService');
    Route::get('/getallpromo', 'PromotionAPIController@getAll');
    Route::put('/updateclient', 'ClientAPIController@update');
    Route::get('/getallpromoS', 'PromotionAPIController@getAllPromotion');
    Route::post('/addReservation', 'ReservationAPIController@addReservation'); 
    Route::get('/getId', 'ClientAPIController@getId'); 
    Route::get('/indexR/{id}', 'PanierController@index'); 
    Route::post('/addR', 'PanierController@add'); 
    Route::delete('/moveR/{id1}/{id2}', 'PanierController@remove'); 
    Route::get('/calculer/{id1}','ReservationController@calculer');
    Route::get('/getPoints/{id}', 'ReservationAPIController@getPoints'); 
    Route::get('/getHistRes/{id}', 'ReservationAPIController@getHistRes'); 
      
});
 

Route::post('/register', 'Client\Auth\registerController@register');
Route::post('/login', 'Client\Auth\loginController@login');
Route::get('/loginFCb/facebook', 'Client\Auth\LoginFCBController@redirect');
Route::get('/loginFCb/facebook/callback', 'LoginFCBController@callback');
Route::get('/facebook', 'Client\Auth\LoginFCBController@loginWithFacebook');

//sanctum
//login /register / update profile /mot de passe oublier -> email + num de securite -> nov mdp 
//home page : afichage des promotions (selon date systeme % date debut ( date de sys + 7jr)et date fin ) + liste categorie 