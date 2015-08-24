<?php

/**
 * @Test: Testing creation of FlysystemExtension with missing 'default' adapter.
 */

require __DIR__ . '/../bootstrap.php';

\Tester\Assert::exception(function() {
    $container = createContainer(__DIR__ . '/files/adapters.empty.neon');
}, 'UnexpectedValueException', "You have to specify at least one adapter in the 'adapters' section for Flysystem.");

\Tester\Assert::exception(function() {
    $container = createContainer(__DIR__ . '/files/adapters.missing.neon');
}, 'UnexpectedValueException', "You have to specify at least one adapter in the 'adapters' section for Flysystem.");

