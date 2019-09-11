<?php
$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
     ->setRules([
         '@Symfony' => true,
         'is_null' => [
             'use_yoda_style' => false,
         ],
         'binary_operator_spaces' => ['align_double_arrow' => false],
         'array_syntax' => ['syntax' => 'short'],
         'linebreak_after_opening_tag' => true,
         'not_operator_with_successor_space' => false,
         'ordered_imports' => true,
         'phpdoc_order' => true,

     ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__.'/storage/.php_cs.cache')
    ->setUsingCache(false);
