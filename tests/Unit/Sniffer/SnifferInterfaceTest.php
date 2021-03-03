<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Unit\Sniffer;

use OliverKlee\TddExercises\Sniffer\SnifferInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * @coversNothing
 */
final class SnifferInterfaceTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @test
     */
    public function canBeMockedWithProphecy(): void
    {
        $snifferProphecy = $this->prophesize(SnifferInterface::class);

        /** @var SnifferInterface|ProphecySubjectInterface $sniffer */
        $sniffer = $snifferProphecy->reveal();
        self::assertInstanceOf(SnifferInterface::class, $sniffer);

        $path = '/no-unicorns';
        $results = ['double.php'];
        $snifferProphecy->sniff($path)->willReturn($results)->shouldBeCalled();

        $sniffer->sniff($path);

        $snifferProphecy->getHumanReadableName()->shouldNotHaveBeenCalled();
    }
}
