<?php

namespace App\Command;

use App\Service\CurrencyService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencyCommand extends Command
{
    private $currencyService;

    protected static $defaultName = 'app:update';

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Fetch currencies and refresh values in homepage.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Updating currencies...');

        $this->currencyService->updateCurrenciesOnDb();

        $output->writeln('Currencies updated.');
    }
}