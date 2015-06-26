<?php

/**
 * @testCase
 */

namespace OopsTests\CacheFactory\Caching;

use Oops\CacheFactory\Caching\CacheFactory;
use Tester\Assert;
use Tester\TestCase;


require_once __DIR__ . '/../bootstrap.php';


class CacheFactoryTest extends TestCase
{

	public function testWithNamespace()
	{
		$storage = \Mockery::mock('Nette\Caching\IStorage');
		$factory = new CacheFactory($storage);

		$ns = 'CacheNS';
		$cache = $factory->create($ns);
		Assert::type('Nette\Caching\Cache', $cache);
		Assert::same($storage, $cache->getStorage());
		Assert::same($ns, $cache->getNamespace());
	}


	public function testNullNamespace()
	{
		$storage = \Mockery::mock('Nette\Caching\IStorage');
		$factory = new CacheFactory($storage);

		$cache = $factory->create();
		Assert::type('Nette\Caching\Cache', $cache);
		Assert::same($storage, $cache->getStorage());
		Assert::same('', $cache->getNamespace());
	}


	public function testWithCustomStorage()
	{
		$storage = \Mockery::mock('Nette\Caching\IStorage');
		$storage2 = \Mockery::mock('Nette\Caching\IStorage');
		$factory = new CacheFactory($storage);

		$ns = 'CacheNS';
		$cache = $factory->create($ns, $storage2);
		Assert::type('Nette\Caching\Cache', $cache);
		Assert::notSame($storage, $cache->getStorage());
		Assert::same($storage2, $cache->getStorage());
		Assert::same($ns, $cache->getNamespace());
	}


	public function testNullNamespaceWithCustomStorage()
	{
		$storage = \Mockery::mock('Nette\Caching\IStorage');
		$storage2 = \Mockery::mock('Nette\Caching\IStorage');
		$factory = new CacheFactory($storage);

		$cache = $factory->create(NULL, $storage2);
		Assert::type('Nette\Caching\Cache', $cache);
		Assert::notSame($storage, $cache->getStorage());
		Assert::same($storage2, $cache->getStorage());
		Assert::same('', $cache->getNamespace());
	}


	protected function tearDown()
	{
		\Mockery::close();
	}

}


$test = new CacheFactoryTest();
$test->run();
