<?php

namespace PavelKouril\Flytte\DI;

use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use Nette\DI\CompilerExtension;
use Nette\DI\Statement;
use PavelKouril\Flytte\Exception\UnexpectedValueException;

/**
 * @author Pavel Kouřil <pk@pavelkouril.cz>
 */
class FlysystemExtension extends CompilerExtension
{
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->getConfig();
        $default = null;

        if (!isset($config['default'])) {
            throw new UnexpectedValueException("You have to specify 'default' adapter for Flysystem.");
        }

        if (!isset($config['adapters'])) {
            throw new UnexpectedValueException("You have to specify at least one adapter in the 'adapters' section for Flysystem.");
        }

        $mountManager = $builder->addDefinition($this->prefix('mountmanager'))->setClass(MountManager::class);

        /**
         * @var string $key
         * @var Statement $item
         */
        foreach ($config['adapters'] as $key => $item) {
            $adapter = $builder->addDefinition($this->prefix("adapters.$key"))->setClass($item->getEntity(), $item->arguments)->setAutowired(false);
            $fileSystem = $builder->addDefinition($this->prefix("filesystems.$key"))->setClass(Filesystem::class, [$adapter])->setAutowired(false);
            $mountManager->addSetup('mountFilesystem', [$key, $fileSystem]);
            if ($key === $config['default']) {
                $default = $adapter;
            }
        };

        if ($default === null) {
            throw new UnexpectedValueException("Can't find the specified default adapter.");
        }

        $builder->addDefinition($this->prefix('default'))->setClass(Filesystem::class, [$default]);
    }
}
