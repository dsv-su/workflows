<?php

namespace App\Services;

use App\Models\Country;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Skatteverket
{
    protected $endpoint, $client, $resource;
    protected $list;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getResource($endpoint)
    {
        try {
            return $this->client->request('GET', 'https://skatteverket.entryscape.net/rowstore'. $endpoint, [
                'headers' => ['Accept' =>  "application/json"]
            ]);
        } catch (ClientException $e) {
            report($e);
            abort(404);
        }
    }

    //Retrieving countries
    public function getCountry()
    {
        //Retrive allowances for 2023
        $this->array_resource = json_decode($this->getResource('/dataset/70ccea31-b64c-4bf5-84c7-673f04f32505?%C3%A5r=2023&_limit=500&_offset=0')->getBody()->getContents(), TRUE);

        foreach ($this->array_resource['results'] as $result_country) {
            $country = Country::updateOrCreate(
                ['country' => $result_country['land eller område']],
                ['allowance' => $result_country['normalbelopp'],
                  'year' =>  $result_country['år']]
            );

        }
        return true;
    }
}
