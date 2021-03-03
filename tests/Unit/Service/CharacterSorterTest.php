<?php

declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Unit\Service;

use OliverKlee\TddExercises\Service\CharacterSorter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \OliverKlee\TddExercises\Service\CharacterSorter
 */
final class CharacterSorterTest extends TestCase
{
    private CharacterSorter $subject;


    protected function setUp(): void
    {
        $this->subject = new CharacterSorter();
    }
    /**
     * @return array<string, array<string>>
     */
    public function characterLists(): array
    {
        return [
            'empty sting' => ['', ''],
            'string ohne leerzeichen' => ['otto', 'oott'],
            'string mit Leerzeichen' => ['hello otto', ' ehllooott'],
            'String mit groß und kleinschreibung' => ['OttO', 'oott'],
            'String mit Zahlen' => ['123otto158', '112358oott'],
            'String mit Palindrom' => ['tenet', 'eentt'],
            'String mit Umlaute' => ['bäßÖmÄ', 'bmßääö'],
        ];
    }
    /**
     * Testliste:
     * - Empty String
     * - String ohne Leerzeichen "hello"
     * - String mit Leerzeichen e.g. "hello world"
     * - String mit Sonderzeichen e.g. ä, ö, ü +, ~
     * - String mit Zahlen
     * - String mit groß und kleinschreibung
     * - String mit Palindrom
     */

    /**
     * @test
     *
     * @dataProvider characterLists
     */
    public function sortSortsString(string $value, string $expected): void
    {
        self::assertSame($expected, $this->subject->sort($value));
    }


}
