<?php declare(strict_types=1);



namespace Nette\Schema;

use function count;


final class Context
{
	public bool $skipDefaults = false;


	public array $path = [];

	public bool $isKey = false;


	public array $errors = [];


	public array $warnings = [];


	public array $dynamics = [];



	public function addError(string $message, string $code, array $variables = []): Message
	{
		$variables['isKey'] = $this->isKey;
		return $this->errors[] = new Message($message, $code, $this->path, $variables);
	}



	public function addWarning(string $message, string $code, array $variables = []): Message
	{
		return $this->warnings[] = new Message($message, $code, $this->path, $variables);
	}



	public function createChecker(): \Closure
	{
		$count = count($this->errors);
		return fn(): bool => $count === count($this->errors);
	}
}
