<?php

namespace App\Service\Adapter;

use GuzzleHttp\Client;

class Provider1Adapter implements CurrencyAdapter
{
    public function fetchCurrencies()
    {
        $client = new Client();
        $resp = $client->get('http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0');
        $respBody = json_decode($resp->getBody());

        $currencies = [];

        foreach ($respBody->result as $currency) {
            $currencies[$currency->symbol] = $currency->amount;
        }

        return [
            'USD' => $currencies['USDTRY'],
            'EUR' => $currencies['EURTRY'],
            'GBP' => $currencies['GBPTRY'],
        ];
    }
}