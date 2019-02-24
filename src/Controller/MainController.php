<?php

namespace App\Controller;

use App\Service\CurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @Route("/")
     */
    public function mainPage()
    {
        $currencies = $this->currencyService->getCurrenciesFromDb();

        return $this->render('currencies.html.twig', [
            'usd' => $currencies['USD'],
            'eur' => $currencies['EUR'],
            'gbp' => $currencies['GBP'],
        ]);
    }
}