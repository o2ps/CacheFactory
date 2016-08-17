# Oops/CacheFactory

Caching is a very common task in web development. The current practice of creating `Cache` instances in Nette is to enumerate `IStorage` as a dependency and create the `Cache` by hand, as seen [in the docs](http://doc.nette.org/en/2.3/caching#toc-storage-service). This, however, makes unit testing classes that depend on cache a pain in the you-know-what. You either need to mock the storage and go through `Cache` code to find what methods are called upon the storage, or use some [autoloading magic](http://docs.mockery.io/en/latest/cookbook/mocking_hard_dependencies.html). I don't think either way is a good one to go. I've found myself writing a simple factory like the one in this package on every project, so I made an extension out of it.


## Installation and requirements

```bash
$ composer require oops/cache-factory
```

Oops/CacheFactory requires PHP >= 5.6.


## Usage

Register the extension in your config:

```yaml
extensions:
	cacheFactory: Oops\CacheFactory\DI\CacheFactoryExtension
```

And replace all occurrences of direct `Cache` instantiation with call to the factory, so that this:

```php
class CachedFoo
{
	private $cache;

	public function __construct(Nette\Caching\IStorage $cacheStorage)
	{
		$this->cache = new Nette\Caching\Cache($cacheStorage, 'namespace');
	}
}
```

becomes this:

```php
class CachedFoo
{
	private $cache;

	public function __construct(Oops\CacheFactory\Caching\CacheFactory $cacheFactory)
	{
		$this->cache = $cacheFactory->create('namespace');
	}
}
```

The factory automatically uses the storage registered in the config. To provide backwards compatibility, you can also pass to the factory an arbitrary storage, should you need it:

```php
$cacheFactory->create('namespace', new Nette\Caching\Storages\DevNullStorage());
```
