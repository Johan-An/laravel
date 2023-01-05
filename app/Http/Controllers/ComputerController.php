<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ComputerInterface;
use MobileNowGroup\OpenSearch\Facedes\Opensearch;

class ComputerController extends Controller
{
    //
    public function price()
    {
        return response()->json(app()->make(ComputerInterface::class, ['discount' => 0.8])->getPrice());
    }

    public function test()
    {
        Opensearch::test();
    }
}
