<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Compression;

use InvalidArgumentException;

/**
 * Compressor that uses run-length encoding.
 */
class RunLengthEncoder implements CompressorInterface
{
    /**
     * marker used both to terminate the algorithm code at the start of the compressed data
     * as well as to mark a sequence in the compressed data
     *
     * @var string
     */
    public const MARKER = '@';

    /**
     * @var int
     */
    private const MINIMUM_CHUNK_LENGTH = 3;

    public function getAlgorithmCode(): string
    {
        return 'RLE';
    }

    public function compress(string $uncompressedData): string
    {
        $result = $this->getAlgorithmCode() . self::MARKER;

        /** @var string[] $chunks */
        $chunks = [];
        $previousByte = '';
        $currentChunk = '';
        $inputBytes = str_split($uncompressedData);
        foreach ($inputBytes as $byte) {
            if ($byte === $previousByte) {
                $currentChunk .= $byte;
                continue;
            }

            if ($currentChunk !== '') {
                $chunks[] = $currentChunk;
            }
            $previousByte = $byte;
            $currentChunk = $byte;
        }
        if ($currentChunk !== '') {
            $chunks[] = $currentChunk;
        }

        foreach ($chunks as $chunk) {
            $chunkLength = strlen($chunk);
            if ($chunkLength < self::MINIMUM_CHUNK_LENGTH) {
                $result .= $chunk;
            } else {
                $result .= self::MARKER . chr($chunkLength) . $chunk{0};
            }
        }

        return $result;
    }

    public function decompress(string $compressedData): string
    {
        $expectedPrefix = $this->getAlgorithmCode() . self::MARKER;
        $prefixLength = strlen($expectedPrefix);
        $actualPrefix = substr($compressedData, 0, $prefixLength);
        if ($actualPrefix !== $expectedPrefix) {
            throw new InvalidArgumentException('Missing or incorrect algorithm code', 1605025867);
        }

        $payload = substr($compressedData, $prefixLength);

        $uncompressedData = '';

        $payloadLength = strlen($payload);
        $position = 0;
        while ($position < $payloadLength) {
            $currentByte = $payload[$position];
            if ($currentByte !== self::MARKER) {
                $uncompressedData .= $currentByte;
                $position++;
            } else {
                $repetitions = ord($payload[$position + 1]);
                $repeatable = $payload[$position + 2];
                $uncompressedData .= str_repeat($repeatable, $repetitions);
                $position += 3;
            }
        }

        return $uncompressedData;
    }
}
