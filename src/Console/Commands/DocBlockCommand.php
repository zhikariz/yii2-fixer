<?php

/**
 * @author Helmi Adi Prasetyo <helmi.prasetyo12@gmail.com>
 * @copyright Copyright (c) Helmi Adi Prasetyo
 */


namespace zhikariz\yii2\fixer\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class DocBlockCommand extends Command
{
    protected static $defaultName = 'docblock';

    /**
     * @return mixed
     */
    protected function configure()
    {
        $this
            ->setDescription('Generate docblocks for functions and variables in PHP files')
            ->addArgument('path', InputArgument::OPTIONAL, 'The path to scan', '.');
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');

        $output->writeln('Generating docblocks...');

        $finder = Finder::create()
            ->files()
            ->name('*.php')
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->notPath('vendor')
            ->in($path);

        $filesProcessed = 0;
        $docblocksAdded = 0;

        foreach ($finder as $file) {
            $content = $file->getContents();
            $lines = explode("\n", $content);
            $insertions = [];

            for ($i = 0; $i < count($lines); $i++) {
                $line = $lines[$i];

                // Check for function declaration
                if (preg_match('/^\s*(public|private|protected)?\s*function\s+(\w+)\s*\(([^)]*)\)(?:\s*:\s*([^;\s{]+))?/', $line, $matches)) {
                    // Check if previous line is not a docblock
                    $prevLine = $i > 0 ? trim($lines[$i - 1]) : '';
                    if (!preg_match('/^\s*\*\//', $prevLine) && !preg_match('/^\s*\/\*\*/', $prevLine)) {
                        $functionName = $matches[2];
                        $params = $matches[3] ?? '';
                        $returnType = $matches[4] ?? 'mixed';

                        $docblock = ['    /**'];

                        // Parse parameters
                        if (!empty($params)) {
                            $paramList = explode(',', $params);
                            foreach ($paramList as $param) {
                                $param = trim($param);
                                if (preg_match('/(\w+)\s+\$(\w+)/', $param, $paramMatches)) {
                                    $paramType = $paramMatches[1];
                                    $paramName = $paramMatches[2];
                                    $docblock[] = '     * @param ' . $paramType . ' $' . $paramName;
                                }
                            }
                        }

                        $docblock[] = '     * @return ' . $returnType;
                        $docblock[] = '     */';

                        // Add insertion before this line
                        $insertions[] = [
                            'line' => $i,
                            'content' => $docblock
                        ];
                        $docblocksAdded++;
                    }
                }

                // Check for property declaration (simple case: visibility $var)
                if (preg_match('/^\s*(public|private|protected)\s+\$\w+/', $line)) {
                    // Check if previous line is not a docblock
                    $prevLine = $i > 0 ? trim($lines[$i - 1]) : '';
                    if (!preg_match('/^\s*\*\//', $prevLine) && !preg_match('/^\s*\/\*\*/', $prevLine)) {
                        // Add insertion before this line
                        $insertions[] = [
                            'line' => $i,
                            'content' => [
                                '    /**',
                                '     * @var mixed',
                                '     */'
                            ]
                        ];
                        $docblocksAdded++;
                    }
                }
            }

            // Apply insertions from bottom to top
            $insertions = array_reverse($insertions);
            foreach ($insertions as $insertion) {
                array_splice($lines, $insertion['line'], 0, $insertion['content']);
            }

            $newContent = implode("\n", $lines);
            if ($newContent !== $content) {
                file_put_contents($file->getRealPath(), $newContent);
                $filesProcessed++;
            }
        }

        $output->writeln("Processed $filesProcessed files, added $docblocksAdded docblocks.");

        return Command::SUCCESS;
    }
}
