<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Service;

class PromotionAPIController extends Controller
{
    public function getAll()
    {
        $sql= Promotion::with('services')->orderBy('date_debut', 'desc')->get();
        return $sql;
    } 
}
