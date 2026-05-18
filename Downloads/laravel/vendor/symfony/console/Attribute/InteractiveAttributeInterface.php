<?php


namespace Symfony\Component\Console\Attribute;

/**
 * @internal
 */
interface InteractiveAttributeInterface
{
    public function getFunction(object $instance): \ReflectionFunction;
}
