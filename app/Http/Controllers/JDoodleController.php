<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class JDoodleController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'script' => ['required']
        ]);

        $client = new Client();

        $response = $client->post('https://api.jdoodle.com/v1/execute', [
            'json' => [
                'script' => $request->script,
                'language' => "nodejs",
                'versionIndex' => "0",
                'clientId' => env('CLIENT_ID'),
                'clientSecret' => env('CLIENT_SECRET')
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return response()->json($data);
    }
}
