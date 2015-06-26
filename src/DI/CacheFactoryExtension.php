<?php

namespace Oops\CacheFactory\DI;

use Nette\DI\CompilerExtension;


class CacheFactoryExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('cacheFactory'))
			->setClass('Oops\\CacheFactory\\Caching\\CacheFactory');
	}

}
