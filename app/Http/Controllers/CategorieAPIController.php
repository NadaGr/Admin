<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Service;

class CategorieAPIController extends Controller
{
    public function getAllCategorie()
    {
        $Cat= Categorie::all();
        return $Cat;
    }
    
    //Obtenir toutes les services selon une catégorie donnée
    public function getServiceByCat($id)
    {
        $serv=Categorie::find($id)->service()->get();
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
    

}
