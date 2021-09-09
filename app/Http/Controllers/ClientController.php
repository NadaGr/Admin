<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Service;

class ClientController extends Controller
{
    public function getAllClient()
    { 
        //cl= Client::all();
       $user= User::where('role', '=', 'cliente')->get();
       $CU= Client::with('user')->get();
       $res=Reservation::with('client','service')->get();
    
        //dd($CU);
        return view('Liste_Client')->with('CU',$CU)->with('user',$user)->with('res',$res);
    }
    public function add(Request $req)
    {
        $user = new User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=$req->password;
        $user->role=$req->role;
        $user->save();
        $image=$req->photo;
        $imageName=time(). '.' .$image->extension();
        $image->move(public_path('images'),$imageName);
        $cl= new Client();
        $cl->nom_user=$user->name;
        $cl->prenom=$req->prenom;
        $cl->telephone=$req->telephone;
        $cl->adresse=$req->adresse;
        $cl->user_id=$user->id;
        $cl->photo=url('images/'.$imageName);
        $cl->save();
        return redirect()->back()->with('Client_Add','client is added');
        
        //return redirect()->back()->with('User_Add','User is added');
       
    }
    public function addClient(Request $req)
    {
       
       
    }
    public function delete($id)
    {
        Client::where('id',$id)->delete(); 
        return response()->json(['client_delete'=>'Client is deleted']);
    }
    public function FindByName($name)
    {
        $cl=Client::where('nom_user', '=', $name)->get();
        return $cl;

    }
    public function Update(Request $req)
    {
        $cl=Client::find($req->id);
        $image=$req->photo;
        $imageName=time(). '.' .$image->extension();
        $image->move(public_path('images'),$imageName);
        $cl->nom_user=$req->nom_user;
        $cl->prenom=$req->prenom;
        $cl->telephone=$req->telephone;
        $cl->adresse=$req->adresse;
        $cl->user_id=$req->user_id;
        $user= User::find($req->user_id);
        $user->email=$req->email;
        $cl->photo=url('images/'.$imageName);
        $cl->save();
        $user->save();
        return redirect()->back()->with('Client_Update','client is updated');
       

    }
    // public function getPoints($id){
    //     $pt= PointsFidelite::where('client_id', $id)->get();
    //     return view('Liste_Client')->with('pt',$pt);
    // }
    public function historique_client($id)
    {
    
       $user= User::where('role', '=', 'cliente')->get();
       $CU= Client::with('user')->get();
        $res=Reservation::with('client','service')->where([
            ['client_id','=', $id]
            ])->get();
        return view('Liste_Client',compact('res','user','CU'));

    }
    public function calculPoints($id)
    {
        $res=Reservation::with('client','service')->where([
            ['client_id','=', $id],['etat','=','Confirmée']
            ])->get();
            $sum=0;
            foreach($res as $res){
                $sum+=$res->service->nb_points;
            }
        return $sum;

    }
    //"{{ url('/getHist/{{  $CU->id }}')}}"
}
