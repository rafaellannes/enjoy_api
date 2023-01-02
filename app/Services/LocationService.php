<?php

namespace App\Services;

class LocationService
{

    protected $key;

    public function __construct()
    {
        $this->key = env('GOOGLE_TRANSLATE_API_KEY');
    }

    public function getDistance($latitudeInicial, $longitudeInicial, $latitudeFinal, $longitudeFinal)
    {
        $url = $this->makeUrl($latitudeInicial, $longitudeInicial, $latitudeFinal, $longitudeFinal);

        //GuzzleHttp\Client
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $url);

        $response = json_decode($response->getBody()->getContents());

        return [
            'distance' => $response->rows[0]->elements[0]->distance->text,
            'duration' => $response->rows[0]->elements[0]->duration->text

        ];
    }

    private function makeUrl($latitudeInicial, $longitudeInicial, $latitudeFinal, $longitudeFinal)
    {
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric?language=pt-BR&origins='
            . $latitudeInicial . ',' . $longitudeInicial . '&destinations=' . $latitudeFinal . ',' . $longitudeFinal . '&key=' . $this->key;

        return $url;
    }
}
