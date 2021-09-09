<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='services';
    protected $fillable = [
        'nom_service', 'description ', 'prix','	nb_points', 'categorie_id ', 'image'
    ];

    public function reserver()
    {
        return $this->hasOne(Reservation::class);
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class)->withTrashed();
    }
    public function promotions(){
        
    //     return $this->hasManyThrough(Promotion::class, PromoService::class,
    //     'service_id',
    //     'id', 
    //     'id',
    //     'promotion_id'
    // );

        return $this->belongsToMany(Promotion::class, 'promo_services')->withTrashed();;
    }
    public function client(){
        return $this->belongsToMany(Client::class, 'reservations')->withTrashed();
    }
    public function points()
    {
        return $this->belongsTo(PointsFidelite::class)->withTrashed();
    }
}
