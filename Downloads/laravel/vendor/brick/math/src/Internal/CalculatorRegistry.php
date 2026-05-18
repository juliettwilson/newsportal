<?php

declare(strict_types=1);

namespace Brick\Math\Internal;

use function extension_loaded;

final class CalculatorRegistry
{
    private static ?Calculator $instance = null;

    final public static function set(?Calculator $calculator): void
    {
        self::$instance = $calculator;
    }

    final public static function get(): Calculator
    {

        if (self::$instance === null) {

            self::$instance = self::detect();
        }


        return self::$instance;
    }

    private static function detect(): Calculator
    {
        if (extension_loaded('gmp')) {
            return new Calculator\GmpCalculator();
        }

        if (extension_loaded('bcmath')) {
            return new Calculator\BcMathCalculator();
        }

        return new Calculator\NativeCalculator();
    }
}
