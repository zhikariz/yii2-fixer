<?php

namespace zhikariz\yii2\fixer\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class FixCommand extends Command
{
    protected static $defaultName = 'fix';

    protected function configure()
    {
        $this
            ->setDescription('Fix code style in Yii2 projects with Yii2 Fixer')
            ->addArgument('path', InputArgument::OPTIONAL, 'The path to fix', '.')
            ->addOption('config', 'c', InputOption::VALUE_OPTIONAL, 'The path to a config file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');
        $configFile = $input->getOption('config') ?: __DIR__ . '/../../../fixer.php';

        $output->writeln('Fixing code style...');

        $command = 'vendor/bin/php-cs-fixer fix --config ' . escapeshellarg($configFile) . ' ' . escapeshellarg($path);

        $result = exec($command, $outputLines, $returnCode);

        if ($returnCode === 0) {
            $output->writeln('Code style fixed successfully.');
        } else {
            $output->writeln('Error fixing code style.');
            foreach ($outputLines as $line) {
                $output->writeln($line);
            }
        }

        return $returnCode === 0 ? Command::SUCCESS : Command::FAILURE;
    }

    private function getRules(): array
    {
        return [
            '@PSR2' => true,
            'array_syntax' => ['syntax' => 'short'],
            'indentation_type' => true,
            'no_unused_imports' => true,
            'single_quote' => true,
            'braces' => ['allow_single_line_closure' => true],
            'class_attributes_separation' => ['elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one']],
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_after_phpdoc' => true,
            'phpdoc_align' => ['align' => 'vertical'],
            'phpdoc_indent' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_package' => true,
            'phpdoc_scalar' => true,
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_var_without_name' => true,
        ];
    }
}
