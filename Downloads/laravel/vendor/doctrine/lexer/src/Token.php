<?php

declare(strict_types=1);

namespace Doctrine\Common\Lexer;

use UnitEnum;

use function in_array;

final class Token
{

    public string|int $value;

    public $type;


    public int $position;


    public function __construct(string|int $value, $type, int $position)
    {
        $this->value    = $value;
        $this->type     = $type;
        $this->position = $position;
    }


    public function isA(...$types): bool
    {
        return in_array($this->type, $types, true);
    }
}
