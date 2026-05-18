<?php


namespace Mockery\Matcher;

class Any extends MatcherAbstract
{

    public function __toString()
    {
        return '<Any>';
    }


    public function match(&$actual)
    {
        return true;
    }
}
