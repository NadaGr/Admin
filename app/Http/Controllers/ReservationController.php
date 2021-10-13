<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\PointsFidelite;
use App\Models\Suivi;
use App\Services\Notification;
class ReservationController extends Controller
{
    public function getAllReservation()
    {
        $resC= Reservation::with('client','service')->where('etat','En attente')->get(); 
        return view('Liste_Reservation',compact('resC'));
    }
    public function getReservationaccepter()
    {
        $resaccepter= Reservation::with('client','service')->where('etat','Acceptée')->get();             
        return view('Liste_ReservationA',compact('resaccepter'));
    }
    public function getReservationconfirmer()
    {
        $resConfirmer= Reservation::with('client','service','suivi')->where('etat','Confirmée')->get();
        return view('Liste_ReservationC',compact('resConfirmer'));
    }

    public function addResrvation(Request $req)
    {
        $cl = Client::find($req->client_id);
        $cl->services()->syncWithoutDetaching($req->service_id);
return response()->json(
    "succees"
);
    }
    public function Accepter(Request $req)
    {
        $Notify = new Notification();
        $res=Reservation::where([
            ['id','=', $req->id],
            ['client_id','=', $req->client_id],
            ['service_id','=', $req->service_id]
            ])->first();
            //dd($req);
        $service = Service::withTrashed()->Where('id',$req->service_id)->first();
        $clr= Client::withTrashed()->Where('id',$req->client_id)->first();
        $id_user=$clr->user_id;
        $res->etat="Acceptée";
        $res->date=$req->date;
        $Notify->sendNotification($id_user,'Acceptation','Reservation accepté','vous etes acceptée',$service);  
        $res->save();
        return redirect()->back()->with('Reservation_Aceptée','La reservation a été acceptée');
 
    }
    public function Refuser(Request $req)
    {
        $res=Reservation::where([
            ['id','=', $req->id],
            ['client_id','=', $req->client_id],
            ['service_id','=', $req->service_id]
            ])->first();
        //dd($res);
        $Notify = new Notification();
        $service = Service::Where('id',$req->service_id)->first();
        $clr= Client::Where('id',$req->client_id)->first();
        $id_user=$clr->user_id;
        $res->etat="Annulée";
        $res->save();
        $Notify->sendNotification($id_user,'Annulatin','Reservation Annulée','Votre demande a été annulée', $service);
        $res->delete();
        return redirect()->back()->with('Reservation_Supprimer','La réservation a été supprimée');
    }
    public function Confirmer(Request $req)
    {
        $prix = Service::withTrashed()->find($req->service_id);
        $p=$prix->prix;       
        $suivi= new Suivi();
        $suivi->reservation_id=$req->id;
        $suivi->description=$req->description;
        $suivi->etat=$req->etat;
        if($req->montant!=$p && $req->montant_restant==null)
        {
            return  redirect()->back()->with('prix_incorrect','Merci de verifier le montant');
        }
        else if($req->montant_restant!=null)
        {
            $v=$req->montant_restant+$req->montant;
            if($v!=$p)
            {
                return  redirect()->back()->with('prix_incorrect','Merci de verifier le montant restant');
            }
        }
        $suivi= new Suivi();
        $suivi->reservation_id=$req->id;
        $suivi->description=$req->description;
        $suivi->etat=$req->etat;
        $suivi->montant=$req->montant;
        $suivi->montant_restant=$req->montant_restant;
        $suivi->prochaine_date=$req->prochaine_date;
        $suivi->save();    
        
        $Notify = new Notification();
        $res=Reservation::where([
            ['id','=', $req->id],
            ['client_id','=', $req->client_id],
            ['service_id','=', $req->service_id]
            ])->first();
     $service= Service::withTrashed()->where('id','=', $req->service_id)->first();
     $clr= Client::Where('id',$req->client_id)->first();
     $id_user=$clr->user_id;
     $ptService=$service->nb_points;
     $ptfidele = new PointsFidelite();
     $ptfidele->service_id=$req->service_id;
     $ptfidele->client_id=$req->client_id;
     $ptfidele->NBPointsF=$ptService;
     $ptfidele->save();
     $res->etat='Confirmée';     
     $Notify->sendNotification($id_user,'Confirmation','Reservation Confirmée','Votre demande a été Confirmée', $service);
     $res->save();            
     return redirect()->back()->with('Reservation_confirmer','La réservation a été confirmée');
    }
    public function calculer ($id2){
        $sum=0 ;
        $pt= PointsFidelite::where('client_id', $id2)->get();
     for ($i= 0; $i<count($pt);$i++)
     {
         $sum=$sum+$pt[$i]['NBPointsF'];

     }
     return $sum;
    }
    public function afficher($id)
    {
        $resS= Reservation::FindOrFail($id);
        dd($res->group->service);
        $resC= Reservation::with('client')->get();  
    }


}