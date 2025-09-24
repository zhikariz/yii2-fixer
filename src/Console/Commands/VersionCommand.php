<?php

namespace zhikariz\yii2\fixer\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VersionCommand extends Command
{
    protected static $defaultName = 'version';

    protected function configure()
    {
        $this
            ->setDescription('Show version information');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Yii2 Fixer By zhikariz 1.0.2');
        $output->writeln('PHP version: ' . PHP_VERSION);
        $output->writeln('PHP-CS-Fixer version: ' . \PhpCsFixer\Console\Application::VERSION);

        return 0;
    }
}
