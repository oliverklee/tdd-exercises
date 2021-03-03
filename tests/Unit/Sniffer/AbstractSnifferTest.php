<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Unit\Sniffer;

use OliverKlee\TddExercises\Sniffer\AbstractSniffer;
use OliverKlee\TddExercises\Sniffer\SnifferInterface;
use OliverKlee\TddExercises\Tests\Unit\Sniffer\Fixtures\BlindSniffer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddExercises\Sniffer\AbstractSniffer
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
