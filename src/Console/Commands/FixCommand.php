<?php

/**
 * @author Helmi Adi Prasetyo <helmi.prasetyo12@gmail.com>
 * @copyright Copyright (c) Helmi Adi Prasetyo
 */


namespace zhikariz\yii2\fixer\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FixCommand extends Command
{
    protected static $defaultName = 'fix';

    /**
     * @return mixed
     */
    protected function configure()
    {
        $this
            ->setDescription('Fix code style in Yii2 projects with Yii2 Fixer')
            ->addArgument('path', InputArgument::OPTIONAL, 'The path to fix', '.')
            ->addOption('config', 'c', InputOption::VALUE_OPTIONAL, 'The path to a config file');
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');
        $configFile = $input->getOption('config') ?: __DIR__ . '/../../../fixer.php';

        $output->writeln('Fixing code style...');

        $command = 'vendor/bin/php-cs-fixer fix --config ' . escapeshellarg($configFile) . ' ' . escapeshellarg($path);

        $result = exec($command, $outputLines, $returnCode);

        if ($returnCode === 0) {
            $output->writeln('Code style fixed successfully.');

            // Remove PHP-CS-Fixer cache file
            $cacheFile = '.php-cs-fixer.cache';
            if (file_exists($cacheFile)) {
                unlink($cacheFile);
                $output->writeln('Removed .php-cs-fixer.cache file.');
            }
        } else {
            $output->writeln('Error fixing code style.');
            foreach ($outputLines as $line) {
                $output->writeln($line);
            }
        }

        return $returnCode === 0 ? Command::SUCCESS : Command::FAILURE;
    }
}
