<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\HouseInterface;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    //
    public function backHome()
    {
        return response()->json(app()->make(HouseInterface::class, ['member' => 'Gouku', 'position' => 'bathroom'])->turnOnLight());
    }
}
