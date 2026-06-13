<?php

declare(strict_types=1);

namespace Doctrine\Common\Lexer;

use ReflectionClass;
use UnitEnum;

use function implode;
use function preg_split;
use function sprintf;
use function substr;

use const PREG_SPLIT_DELIM_CAPTURE;
use const PREG_SPLIT_NO_EMPTY;
use const PREG_SPLIT_OFFSET_CAPTURE;

abstract class AbstractLexer
{

    private string $input;


    private array $tokens = [];


    private int $position = 0;


    private int $peek = 0;


    public Token|null $lookahead;


    public Token|null $token;


    private string|null $regex = null;


    public function setInput(string $input)
    {
        $this->input  = $input;
        $this->tokens = [];

        $this->reset();
        $this->scan($input);
    }


    public function reset()
    {
        $this->lookahead = null;
        $this->token     = null;
        $this->peek      = 0;
        $this->position  = 0;
    }


    public function resetPeek()
    {
        $this->peek = 0;
    }

    public function resetPosition(int $position = 0)
    {
        $this->position = $position;
    }

    public function getInputUntilPosition(int $position)
    {
        return substr($this->input, 0, $position);
    }


    public function isNextToken(int|string|UnitEnum $type)
    {
        return $this->lookahead !== null && $this->lookahead->isA($type);
    }


    public function isNextTokenAny(array $types)
    {
        return $this->lookahead !== null && $this->lookahead->isA(...$types);
    }


    public function moveNext()
    {
        $this->peek      = 0;
        $this->token     = $this->lookahead;
        $this->lookahead = isset($this->tokens[$this->position])
            ? $this->tokens[$this->position++] : null;

        return $this->lookahead !== null;
    }


    public function skipUntil(int|string|UnitEnum $type)
    {
        while ($this->lookahead !== null && ! $this->lookahead->isA($type)) {
            $this->moveNext();
        }
    }

    public function isA(string $value, int|string|UnitEnum $token)
    {
        return $this->getType($value) === $token;
    }

    public function peek()
    {
        if (isset($this->tokens[$this->position + $this->peek])) {
            return $this->tokens[$this->position + $this->peek++];
        }

        return null;
    }

    public function glimpse()
    {
        $peek       = $this->peek();
        $this->peek = 0;

        return $peek;
    }


    protected function scan(string $input)
    {
        if (! isset($this->regex)) {
            $this->regex = sprintf(
                '/(%s)|%s/%s',
                implode(')|(', $this->getCatchablePatterns()),
                implode('|', $this->getNonCatchablePatterns()),
                $this->getModifiers(),
            );
        }

        $flags   = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
        $matches = preg_split($this->regex, $input, -1, $flags);

        if ($matches === false) {

            $matches = [[$input, 0]];
        }

        foreach ($matches as $match) {
            // Must remain before 'value' assignment since it can change content
            $firstMatch = $match[0];
            $type       = $this->getType($firstMatch);

            $this->tokens[] = new Token(
                $firstMatch,
                $type,
                $match[1],
            );
        }
    }
    public function getLiteral(int|string|UnitEnum $token)
    {
        if ($token instanceof UnitEnum) {
            return $token::class . '::' . $token->name;
        }

        $className = static::class;

        $reflClass = new ReflectionClass($className);
        $constants = $reflClass->getConstants();

        foreach ($constants as $name => $value) {
            if ($value === $token) {
                return $className . '::' . $name;
            }
        }

        return $token;
    }


    protected function getModifiers()
    {
        return 'iu';
    }


    abstract protected function getCatchablePatterns();


    abstract protected function getNonCatchablePatterns();


    abstract protected function getType(string &$value);
}
