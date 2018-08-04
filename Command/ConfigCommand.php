<?php

namespace Bbasinski\WarehouseBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('warehouse:init:config')
            ->setDescription('Configures warehouse bundle');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->registerRoutes($output);
        $this->configureDatabase($output);
    }

    private function registerRoutes(OutputInterface $output)
    {
        $copyFrom = __DIR__ . '/../Resources/config/routes.yaml';
        $copyTo = getcwd() . '/config/routes.yaml';

        if (copy($copyFrom, $copyTo)) {
            $output->writeln('<info>Routes successfully copied into config/routes.yaml</info>');
        } else {
            $output->writeln('<error>Failed to copy routes. You\'ll need to register routes manually.</error>');
        }
    }

    private function configureDatabase(OutputInterface $output)
    {
        $envFile = getcwd() . '/.env';
        $envFileTmp = getcwd() . '/.env.tmp';

        $read = fopen($envFile, 'r');
        $write = fopen($envFileTmp, 'w');

        while (!feof($read)) {
            $line = fgets($read);

            if (stristr($line, 'DATABASE_URL')) {
                $line = 'DATABASE_URL=sqlite:///%kernel.project_dir%/var/warehouse.db' . PHP_EOL;
            }

            fputs($write, $line);
        }

        fclose($read);
        fclose($write);

        if (copy($envFileTmp, $envFile)) {
            $output->writeln('<info>DATABASE_URL configured.</info>');
            unlink($envFileTmp);
        }
    }
}
