<?php

namespace Oops\CacheFactory\DI;

use Nette\DI\CompilerExtension;
use Oops\CacheFactory\Caching\CacheFactory;


class CacheFactoryExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('cacheFactory'))
			->setClass(CacheFactory::class);
	}

}
