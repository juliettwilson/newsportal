<?php declare(strict_types=1);



namespace Nette\Utils;

use Nette;

if (false) {

	interface IHtmlString extends Nette\HtmlStringable
	{
	}
} elseif (!interface_exists(IHtmlString::class)) {
	class_alias(Nette\HtmlStringable::class, IHtmlString::class);
}

namespace Nette\Localization;

if (false) {

	interface ITranslator extends Translator
	{
	}
} elseif (!interface_exists(ITranslator::class)) {
	class_alias(Translator::class, ITranslator::class);
}
