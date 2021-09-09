<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointsFidelite extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='points_fidelites';
    protected $fillable = [
        'service_id', 'client_id ', 'NBPointsF'
    ];

    public function service()
    {
        return $this->hasMany(Service::class);
    }
    public function user()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
}
