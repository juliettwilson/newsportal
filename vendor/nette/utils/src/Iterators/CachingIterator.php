<?php declare(strict_types=1);


namespace Nette\Iterators;

use Nette;


class CachingIterator extends \CachingIterator implements \Countable
{
	use Nette\SmartObject;

	private int $counter = 0;

	public function __construct(iterable|\stdClass $iterable)
	{
		$iterable = $iterable instanceof \stdClass
			? new \ArrayIterator((array) $iterable)
			: Nette\Utils\Iterables::toIterator($iterable);
		parent::__construct($iterable, 0);
	}


	public function isFirst(?int $gridWidth = null): bool
	{
		return $this->counter === 1 || ($gridWidth && $this->counter !== 0 && (($this->counter - 1) % $gridWidth) === 0);
	}



	public function isLast(?int $gridWidth = null): bool
	{
		return !$this->hasNext() || ($gridWidth && ($this->counter % $gridWidth) === 0);
	}


	public function isEmpty(): bool
	{
		return $this->counter === 0;
	}


	public function isOdd(): bool
	{
		return $this->counter % 2 === 1;
	}


	public function isEven(): bool
	{
		return $this->counter % 2 === 0;
	}


	public function getCounter(): int
	{
		return $this->counter;
	}


	public function count(): int
	{
		$inner = $this->getInnerIterator();
		if ($inner instanceof \Countable) {
			return $inner->count();

		} else {
			throw new Nette\NotSupportedException('Iterator is not countable.');
		}
	}



	public function next(): void
	{
		parent::next();
		if (parent::valid()) {
			$this->counter++;
		}
	}


	public function rewind(): void
	{
		parent::rewind();
		$this->counter = parent::valid() ? 1 : 0;
	}


	public function getNextKey(): mixed
	{
		return $this->getInnerIterator()->key();
	}

	public function getNextValue(): mixed
	{
		return $this->getInnerIterator()->current();
	}
}
