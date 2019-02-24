<?php

namespace App\Service\Adapter;

use GuzzleHttp\Client;

class Provider2Adapter implements CurrencyAdapter
{
    public function fetchCurrencies()
    {
        $client = new Client();
        $resp = $client->get("http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3");
        $respBody = json_decode($resp->getBody());

        $currencies = [];

        foreach ($respBody as $currency) {
            $currencies[$currency->kod] = $currency->oran;
        }

        return [
            'USD' => $currencies['DOLAR'],
            'EUR' => $currencies['AVRO'],
            'GBP' => $currencies['İNGİLİZ STERLİNİ'],
        ];
    }
}