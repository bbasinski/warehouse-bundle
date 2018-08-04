<?php

namespace Bbasinski\WarehouseBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('warehouse:init:database')
            ->setDescription('Initializes warehouse bundle database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $createDatabase = $this->getApplication()->find('doctrine:database:create');
        $createSchema = $this->getApplication()->find('doctrine:schema:update');
        $loadFixtures = $this->getApplication()->find('doctrine:fixtures:load');

        try {
            $createDatabase->run(new ArrayInput([]), $output);
            $createSchema->run(new ArrayInput(['--force' => true]), $output);
            $loadFixtures->run(new ArrayInput(['--append' => true]), $output);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }
}
