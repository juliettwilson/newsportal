<?php

namespace Faker\Extension;

interface UuidExtension extends Extension
{
    public function uuid3(): string;
}
