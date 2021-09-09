<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Promotion;
use App\Models\PromoService;
use App\Http\Controllers\PromotionController;

class PromoServiceController extends Controller
{
    public function getAll()
    {
        $sql= Promotion::with('services')->get();
        $allServices = Service::select('id', 'nom_service')->get(); // all db serves
        $promos = Promotion::select('id', 'pourcentage')->get();
        //dd($sql);
        return  view('Promo_Service',compact('sql','promos','allServices'));
    }
    
    public function saveServicesToPromos(Request $request)
    {

        $promo = Promotion::find($request->promotion_id);
        if (!$promo)
            return abort('404');
        $promo->services()->syncWithoutDetaching($request->service_id);
        return redirect()->back()->with('service_Added','Service is Added');
    }
     //Supprimer une promotion
     public function deletePromoService($id1,$id2)
     {
         PromoService::where([
            ['promotion_id','=', $id1],
            ['service_id','=', $id2]
            ])->delete(); 
         return response()->json(['Service_delete'=>'Service is deleted']);
     }
}
