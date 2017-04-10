<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Tests\Unit;

use OliverKlee\TddSeed\World;
use PHPUnit\Framework\TestCase;

/**
 * Test case.
 */
class WorldTest extends TestCase
{
    /** @var World */
    private $subject = null;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->subject = new World();
    }

    /**
     * @test
     */
    public function timeSpaceContinuumIsConsistent()
    {
        self::assertSame(4, 2 + 2);
    }

    /**
     * @test
     */
    public function canBeInstantiated()
    {
        self::assertInstanceOf(World::class, $this->subject);
    }
}