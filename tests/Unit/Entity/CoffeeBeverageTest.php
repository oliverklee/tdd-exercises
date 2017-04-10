<?php
declare(strict_types = 1);

namespace OliverKlee\TddExercises\Tests\Unit\Entity;

use OliverKlee\TddExercises\Entity\CoffeeBeverage;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddExercises\Entity\CoffeeBeverage
 */
class CoffeeBeverageTest extends TestCase
{
    /**
     * @var CoffeeBeverage
     */
    protected $subject = null;

    protected function setUp(): void
    {
        $this->subject = new CoffeeBeverage();
    }

    /**
     * @test
     */
    public function canBeInstantiated(): void
    {
        self::assertInstanceOf(CoffeeBeverage::class, $this->subject);
    }
}
