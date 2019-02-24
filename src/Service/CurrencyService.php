<?php

namespace App\Service;

use App\Context\AdapterContext;
use App\Entity\Currency;
use App\Service\Adapter\Provider1Adapter;
use App\Service\Adapter\Provider2Adapter;
use Doctrine\ORM\EntityManagerInterface;

class CurrencyService
{
    private $context;
    private $entityManager;

    public function __construct(
        AdapterContext $context,
        EntityManagerInterface $entityManager
    )
    {
        $this->context = $context;
        $this->entityManager = $entityManager;
    }

    public function getCurrenciesFromDb()
    {
        $currencies = [];
        $dbCurrencies = $this->entityManager->getRepository(Currency::class)->findAll();

        foreach ($dbCurrencies as $currency) {
            $currencies[$currency->getName()] = $currency->getRate();
        }

        return $currencies;
    }

    public function updateCurrenciesOnDb()
    {
        $responses = [];

        $adapters = $this->context->getProviders();

        foreach ($adapters as $adapter) {
            $responses[] = $adapter->fetchCurrencies();
        }

        $currencies = []; // It will be a map as [name] => [min rate of currency]

        foreach ($responses as $response) {
            foreach ($response as $name => $rate) {
                $currencies[$name][] = $rate;
            }
        }

        foreach ($currencies as $name => $rates) {
            $dbCurrency = $this->entityManager->getRepository(Currency::class)->findOneBy(['name' => $name]);

            if (!$dbCurrency) {
                $dbCurrency = new Currency();

                $dbCurrency->setName($name);
                $dbCurrency->setCreatedAt(new \DateTime());
            }

            $dbCurrency->setRate(min($rates));

            $dbCurrency->setUpdatedAt(new \DateTime());

            $this->entityManager->persist($dbCurrency);
        }

        $this->entityManager->flush();
    }
}