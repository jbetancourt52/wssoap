<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomSoapController extends Controller
{
    public function handle(Request $request)
    {
        $server = new \SoapServer(null, [
            'uri' => url('/soap')
        ]);
        
        $server->setClass('App\Http\Controllers\CustomSoapService');
        $server->handle();
    }
}
