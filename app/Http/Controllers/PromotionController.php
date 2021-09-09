<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Service;

class PromotionController extends Controller
{
    //Ajouter une promotions
    public function addPromotion(Request $req){
        $image=$req->image;
        $imageName=time(). '.' .$image->extension();
        $image->move(public_path('images'),$imageName);
        $promo = new Promotion(); 
        $promo->nom=$req->nom;
        $promo->date_debut=$req->date_debut;
        $promo->date_fin=$req->date_fin;
        $promo->pourcentage=$req->pourcentage;
        $promo->image=url('images/'.$imageName);
        $promo->save();
        $promo->services()->syncWithoutDetaching($req->service_id);
        
        return redirect()->back()->with('Promotion_Added','Promotion is Added');
    }
     
    //obtenir toutes les promotions
    public function getAllPromotion(){
       
        $sql= Promotion::with('services')->get();
        $promo= Promotion::all();
        $allServices = Service::select('id', 'nom_service')->get();
        return view('Liste_Promotion',compact('promo','sql','allServices'));
    }
    //Obtenir une promotion selon un ID
    public function getPromotionById($id)
    {
        $promo=Promotion::find($id);
        return $promo;
    }
    //mise a jour d'une promotion
    public function Update(Request $req)
    { 
           $promo=Promotion::find($req->id);
           $promo->nom=$req->nom;
           $promo->date_debut=$req->date_debut;
           $promo->date_fin=$req->date_fin;
           $promo->pourcentage=$req->pourcentage;
           if(isset($req->image)){
           $image=$req->image;
           $imageName=time(). '.' .$image->extension();
           $image->move(public_path('images'),$imageName);           
           $promo->image=url('images/'.$imageName);
           }
           $promo->save();
           $promo->services()->syncWithoutDetaching($req->service_id);        
           return redirect()->back()->with('Promotion_Update','Promotion is uptaded');
            
    }
    //Supprimer une promotion
    public function deletePromotion($id)
    {
        Promotion::where('id',$id)->delete(); 
        return response()->json(['Promo_delete'=>'Promotion is deleted']);
    }
   
    
}
