<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Tests\Unit\Compression;

use OliverKlee\TddSeed\Compression\CompressorInterface;
use OliverKlee\TddSeed\Compression\RunLengthEncoder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddSeed\Compression\RunLengthEncoder
 */
final class RunLengthEncoderTest extends TestCase
{
    private RunLengthEncoder $subject;

    protected function setUp(): void
    {
        $this->subject = new RunLengthEncoder();
    }

    /**
     * @test
     */
    public function isCompressor(): void
    {
        self::assertInstanceOf(CompressorInterface::class, $this->subject);
    }

    /**
     * @test
     */
    public function getAlgorithmCodeReturnsNonEmptyString(): void
    {
        self::assertNotSame('', $this->subject->getAlgorithmCode());
    }

    /**
     * @test
     */
    public function compressWithEmptyDataReturnsAlgorithmCodePlusMarker(): void
    {
        $result = $this->subject->compress('');

        $code = $this->subject->getAlgorithmCode();
        self::assertSame($code . RunLengthEncoder::MARKER, $result);
    }

    /**
     * @test
     *
     * @dataProvider singleBytesDataProvider
     */
    public function compressWithSingleBytesReturnsDataStartingWithPrefix(string $singleBytes): void
    {
        $result = $this->subject->compress($singleBytes);

        self::assertStringStartsWith($this->subject->getAlgorithmCode() . RunLengthEncoder::MARKER, $result);
    }

    /**
     * @return array<string, array<string>>
     */
    public function singleBytesDataProvider(): array
    {
        return [
            'one character' => ['a'],
            'two different characters' => ['ab'],
            'three different characters' => ['abc'],
        ];
    }

    /**
     * @test
     */
    public function compressEncodesNonAsciiBytes(): void
    {
        self::markTestIncomplete('Code me!');
    }

    /**
     * @test
     *
     * @dataProvider singleBytesDataProvider
     */
    public function compressWithSingleBytesReturnsProvidedSingleBytesAfterPrefix(string $singleBytes): void
    {
        $result = $this->subject->compress($singleBytes);

        self::assertSame($singleBytes, substr($result, $this->getPrefixLength()));
    }

    private function getPrefixLength(): int
    {
        return strlen($this->subject->getAlgorithmCode()) + 1;
    }

    /**
     * @test
     */
    public function compressWithTwoIdenticalSubsequentBytesReturnsThemUncompressed(): void
    {
        $data = 'xx';
        $result = $this->subject->compress($data);

        self::assertSame($data, substr($result, $this->getPrefixLength()));
    }

    /**
     * @test
     * @dataProvider subsequentIdenticalBytesDataProvider
     */
    public function compressCompressesIdenticalSubsequentBytesWithCount(string $data): void
    {
        $result = $this->subject->compress($data);
        $marker = $result[$this->getPrefixLength() - 1];

        $payload = substr($result, $this->getPrefixLength());
        $expectedPayload = $marker . chr(strlen($data)) . $data[0];
        self::assertSame($expectedPayload, $payload);
    }

    /**
     * @return array<string, array<string>>
     */
    public function subsequentIdenticalBytesDataProvider(): array
    {
        return [
            '3 bytes' => ['bbb'],
            '4 bytes' => ['bbbb'],
        ];
    }

    /**
     * @test
     */
    public function decompressForIncorrectAlgorithmCodeThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing or incorrect algorithm code');
        $this->expectExceptionCode(1605025867);

        $this->subject->decompress('What is love?');
    }

    /**
     * @test
     */
    public function compressAlwaysMarksMarkerByteAsSequence(): void
    {
        self::markTestIncomplete('This currently does not work. Probably due to a bug.');
    }

    /**
     * @test
     *
     * @dataProvider singleBytesDataProvider
     * @dataProvider subsequentIdenticalBytesDataProvider
     * @dataProvider moreComplexPayloadDataProvider
     */
    public function compressReducesDataSizeAfterPrefix(string $uncompressed): void
    {
        $uncompressed = $this->subject->compress($uncompressed);

        $uncompressedSize = strlen($uncompressed);
        $compressedPayloadSize = strlen($uncompressed) - $this->getPrefixLength();
        self::assertLessThan($uncompressedSize, $compressedPayloadSize);
    }

    /**
     * @return array<string, array<string>>
     */
    public function moreComplexPayloadDataProvider(): array
    {
        return [
            'empty string' => [''],
            'multiple two-character sequences' => ['aabbccdd'],
            'multiple three-character sequences' => ['aaabbbcccddd'],
            'everything mixed' => ['aaabhhhsseffff4444'],
            'one long chain of x' => ['xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'],
        ];
    }

    /**
     * @test
     *
     * @dataProvider singleBytesDataProvider
     * @dataProvider subsequentIdenticalBytesDataProvider
     * @dataProvider moreComplexPayloadDataProvider
     */
    public function compressAndDecompressReturnsTheGivenData(string $originalData): void
    {
        $compressed = $this->subject->compress($originalData);
        $decompressed = $this->subject->decompress($compressed);

        self::assertSame($originalData, $decompressed);
    }
}
