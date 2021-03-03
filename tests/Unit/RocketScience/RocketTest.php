<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Unit\RocketScience;

use OliverKlee\TddExercises\RocketScience\Rocket;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddExercises\RocketScience\Rocket
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
