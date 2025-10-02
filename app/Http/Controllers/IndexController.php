<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use SimpleXMLElement;

class IndexController extends Controller
{
    public function __invoke()
    {
        $xml = new SimpleXMLElement('<Error/>');
        $xml->addChild('Code', 403);
        $xml->addChild('Message', 'Access Denied');

        return Response::make($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml');
    }
}
