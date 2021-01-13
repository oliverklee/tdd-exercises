<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Sniffer;

abstract class AbstractSniffer implements SnifferInterface
{
    protected string $humanReadableName;

    public function getHumanReadableName(): string
    {
        return $this->humanReadableName;
    }
}
