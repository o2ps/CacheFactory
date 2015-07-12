<?php

namespace Oops\CacheFactory\Caching;

use Nette\Caching\Cache;
use Nette\Caching\IStorage;


class CacheFactory
{

	/** @var IStorage */
	private $storage;


	public function __construct(IStorage $storage)
	{
		$this->storage = $storage;
	}


	/**
	 * @param string $namespace
	 * @return Cache
	 */
	public function create($namespace = NULL, IStorage $storage = NULL)
	{
		return new Cache($storage !== NULL ? $storage : $this->storage, $namespace);
	}

}
