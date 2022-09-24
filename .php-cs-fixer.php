<?php

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => false,
        'array_indentation' => false,
        'array_syntax' => ['syntax' => 'short'],
    ])
    // ->setIndent("\t")
    ->setLineEnding("\n")
;