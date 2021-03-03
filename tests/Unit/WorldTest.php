<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Unit;

use OliverKlee\TddExercises\World;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddExercises\World
 */
final class WorldTest extends TestCase
{
    private World $subject;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->subject = new World();
    }

    /**
     * @test
     */
    public function timeSpaceContinuumIsConsistent(): void
    {
        self::assertSame(4, 2 + 2);
    }

    /**
     * @test
     */
    public function canBeInstantiated(): void
    {
        self::assertInstanceOf(World::class, $this->subject);
    }

    /**
     * @test
     */
    public function stringContainsForCaseSensitiveMatchAtStartReturnsTrue(): void
    {
        if (PHP_VERSION_ID < 80000) {
            self::markTestSkipped('The tested function is available in PHP >= 8.0 only.');
        }

        self::assertTrue(str_contains('Wegelagerei', 'Weg'));
    }
}
