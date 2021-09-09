<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='promotions';

    protected $fillable = [
        'image', 'nom', 'pourcentage','date_debut','date_fin'
    ];
    public function services(){
        return $this->belongsToMany(Service::class,"promo_services")->withTrashed();;
       
    }
}
