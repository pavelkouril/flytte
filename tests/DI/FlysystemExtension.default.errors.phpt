<?php

/**
 * @Test: Testing creation of FlysystemExtension with missing 'default' adapter.
 */

require __DIR__ . '/../bootstrap.php';

\Tester\Assert::exception(function() {
    $container = createContainer(__DIR__ . '/files/default.empty.neon');
}, 'UnexpectedValueException', "You have to specify 'default' adapter for Flysystem.");

\Tester\Assert::exception(function() {
    $container = createContainer(__DIR__ . '/files/default.missing.neon');
}, 'UnexpectedValueException', "You have to specify 'default' adapter for Flysystem.");


\Tester\Assert::exception(function() {
    $container = createContainer(__DIR__ . '/files/default.notfound.neon');
}, 'UnexpectedValueException', "Can't find the specified default adapter.");
