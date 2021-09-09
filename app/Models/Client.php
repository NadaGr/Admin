<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='clients';
    protected $fillable = [
        'nom_user', 'prenom', 'telephone','adresse', 'user_id','phote'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function services(){
        return $this->belongsToMany(Service::class,"reservations")->withTrashed();;
    }
    public function points()
    {
        return $this->hasOne(PointsFidelite::class);
    }

}
