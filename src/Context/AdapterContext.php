<?php

namespace App\Context;

use App\Service\Adapter\Provider1Adapter;
use App\Service\Adapter\Provider2Adapter;

class AdapterContext
{
    public function getProviders()
    {
        return [
            new Provider1Adapter(),
            new Provider2Adapter(),
        ];
    }
}