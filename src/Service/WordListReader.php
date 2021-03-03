<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Service;

use InvalidArgumentException;

class WordListReader
{
    /**
     * @return array<string>
     */
    public function readFile(string $path): array
    {
        if (!is_readable($path)) {
            throw new InvalidArgumentException('File is not readable or does not exist', 1610636644);
        }

        $content = file($path);
        $words = [];
        foreach ($content as $row) {
            $words[] = trim($row);
        }

        return $words;
    }


}
