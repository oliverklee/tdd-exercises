<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Unit\RocketScience;

use OliverKlee\TddExercises\RocketScience\Rocket;
use OliverKlee\TddExercises\RocketScience\RocketLauncher;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @covers \OliverKlee\TddExercises\RocketScience\RocketLauncher
 */
final class RocketLauncherTest extends TestCase
{
    use ProphecyTrait;

    private RocketLauncher $subject;

    protected function setUp(): void
    {
        $this->subject = new RocketLauncher();
    }

    /**
     * @test
     */
    public function getRocketsInitiallyReturnsEmpty(): void
    {
        self::assertEmpty($this->subject->getRockets());
    }

    /**
     * @test
     */
    public function addRocketAddsRocket(): void
    {
        $rocketProphecy = $this->prophesize(Rocket::class);

        /** @var Rocket|ObjectProphecy $rocket */
        $rocket = $rocketProphecy->reveal();

        $this->subject->addRocket($rocket);

        self::assertCount(1, $this->subject->getRockets());
    }

    /**
     * @test
     */
    public function addRocketForTwoRocketsAddsRockets(): void
    {
        $rocketProphecy = $this->prophesize(Rocket::class);

        /** @var Rocket|ObjectProphecy $rocket */
        $rocket = $rocketProphecy->reveal();

        $this->subject->addRocket($rocket);
        $this->subject->addRocket(clone($rocket));

        self::assertCount(2, $this->subject->getRockets());
    }

    /**
     * @test
     */
    public function activateForOneRocketLaunchRocket(): void
    {
        $rocketProphecy = $this->prophesize(Rocket::class);

        $rocketProphecy->launch()->willReturn('Kawumm')->shouldBeCalledOnce();

        /** @var Rocket|ObjectProphecy $rocket */
        $rocket = $rocketProphecy->reveal();

        $this->subject->addRocket($rocket);

        $this->subject->activate();
    }

    /**
     * @test
     */
    public function activateForRocketsLaunchesRockets(): void
    {
        $rocketProphecy = $this->prophesize(Rocket::class);
        $rocketProphecy->launch()->willReturn('Kawumm')->shouldBeCalledOnce();
        /** @var Rocket|ObjectProphecy $rocket */
        $rocket = $rocketProphecy->reveal();

        $rocketProphecy2 = $this->prophesize(Rocket::class);
        $rocketProphecy2->launch()->willReturn('Dadam')->shouldBeCalledOnce();
        /** @var Rocket|ObjectProphecy $rocket2 */
        $rocket2 = $rocketProphecy2->reveal();

        $this->subject->addRocket($rocket);
        $this->subject->addRocket($rocket2);

        $this->subject->activate();
    }
}
