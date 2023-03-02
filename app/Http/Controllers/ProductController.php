<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    public function index()
    {
        $url = 'http://149.129.221.143/kanaldata/Webservice/bank_account';
        $form = [
            'form_params' => [
                'bank_id' => '2'
            ]
        ];
        $client = new Client();
        $res    = $client->post($url, $form);
        $get    = $res->getBody();
        return response()->json(json_decode($get, true));
    }
}
