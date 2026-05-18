<?php declare(strict_types=1);



namespace Monolog;

use InvalidArgumentException;



class Registry
{

    private static array $loggers = [];


    public static function addLogger(Logger $logger, ?string $name = null, bool $overwrite = false): void
    {
        $name = $name ?? $logger->getName();

        if (isset(self::$loggers[$name]) && !$overwrite) {
            throw new InvalidArgumentException('Logger with the given name already exists');
        }

        self::$loggers[$name] = $logger;
    }


    public static function hasLogger($logger): bool
    {
        if ($logger instanceof Logger) {
            $index = array_search($logger, self::$loggers, true);

            return false !== $index;
        }

        return isset(self::$loggers[$logger]);
    }


    public static function removeLogger($logger): void
    {
        if ($logger instanceof Logger) {
            if (false !== ($idx = array_search($logger, self::$loggers, true))) {
                unset(self::$loggers[$idx]);
            }
        } else {
            unset(self::$loggers[$logger]);
        }
    }

    /**
     * Clears the registry
     */
    public static function clear(): void
    {
        self::$loggers = [];
    }

    /**
     * Gets Logger instance from the registry
     *
     * @param  string                    $name Name of the requested Logger instance
     * @throws \InvalidArgumentException If named Logger instance is not in the registry
     */
    public static function getInstance(string $name): Logger
    {
        if (!isset(self::$loggers[$name])) {
            throw new InvalidArgumentException(sprintf('Requested "%s" logger instance is not in the registry', $name));
        }

        return self::$loggers[$name];
    }

    /**
     * Gets Logger instance from the registry via static method call
     *
     * @param  string                    $name      Name of the requested Logger instance
     * @param  mixed[]                   $arguments Arguments passed to static method call
     * @throws \InvalidArgumentException If named Logger instance is not in the registry
     * @return Logger                    Requested instance of Logger
     */
    public static function __callStatic(string $name, array $arguments): Logger
    {
        return self::getInstance($name);
    }
}
