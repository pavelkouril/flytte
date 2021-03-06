<?php

require __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

define('TEMP_DIR', __DIR__ . '/temp/' . getmypid());
@mkdir(dirname(TEMP_DIR));
Tester\Helpers::purge(TEMP_DIR);

/**
 * @param string $file
 * @param array $parameters
 *
 * @return \Nette\DI\Container
 */
function createContainer($file, array $parameters = [])
{
    $loader = new Nette\DI\ContainerLoader(TEMP_DIR, true);
    $class = $loader->load('', function(\Nette\DI\Compiler $compiler) use ($file, $parameters) {
        $compiler->addExtension('extensions', new \Nette\DI\Extensions\ExtensionsExtension());
        if ($parameters) {
            $compiler->addConfig(['parameters' => $parameters]);
        }
        $compiler->loadConfig($file);
    });
    return new $class;
}
