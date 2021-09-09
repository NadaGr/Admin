<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class SeviceAPIController extends Controller
{
    public function getAllService()
    {
        $serv= Service::all();
        return  $serv;
    }
}
