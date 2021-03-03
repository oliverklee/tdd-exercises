<?php

declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Unit\Service;

use OliverKlee\TddExercises\Service\PalindromeChecker;
use PHPUnit\Framework\TestCase;

// check
// '' -> false
// ' ' -> false
// malte -> false
// 12 -> false
// 0 -> true
// ä -> true
// anna -> true
// 'anna ' -> true
// AnNa -> true
// ' AnNa ' -> true
// a -> true
// 11 -> true

/**
 * @covers \OliverKlee\TddExercises\Service\PalindromeChecker
 */
final class PalindromeCheckerTest extends TestCase
{
    private PalindromeChecker $subject;

    public function setUp(): void
    {
        $this->subject = new PalindromeChecker();
    }

    /**
     * @test
     */
    public function checkForEmptyStringReturnsFalse(): void
    {
        self::assertFalse($this->subject->check(''));
    }

    /**
     * @test
     */
    public function checkForSpaceReturnsFalse(): void
    {
        self::assertFalse($this->subject->check(' '));
    }

    /**
     * @test
     */
    public function checkForNonPalindromeReturnsFalse(): void
    {
        self::assertFalse($this->subject->check('Malte'));
    }

    /**
     * @test
     */
    public function checkForNumberReturnsFalse(): void
    {
        self::assertFalse($this->subject->check('12'));
    }

    /**
     * @test
     *
     * @dataProvider getPalindromeWordList
     */
    public function checkWithPalindromeReturnsTrue(string $palindrome): void
    {
        self::assertTrue($this->subject->check($palindrome));
    }

    public function getPalindromeWordList(): array
    {
        return [
            'Palindrome' => ['Anna'],
            'Palindrome to lower' => ['anna'],
            'Palindrome With Umlaut' => ['Ännä'],
            'Zero' => ['0'],
            'Eleven' => ['11'],
            'Single Character' => ['a'],
            'Single Umlaut Character' => ['ä'],
            'Palindrome with beginning and ending space' => [' Anna '],
            'Palindrome with capital letter' => ['AnNa'],
            'Palindrome with ending space' => ['anna '],
            'German sentence with spaces' => ['Ilona liegt geil an Oli'],
            'Sentence with punctuation' => ['Nie fragt sie: Ist gefegt? Sie ist gar fein!'],
        ];
    }
}
