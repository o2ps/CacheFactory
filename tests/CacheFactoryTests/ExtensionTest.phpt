<?php

namespace OopsTests\CacheFactory\DI;

use Nette\Caching\Storages\DevNullStorage;
use Nette\Configurator;
use Oops\CacheFactory\Caching\CacheFactory;
use Tester\Assert;
use Tester\TestCase;


require_once __DIR__ . '/../bootstrap.php';


class ExtensionTest extends TestCase
{

	public function testExtension()
	{
		$configurator = new Configurator();
		$configurator->addConfig(__DIR__ . '/config.neon');
		$configurator->setTempDirectory(TEMP_DIR);
		$container = $configurator->createContainer();

		$cacheFactory = $container->getService('cacheFactory.cacheFactory');
		Assert::type(CacheFactory::class, $cacheFactory);
		Assert::type(DevNullStorage::class, $cacheFactory->create()->getStorage());
	}

}


$test = new ExtensionTest();
$test->run();
