<?php
$header = <<<'EOF'
This file is part of the PascalCoin PHP package.

(c) Benjamin Ansbach <benjaminansbach@gmail.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;
$finder = PhpCsFixer\Finder::create()
    ->exclude(['build', 'vendor'])
    ->in(__DIR__);
return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'yoda_style' => false,
        'header_comment' => ['header' => $header],
        'declare_strict_types' => true,
        'phpdoc_align' => false,
        'phpdoc_order' => true,
        'ordered_imports' => true,
        'array_syntax' => ['syntax' => 'short'],
    ]);
