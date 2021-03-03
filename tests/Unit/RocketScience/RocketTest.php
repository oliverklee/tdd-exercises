<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Tests\Unit\RocketScience;

use OliverKlee\TddSeed\RocketScience\Rocket;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddSeed\RocketScience\Rocket
 */
final class RocketTest extends TestCase
{
    /**
     * @test
     */
    public function launchReturnsSwoosh(): void
    {
        $subject = new Rocket();

        self::assertSame('Swoosh!', $subject->launch());
    }
}
