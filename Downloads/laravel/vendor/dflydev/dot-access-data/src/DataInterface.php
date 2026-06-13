<?php

declare(strict_types=1);


namespace Dflydev\DotAccessData;

use Dflydev\DotAccessData\Exception\DataException;
use Dflydev\DotAccessData\Exception\InvalidPathException;

interface DataInterface
{
    public const PRESERVE = 0;
    public const REPLACE = 1;
    public const MERGE = 2;


    public function append(string $key, $value = null): void;


    public function set(string $key, $value = null): void;


    public function remove(string $key): void;


    public function get(string $key, $default = null);


    public function has(string $key): bool;


    public function getData(string $key): DataInterface;


    public function import(array $data, int $mode = self::REPLACE): void;


    public function importData(DataInterface $data, int $mode = self::REPLACE): void;

    public function export(): array;
}
