<?php declare(strict_types=1);

namespace Nette;

use Nette\Utils\ObjectHelpers;



trait SmartObject
{

	public function __call(string $name, array $args)
	{
		$class = static::class;

		if (ObjectHelpers::hasProperty($class, $name) === 'event') { // calling event handlers
			$handlers = $this->$name ?? null;
			if (is_iterable($handlers)) {
				foreach ($handlers as $handler) {
					$handler(...$args);
				}
			} elseif ($handlers !== null) {
				throw new UnexpectedValueException("Property $class::$$name must be iterable or null, " . get_debug_type($handlers) . ' given.');
			}

			return null;
		}

		ObjectHelpers::strictCall($class, $name);
	}

	public static function __callStatic(string $name, array $args)
	{
		ObjectHelpers::strictStaticCall(static::class, $name);
	}


	public function &__get(string $name)
	{
		$class = static::class;

		if ($prop = ObjectHelpers::getMagicProperties($class)[$name] ?? null) { // property getter
			if (!($prop & 0b0001)) {
				throw new MemberAccessException("Cannot read a write-only property $class::\$$name.");
			}

			$m = ($prop & 0b0010 ? 'get' : 'is') . ucfirst($name);
			if ($prop & 0b10000) {
				$trace = debug_backtrace(0, 1)[0]; // suppose this method is called from __call()
				$loc = isset($trace['file'], $trace['line'])
					? " in $trace[file] on line $trace[line]"
					: '';
				trigger_error("Property $class::\$$name is deprecated, use $class::$m() method$loc.", E_USER_DEPRECATED);
			}

			if ($prop & 0b0100) { // return by reference
				return $this->$m();
			} else {
				$val = $this->$m();
				return $val;
			}
		} else {
			ObjectHelpers::strictGet($class, $name);
		}
	}

	public function __set(string $name, mixed $value): void
	{
		$class = static::class;

		if (ObjectHelpers::hasProperty($class, $name)) {
			$this->$name = $value;

		} elseif ($prop = ObjectHelpers::getMagicProperties($class)[$name] ?? null) { // property setter
			if (!($prop & 0b1000)) {
				throw new MemberAccessException("Cannot write to a read-only property $class::\$$name.");
			}

			$m = 'set' . ucfirst($name);
			if ($prop & 0b10000) {
				$trace = debug_backtrace(0, 1)[0];
				$loc = isset($trace['file'], $trace['line'])
					? " in $trace[file] on line $trace[line]"
					: '';
				trigger_error("Property $class::\$$name is deprecated, use $class::$m() method$loc.", E_USER_DEPRECATED);
			}

			$this->$m($value);

		} else {
			ObjectHelpers::strictSet($class, $name);
		}
	}

	public function __unset(string $name): void
	{
		$class = static::class;
		if (!ObjectHelpers::hasProperty($class, $name)) {
			throw new MemberAccessException("Cannot unset the property $class::\$$name.");
		}
	}


	public function __isset(string $name): bool
	{
		return isset(ObjectHelpers::getMagicProperties(static::class)[$name]);
	}
}
