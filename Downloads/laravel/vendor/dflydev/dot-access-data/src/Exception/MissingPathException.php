<?php

declare(strict_types=1);


namespace Dflydev\DotAccessData\Exception;

use Throwable;


class MissingPathException extends DataException
{

    protected $path;

    public function __construct(string $path, string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $this->path = $path;

        parent::__construct($message, $code, $previous);
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
