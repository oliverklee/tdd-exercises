<?php

declare(strict_types=1);

namespace OliverKlee\TddExercises\Service;

class CharacterSorter
{
    public function sort(string $string): string
    {
        $stringParts = mb_str_split(mb_strtolower($string));
        sort($stringParts);

        return implode('', $stringParts);
    }
}
