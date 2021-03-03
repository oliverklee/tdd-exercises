<?php
declare(strict_types=1);

namespace OliverKlee\TddExercises\Tests\Functional\Service;

use InvalidArgumentException;
use OliverKlee\TddExercises\Service\WordListReader;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

/**
 * @covers \OliverKlee\TddExercises\Service\WordListReader
 */
final class WordListReaderTest extends TestCase
{
    private WordListReader $wordListReader;

    protected function setUp(): void
    {
        $this->wordListReader = new WordListReader();
    }

    /**
     * @test
     */
    public function readFileForFileDoesNotExistThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('File is not readable or does not exist');
        $this->expectExceptionCode(1610636644);

        $this->wordListReader->readFile('');
    }

    /**
     * @test
     */
    public function readFileForEmptyFileReturnsEmptyArray(): void
    {
        $root = vfsStream::setup('irgendwas');
        $file = vfsStream::newFile('pter.txt')->at($root);

        $result = $this->wordListReader->readFile($file->url());
        self::assertEmpty($result);
    }

    /**
     * @test
     */
    public function readFileForFileWithOneWordReturnsArrayWithWord(): void
    {
        $root = vfsStream::setup('irgendwas');
        $file = vfsStream::newFile('pter.txt')->withContent('Hans')->at($root);

        $result = $this->wordListReader->readFile($file->url());
        self::assertSame(['Hans'], $result);
    }

    /**
     * @test
     * @dataProvider getData
     */
    public function readFileForFileWithTwoWordsReturnsArrayWithTwoWord(string $content): void
    {
        $root = vfsStream::setup('irgendwas');
        $file = vfsStream::newFile('peter.txt')->withContent($content)->at($root);

        $result = $this->wordListReader->readFile($file->url());
        self::assertSame(['Hans', 'Meiser'], $result);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'EOF LF' => ["Hans\nMeiser"],
            'EOF CRLF' => ["Hans\r\nMeiser"],
        ];
    }

    /**
     * @test
     *
     */
    public function readFileForFileWithCompoundWordInOneLineReturnCompoundWord(): void
    {
        $word = 'chicken soup';
        $root = vfsStream::setup('irgendwas');
        $file = vfsStream::newFile('peter.txt')->withContent($word)->at($root);

        $result = $this->wordListReader->readFile($file->url());
        self::assertSame([$word], $result);
    }

    //- Datei mit mehr als ein Wort innerhalb irgendeiner Zeile: Exception
    //- Leerzeilen kombiniert mit Wörtern: Array mit Wörtern
    //- File ending with \n: Last element of the array should be the last word of the file
    //- File ending without \n: Last element of the array should be the last word of the file
}
