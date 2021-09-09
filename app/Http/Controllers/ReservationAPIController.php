<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\panier;
use App\Models\PointsFidelite;
class ReservationAPIController extends Controller
{
    public function addReservation(Request $req){
        
        $res = new Reservation(); 
        $res->client_id=$req->client_id;
        $res->etat=$req->etat;
        $res->service_id=$req->service_id;
        $res->date=$req->date_res;
        $res->save();
        panier::where(
            [['client_id','=', $res->client_id],
            ['service_id','=', $res->service_id]]
            )->delete(); 
        //$res->services()->syncWithoutDetaching($req->service_id);
        return response()->json([
            'statusCode' => 200,
            'body' => 'reservation successfull',
        ]);
        //return redirect()->back()->with('Promotion_Added','Promotion is Added');
    }
    public function add($id, Request $req)
    {
        $session = $req->getSession();
        $panier =$session->get('panier',[]);
        $session->set('panier', $panier);

    }
    public function getPoints($id){
        $pt= PointsFidelite::where('client_id', $id)->get();
        return $pt;
    }
   public function getHistRes($id)
   {
       $histores = Reservation::with('service')->Where('client_id',$id)->get();
       return $histores;
   }
}
