<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    public function getOngkir($destination)
    {
        $client = new Client();

        try {
            $formParams = [
                'origin' => '7', // ID of the origin city
                'destination' => $destination,
                'weight' => 1000, // Default weight set to 1000 grams (1 kg)
                'courier' => 'jne'
            ];

            $response = $client->post('https://api.rajaongkir.com/starter/cost', [
                'form_params' => $formParams,
                'headers' => [
                    'content-type' => 'application/x-www-form-urlencoded',
                    'key' => env('RAJAONGKIR_API_KEY')
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            Log::info('Request Data: ', $formParams);
            Log::info('Response from RajaOngkir: ' . $responseBody);

            if ($response->getStatusCode() !== 200) {
                return response()->json(['error' => "Error: " . $response->getReasonPhrase()], 500);
            }

            $responseBody = json_decode($responseBody, true);
            return response()->json($responseBody);

        } catch (\Exception $e) {
            Log::error('ShippingController@getOngkir: ' . $e->getMessage());

            return response()->json(['error' => 'Internal Server Error. Please try again later.'], 500);
        }
    }
}
