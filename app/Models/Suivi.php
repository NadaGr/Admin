<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suivi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='suivis';
    protected $fillable = [
        'reservation_id', 'montant ', 'etat','  prochaine_date', 'description ','montant_restant'
    ];
    public function reserver()
    {
        return $this->belongsTo(Reservation::class)->withTrashed();
    }
}

