<?php

namespace App\Http\Controllers;

use App\Services\Transistor;

class TransistorController extends Controller
{
    //
    public function test()
    {
        return response()->json(app()->makeWith(Transistor::class, ['id' => 2])->getId());
    }

}
