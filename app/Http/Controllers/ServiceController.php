<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\Reservation;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    //obtenir tous les services
    public function getAllService()
    {
        $serv= Service::all();
        return response()->json(compact('serv'));
    }
    //obtenir tous les services avec la catégorie
    public function getAllServiceWithCategorie()
    {
        
        $Sc= Service::with('categorie')->get();
        $categories= Categorie::whereNotNull('nom_categorie')->get();
        return view('Liste_Service')->with('Sc',$Sc)->with('categories',$categories); 
    }
    //obtenir tous les services avec la promotion
    public function getServiceWithPromo()
    {
        $data = Service::with('promotions')->get();
        $Liste_services= Service::all();
        return view('Liste_Promotion')->with('data',$data)->with('Liste_services',$Liste_services); 
       
    }
    //Ajouter un service 
    public function insertService(Request $req)
    {
            $image=$req->image;
            $imageName=time(). '.' .$image->extension();
            $image->move(public_path('images'),$imageName);
            $service=new Service();
            $service->nom_service=$req->input('nom_service');
            $service->description=$req->input('description');
            $service->prix=$req->input('prix');
            $service->nb_points=$req->input('nb_points');
            $service->categorie_id=$req->input('categorie_id');            
            $service->image= url('images/'.$imageName);
            $service->save();
            return redirect()->back()->with('service_Added','Service is Added');
    }
    //Supprimer un service 
    public function deleteService($id)
    {
        Service::where('id',$id)->delete(); 
        return response()->json(['service_delete'=>'Service is deleted']);
    }

    //Obtenir un service selon le nom
    public function FindByName($name)
    {
        $service= Service::where('nom_service', '=', $name)->get();
        return $service;
    }
    //mise a jour d'un servic selon le nom
    public function Update(Request $req)
    {
            $service=Service::find($req->id);
            
            $service->nom_service=$req->nom_service;
            $service->description=$req->description;
            $service->prix=$req->prix;
            $service->nb_points=$req->nb_points;
            $service->categorie_id=$req->categorie_id;
            if(isset($req->image)){
            $image=$req->image;
            $imageName=time(). '.' .$image->extension();
            $image->move(public_path('images'),$imageName);
           
            $service->image= url('images/'.$imageName);
            }
            $service->save();
            return redirect()->back()->with('service_Update','Service is uptaded');
    }
    //Obtenir un service selon l'ID
    public function FindById($id)
    {
        $service=Service::find($id);
        return $service;
    }
    public function getListeCategories()
    {
        $categories= Categorie::all();
        return view('Liste_Service',compact('categories'));
    }


}
