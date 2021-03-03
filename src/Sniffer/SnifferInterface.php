<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Sniffer;

interface SnifferInterface
{
    public function getHumanReadableName(): string;

    /**
     * Sniffs the given directory recursively for code smells.
     *
     * @return string[] the offending files relative to $path.
     */
    public function sniff(string $path): array;
}
