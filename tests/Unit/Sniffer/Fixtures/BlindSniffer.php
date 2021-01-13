<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Tests\Unit\Sniffer\Fixtures;

use OliverKlee\TddSeed\Sniffer\AbstractSniffer;

class BlindSniffer extends AbstractSniffer
{
    protected string $humanReadableName = 'Sees nothing.';

    public function sniff(string $path): array
    {
        return [];
    }
}
