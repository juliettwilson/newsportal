<?php declare(strict_types=1);


namespace Nette\Iterators;


class Mapper extends \IteratorIterator
{
	private \Closure $callback;


	public function __construct(\Traversable $iterator, callable $callback)
	{
		parent::__construct($iterator);
		$this->callback = $callback(...);
	}


	public function current(): mixed
	{
		return ($this->callback)(parent::current(), parent::key());
	}
}
