<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

// Lê o pint.json para usar as mesmas regras no PHP-CS-Fixer
$pint = json_decode((string) file_get_contents(__DIR__ . '/pint.json'), true);

$finder = Finder::create()
    ->in([
        __DIR__ . '/resources',
        __DIR__ . '/src',
    ])
    ->name('*.php')
    ->notName('*.blade.php') // Evita formatar views Blade
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config)
    ->setFinder($finder)
    ->setRules([
        '@PSR12' => true,
        ...$pint['rules'],
    ])
    ->setRiskyAllowed(true); // Permite regras "risky" como declare_strict_types
