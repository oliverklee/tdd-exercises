<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Service;

class PalindromeChecker
{
    public function check(string $word): bool
    {
        $denyList = [' ', '?', '!', ':', ',', '.'];
        $word = str_replace($denyList, '', $word);
        $trimmedWord = mb_strtolower($word);
        if ($trimmedWord === '') {
            return false;
        }
        $reverseWord = $this->mb_strrev($trimmedWord);
        return ($trimmedWord === $reverseWord);
    }

    protected function mb_strrev(string $string, string $encoding = null): string
    {
        $chars = mb_str_split($string, 1, $encoding ?: mb_internal_encoding());
        return implode('', array_reverse($chars));
    }
}
