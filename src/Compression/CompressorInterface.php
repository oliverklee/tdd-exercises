<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Compression;

use InvalidArgumentException;

/**
 * Interface for compressors that implement different compression algorithms.
 */
interface CompressorInterface
{
    /**
     * Returns the code that is used to uniquely identify this algorithm and that will be prepended
     * when compressing data.
     */
    public function getAlgorithmCode(): string;

    /**
     * Compresses the given data (a string of bytes) and returns the compressed data.
     */
    public function compress(string $uncompressedData): string;

    /**
     * Decompresses the given data.
     *
     * @throws InvalidArgumentException if given data has been compressed with a different algorithm;
     */
    public function decompress(string $compressedData): string;
}
