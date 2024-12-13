<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/test');
;

return (new PhpCsFixer\Config())
    ->setFinder($finder)
;
