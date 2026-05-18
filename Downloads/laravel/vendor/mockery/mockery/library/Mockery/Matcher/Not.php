<?php


namespace Mockery\Matcher;

class Not extends MatcherAbstract
{

    public function __toString()
    {
        return '<Not>';
    }


    public function match(&$actual)
    {
        return $actual !== $this->_expected;
    }
}
