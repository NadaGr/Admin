<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;

class ClientAPIController extends Controller
{
    public function getAllClient()
    {
        $CU= Client::with('user')->get();
        //dd($CU);client()
        return $CU;
    }
    public function getClientwithId(Request $request)
    {
        $user = $request->user();
        $iduser = $user->id;
        return Client::with('user')->where('user_id', '=', $iduser)->get();
        // Client::join('users', 'users.id', '=', 'posts.user_id')
        //        ->get(['users.*', 'posts.descrption']);
    }
    public function getId(Request $request)
    {
        $user = $request->user();
        $iduser = $user->id;
        $client= Client::with('user')->where('user_id', '=', $iduser)->get();
        $idcl= $client->id;
        // Client::join('users', 'users.id', '=', 'posts.user_id')
        //        ->get(['users.*', 'posts.descrption']);
        return $idcl;
    }
    public function userdata(Request $request){
        $iduser = $request->user();
        return $iduser->id;
    }
    public function update(Request $req){

        $cl=Client::find($req->id);
        $cl->nom_user=$req->nom_user;
        $cl->prenom=$req->prenom;
        $cl->telephone=$req->telephone;
        $cl->adresse=$req->adresse;
        $cl->save();
        return response()->json([
            'statusCode' => 200,
            'message' => 'Update successfull',
        ]);
    } 
}
