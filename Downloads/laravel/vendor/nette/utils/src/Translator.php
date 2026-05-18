<?php declare(strict_types=1);

namespace Nette\Localization;


interface Translator
{

	function translate(string|\Stringable $message, mixed ...$parameters): string|\Stringable;
}


interface_exists(ITranslator::class);
