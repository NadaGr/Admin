<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Service;
class CategorieController extends Controller
{
    //Obtenir toutes les catégories
    public function getAllCategorie()
    {
        $allCategories = Categorie::select('id', 'nom_categorie')->get();
        $Cat= Categorie::all();
        //return $Cat;
        return view('Liste_Categorie',compact('Cat','allCategories'));
    }
    // Ajouter une Categorie 
    public function addCategorie(Request $req)
    {
        $image=$req->image;
        $imageName=time(). '.' .$image->extension();
        $image->move(public_path('images'),$imageName);
        $cat = new Categorie();
        $cat->nom_categorie=$req->nom_categorie;
        $cat->image=url('images/'.$imageName);
        $cat->save();
        return redirect()->back()->with('Categry_add','Categry is Added');
    }
    //Obtenir toutes les services selon une catégorie donnée
    public function getServiceByCat($id)
    {
        $serv=Categorie::find($id)->service();
        return $serv;
    }
    //Obtenir une catégorie selon un ID
    public function getCategorieById($id)
    {
        $cat=Categorie::find($id);
        return $cat;
    }
    //Obtenir une catégorie selon un Nom
    public function getCategorieByName($name)
    {
        $cat=Categorie::where('nom_categorie', '=', $name)->get();
        return $cat;
    }
    //mise a jour d'une catégorie
    public function Update(Request $req)
    {
           $cat=Categorie::find($req->id);
           $cat->nom_categorie=$req->nom_categorie;
           if(isset($req->image)){ 
           $image=$req->image;
           $imageName=time(). '.' .$image->extension();
           $image->move(public_path('images'),$imageName);
          
           $cat->image=url('images/'.$imageName);
           }
           $cat->save();
           return redirect()->back()->with('Categorie_Update','Categorie is uptaded');
    }
    //Supprimer une catégorie
    public function deleteCategorie($id)
    {
        Categorie::where('id',$id)->delete(); 
       return response()->json(['categorie_delete'=>'category is deleted']);
    }
    public function updateCat(Request $req)
    {
       // $categ= Categorie::find($req->id);
        $allservice=Service::where('categorie_id',$req->id)->first();     
        //dd($allservice);  
        if(isset($allservice->categorie_id)){
        $allservice->categorie_id=$req->categorie_id;
        $allservice->save();
        return  redirect()->back()->with('categorie_modified','Tous les services de cette catégorie ont été déplacées avec succès. Si vos étes sûrs de supprimer cette catégorie clicker sur le boutton supprimer');
        }
        else{
            return  redirect()->back()->with('categorie_modified','aucun service sous cette categorie');
        
        }
        // $categ= Categorie::find($req->id)->delete();
        // return  redirect()->back()->with('categorie_delete','category is deleted');
        
        
        //$Novcat= Categorie::find($req->cat_id);
        //$cat->nom_categorie=$req->nom_categorie;
    }


}
