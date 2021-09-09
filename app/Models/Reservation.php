<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='reservations';
    protected $fillable = [
        'service_id', 'client_id ', 'etat', 'date'
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class)->withTrashed()->withTrashed();;
    }
    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
    public function suivi()
    {
        return $this->hasOne(Suivi::class);
    }
}
