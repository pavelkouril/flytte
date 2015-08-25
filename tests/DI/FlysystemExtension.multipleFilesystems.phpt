<?php

/**
 * @Test: Testing creation of FlysystemExtension with missing 'default' adapter.
 */

use League\Flysystem\AdapterInterface;
use League\Flysystem\FilesystemInterface;

require __DIR__ . '/../bootstrap.php';

$container = createContainer(__DIR__ . '/files/multiple.neon', ['dir' => __DIR__]);

/** @var FilesystemInterface $defaultFilesystem */
$defaultFilesystem = $container->getByType(FilesystemInterface::class);

\Tester\Assert::same(3, count($container->findByType(AdapterInterface::class)));
\Tester\Assert::same(4, count($container->findByType(FilesystemInterface::class))); // number of adapters + 1
