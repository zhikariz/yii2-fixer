<?php

$config = new PhpCsFixer\Config();

$config->setRules([
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
]);

$config->setFinder(
    PhpCsFixer\Finder::create()
        ->name('*.php')
        ->ignoreDotFiles(true)
        ->ignoreVCS(true)
        ->notPath('vendor')
);

return $config;
