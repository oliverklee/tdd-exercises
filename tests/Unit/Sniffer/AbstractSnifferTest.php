<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Tests\Unit\Sniffer;

use OliverKlee\TddSeed\Sniffer\AbstractSniffer;
use OliverKlee\TddSeed\Sniffer\SnifferInterface;
use OliverKlee\TddSeed\Tests\Unit\Sniffer\Fixtures\BlindSniffer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddSeed\Sniffer\AbstractSniffer
 */
final class AbstractSnifferTest extends TestCase
{
    /**
     * @test
     */
    public function extendsAbstractClass(): void
    {
        /** @var AbstractSniffer|MockObject $subject */
        $subject = $this->getMockForAbstractClass(AbstractSniffer::class);

        self::assertInstanceOf(AbstractSniffer::class, $subject);
    }

    /**
     * @test
     */
    public function implementsSnifferInterface(): void
    {
        /** @var AbstractSniffer|MockObject $subject */
        $subject = $this->getMockForAbstractClass(AbstractSniffer::class);

        self::assertInstanceOf(SnifferInterface::class, $subject);
    }

    /**
     * @test
     */
    public function getHumanReadableNameReturnsNameFromField1(): void
    {
        $subject = new BlindSniffer();

        $result = $subject->getHumanReadableName();

        self::assertSame('Sees nothing.', $result);
    }
}
