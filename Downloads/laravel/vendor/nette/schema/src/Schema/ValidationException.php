<?php declare(strict_types=1);


namespace Nette\Schema;

use Nette;



class ValidationException extends Nette\InvalidStateException
{
	public function __construct(
		?string $message,
		/** @var list<Message> */
		private array $messages = [],
	) {
		parent::__construct($message ?? $messages[0]->toString());
	}



	public function getMessages(): array
	{
		$res = [];
		foreach ($this->messages as $message) {
			$res[] = $message->toString();
		}

		return $res;
	}



	public function getMessageObjects(): array
	{
		return $this->messages;
	}
}
