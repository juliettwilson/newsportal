<?php

namespace Faker\Extension;

interface VersionExtension extends Extension
{

    public function semver(bool $preRelease = false, bool $build = false): string;
}
