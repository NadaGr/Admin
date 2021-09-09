<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class panier extends Model
{
    use HasFactory;
    protected $table='paniers';
    protected $fillable = [
        'nom_service','description','prix','nb_points','categorie_id','image','service_id', 'client_id ','date_res'
    ];
}
