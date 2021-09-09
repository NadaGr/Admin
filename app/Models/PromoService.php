<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='promo_services';
    protected $fillable = [
        'service_id', '	promotion_id '
    ];
    /*public function promotions()
    {
        return $this->belongsTo(Promotion::class);
    } 

     public function services()
     {
         return $this->belongsTo(Service::class);
     }*/
}
