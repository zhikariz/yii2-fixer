<?php

/**
 * @author Helmi Adi Prasetyo <helmi.prasetyo12@gmail.com>
 * @copyright Copyright (c) Helmi Adi Prasetyo
 */


namespace zhikariz\yii2\fixer\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VersionCommand extends Command
{
    protected static $defaultName = 'version';

    /**
     * @return mixed
     */
    protected function configure()
    {
        $this
            ->setDescription('Show version information');
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Yii2 Fixer By zhikariz 1.1.0');
        $output->writeln('PHP version: ' . PHP_VERSION);
        $output->writeln('PHP-CS-Fixer version: ' . \PhpCsFixer\Console\Application::VERSION);

        return Command::SUCCESS;
    }
}
