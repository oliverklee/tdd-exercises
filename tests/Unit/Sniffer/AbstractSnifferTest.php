<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Tests\Unit\Sniffer;

use OliverKlee\TddSeed\Sniffer\AbstractSniffer;
use OliverKlee\TddSeed\Sniffer\SnifferInterface;
use OliverKlee\TddSeed\Tests\Unit\Sniffer\Fixtures\BlindSniffer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddSeed\Sniffer\AbstractSniffer
 */
final class AbstractSnifferTest extends TestCase
{
    private AbstractSniffer $subject;

    protected function setUp(): void
    {
        $this->subject = $this->getMockForAbstractClass(AbstractSniffer::class);
    }

    /**
     * @test
     */
    public function extendsAbstractClass(): void
    {
        self::assertInstanceOf(AbstractSniffer::class, $this->subject);
    }

    /**
     * @test
     */
    public function implementsSnifferInterface(): void
    {
        self::assertInstanceOf(SnifferInterface::class, $this->subject);
    }

    /**
     * @test
     */
    public function getHumanReadableNameReturnsNameFromField(): void
    {
        $subject = new BlindSniffer();

        $result = $subject->getHumanReadableName();

        self::assertSame('Sees nothing.', $result);
    }
}
