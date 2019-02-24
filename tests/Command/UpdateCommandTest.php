<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class UpdateCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $app = new Application($kernel);

        $command = $app->find('app:update');
        $tester = new CommandTester($command);
        $tester->execute([
            'command' => $command->getName(),
        ]);

        $output = $tester->getDisplay();

        $this->assertContains('Updating currencies...', $output);
        $this->assertContains('Currencies updated.', $output);
    }
}