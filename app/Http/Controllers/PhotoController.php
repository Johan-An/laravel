<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::asForm()
            ->withHeaders(
                [
                    "Authorization" => "APPCODE 567804048a2b446c84a19066e61f1ea3",
                    "Content-Type"  => "application/x-www-form-urlencoded; charset=UTF-8"
                ]
            )
            ->post('https://shortlink.market.alicloudapi.com/shortlink/create',
                [
                    "target" => 'https://www.baidu.com'
                ]
            );

        dd($response->body());


        //
        $photos = [
            ['id' => 1, 'name' => 'aaa'],
            ['id' => 2, 'name' => 'bbb'],
            ['id' => 3, 'name' => 'ccc'],
            ['id' => 4, 'name' => 'ddd'],
            ['id' => 5, 'name' => 'eee'],

        ];
        $photos = array_reverse($photos);
        return response()->json($photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
