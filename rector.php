<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    // Paths to refactor
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

    // Safe PHP upgrades (no risky behavioral changes)
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_83,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
    ]);

    // STRICT TYPES: important
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses(false);

    // Keep this conservative early
    $rectorConfig->skip([
        // avoid risky magic transformations in early stage
        \Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector::class => true,
    ]);
};
