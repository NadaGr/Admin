<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\panier;

class PanierController extends Controller
{
   public function add(Request $req)
   {
       $panier = new panier(); 
       $panier->nom_service= $req->nom_service;
       $panier->description=$req->description;
       $panier->prix=$req->prix;
       $panier->nb_points=$req->nb_points;
       $panier->categorie_id=$req->categorie_id;
       $panier->image=$req->image;
       $panier->service_id=$req->service_id;
       $panier->client_id=$req->client_id;
       $panier->date_res=$req->date_res;
       $panier->save();
       return response()->json([
        'statusCode' => 200,
        'body' => 'add successfull',
    ]);
   }
   public function index($id){
    $panier = panier::where('client_id','=',$id)->get();
    return $panier;
   }
   public function remove($id1,$id2){
    if($id1==null||$id2==null){
        return response()->json([
            'statusCode' => 500,
            'body' => 'error',
        ]);
    }else{
    panier::where(
        [
        ['client_id','=', $id1],
        ['service_id','=', $id2]
        ]
        )->delete(); 
        
        return response()->json([
            'statusCode' => 200,
            'body' => 'delete successfull',
        ]);
   }}
}
// public function addReservation(Request $req){
        
    // $res = new Reservation(); 
    // $res->client_id=$req->client_id;
    // $res->etat=$req->etat;
    // $res->service_id=$req->service_id;
    // $res->save();
    // //$res->services()->syncWithoutDetaching($req->service_id);
    // return response()->json([
    //     'statusCode' => 200,
    //     'body' => 'reservatio successfull',
    // ]);