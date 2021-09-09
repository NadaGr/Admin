<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='categories';

    protected $fillable = [
        'nom_categorie', 'image'
    ];

    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
