<?php


namespace Mockery\Matcher;

use function count;

class NoArgs extends MatcherAbstract implements ArgumentListMatcher
{
    public function __toString()
    {
        return '<No Arguments>';
    }

    public function match(&$actual)
    {
        return count($actual) === 0;
    }
}
