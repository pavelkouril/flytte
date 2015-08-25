# Flytte - Flysystem integration for Nette Framework

This package provides [Flysystem](http://flysystem.thephpleague.com) integration via compiler extension for [Nette Framework](http://nette.org) 2.3.

## Installation

You can install this package via composer
```
$ composer require pavelkouril/flytte
```

## Usage

To use Flysystem in your Nette project, you just need to register the `PavelKouril\Flytte\DI\FlysystemExtension` in the `extensions` section of you config file.

Like this:
```
extensions:
    flysystem: PavelKouril\Flytte\DI\FlysystemExtension
```

This will enable you to configure Flysystem in the `flysystem` section, like this:
```
flysystem:
    default: local
    adapters:
        local: League\Flysystem\Adapter\Local("%appDir%/...")

```

The name of `default` adapter has to be the key of one of your adapters. You need to specify at least one adapter.

### Multiple Filesystems

The default `League\Flysystem\Filesystem` instance (using the `default` adapter) is autowired. The rest is not autowired, but is accessible in your config via  `@flysystem.filesystems.local` (if you are interested in the `Filesystem` class) or `@flysystem.adapters.local` (if you are interested in the adapter itself).

#### MountManager

You can access multiple filesystems simultaneously by using the [League\Flysystem\MountManager](http://flysystem.thephpleague.com/mount-manager/) class. The `MountManager` class is autowired. All the filesystems are registered by their adapter name in config as a protocol (ie. `local://`).

## Adapters

By default, only the adapters included by default in Flysystem are available.
- [League\Flysystem\Adapter\Local](http://flysystem.thephpleague.com/adapter/local/)
- [League\Flysystem\Adapter\Ftp](http://flysystem.thephpleague.com/adapter/ftp/)
- [League\Flysystem\Adapter\NullAdapter](http://flysystem.thephpleague.com/adapter/null-test/)

Other adapters need to be obtained separately - packages name and their usage can be found at the [official site](http://flysystem.thephpleague.com/adapter/).
