<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\Reservation;
use App\Models\User;
class StatistiquesController extends Controller
{
    public function dashboard()
    {
        $sum =0;
        $client = Client::all()->count();
        $service = Service::all()->count();
        $RC= Reservation::with('client','service')->where('etat','Confirmée')->get()->count();
        $resConfirmer= Reservation::with('client','service')->where('etat','Confirmée')->get();
        $resaccepter= Reservation::with('client','service')->where('etat','acceptée')->get();
        //$Cat= Service::with('categorie')->get(); 
        //return $Cat;
        $admin=User::where('role','Admin')->first();
        //dd($admin);
        foreach($resConfirmer as $resConfirmer )
        {
            $sum= $sum + $resConfirmer->service->prix;

        }
        $etat= Reservation::with('client','service','suivi')->where('etat','Confirmée')->get();
        //dd($sum);
        return view('dashboard',compact('client','service', 'sum','RC','admin','etat','resaccepter'));
        // return view('Liste_Categorie',compact('Cat'));
    }
}
