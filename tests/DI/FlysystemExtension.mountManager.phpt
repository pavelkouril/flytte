<?php

/**
 * @Test: Testing creation of FlysystemExtension with missing 'default' adapter.
 */

use League\Flysystem\MountManager;

require __DIR__ . '/../bootstrap.php';

$container = createContainer(__DIR__ . '/files/multiple.neon', ['dir' => __DIR__]);

/** @var MountManager $mountManager */
$mountManager = $container->getByType(MountManager::class);

\Tester\Assert::same(__DIR__  . DIRECTORY_SEPARATOR, $mountManager->getFilesystem('foo')->getAdapter()->getPathPrefix());
\Tester\Assert::same(__DIR__  . DIRECTORY_SEPARATOR, $mountManager->getFilesystem('bar')->getAdapter()->getPathPrefix());
\Tester\Assert::same(__DIR__  . DIRECTORY_SEPARATOR, $mountManager->getFilesystem('local')->getAdapter()->getPathPrefix());
