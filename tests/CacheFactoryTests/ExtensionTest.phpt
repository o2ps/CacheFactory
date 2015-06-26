<?php

namespace OopsTests\CacheFactory\DI;

use Tester\Assert;
use Tester\TestCase;


require_once __DIR__ . '/../bootstrap.php';


class ExtensionTest extends TestCase
{

	public function testExtension()
	{
		$configurator = new \Nette\Configurator();
		$configurator->addConfig(__DIR__ . '/config.neon');
		$configurator->setTempDirectory(TEMP_DIR);
		$container = $configurator->createContainer();

		$cacheFactory = $container->getService('cacheFactory.cacheFactory');
		Assert::type('Oops\CacheFactory\Caching\CacheFactory', $cacheFactory);
		Assert::type('Nette\Caching\Storages\DevNullStorage', $cacheFactory->create()->getStorage());
	}

}


$test = new ExtensionTest();
$test->run();
