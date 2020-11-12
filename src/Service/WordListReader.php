<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Service;

use InvalidArgumentException;
use UnexpectedValueException;

class WordListReader
{

    public function readFile(string $path)
    {
        if (!is_readable($path)) {
            throw new InvalidArgumentException('File is not readable or does not exist', 1610636644);
        }

        $content = file($path);

        $words = [];
        foreach ($content as $row) {

            if (count(explode(' ', $row)) > 1) {
                throw new UnexpectedValueException('More than one word per line was found', 1610639067);
            }

            $words[] = trim($row);

        }

        return $words;
    }


}
