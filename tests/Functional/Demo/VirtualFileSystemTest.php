<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\Tests\Functional\Demo;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
final class VirtualFileSystemTest extends TestCase
{
    /** @var string */
    private const ROOT = 'home';

    private vfsStreamDirectory $root;

    protected function setUp(): void
    {
        $this->root = vfsStream::setup(self::ROOT);
    }

    /**
     * @test
     */
    public function rootUrlIsVfsProtocolPlusGivenDirectory(): void
    {
        $rootUrl = $this->root->url();

        self::assertSame('vfs://' . self::ROOT, $rootUrl);
    }

    /**
     * @test
     */
    public function rootDirectoryExists(): void
    {
        self::assertDirectoryExists($this->root->url());
    }

    /**
     * @test
     */
    public function createdDirectoryByDefaultIsEmpty(): void
    {
        self::assertDirectoryIsEmpty($this->root->url());
    }

    private static function assertDirectoryIsEmpty(string $path): void
    {
        $files = \scandir($path);

        self::assertSame(['.', '..'], $files);
    }

    /**
     * @test
     */
    public function urlOfNonexistentDirectoryDoesNotCreateDirectory(): void
    {
        $path = vfsStream::url('home/stuff/');

        self::assertDirectoryDoesNotExist($path);
    }

    /**
     * @test
     */
    public function urlOfNonexistentFileDoesNotCreateFile(): void
    {
        $path = vfsStream::url('home/everything.txt');

        self::assertFileDoesNotExist($path);
    }

    /**
     * @test
     */
    public function newFileWithoutRootDoesNotCreateFile(): void
    {
        $path = vfsStream::newFile('home/everything.txt')->url();

        self::assertFileDoesNotExist($path);
    }

    /**
     * @test
     */
    public function newFileAtRootPutsFileInRoot(): void
    {
        $fileName = 'everything.txt';
        $path = vfsStream::newFile($fileName)->at($this->root)->url();

        self::assertSame($this->root->url() . '/' . $fileName, $path);
    }

    /**
     * @test
     */
    public function newFileAtRootCreatesFile(): void
    {
        $path = vfsStream::newFile('everything.txt')->at($this->root)->url();

        self::assertFileExists($path);
    }

    /**
     * @test
     */
    public function newFileAtRootMakesFileEmpty(): void
    {
        $path = vfsStream::newFile('everything.txt')->at($this->root)->url();

        self::assertStringEqualsFile($path, '');
    }

    /**
     * @test
     */
    public function newFileCanSetEmptyContent(): void
    {
        $path = vfsStream::newFile('everything.txt')->at($this->root)->withContent('')->url();

        self::assertStringEqualsFile($path, '');
    }

    /**
     * @test
     */
    public function newFileCanSetContent(): void
    {
        $content = 'You have no idea what loss is. (Joel)';
        $path = vfsStream::newFile('the-last-of-us.txt')->at($this->root)->withContent($content)->url();

        self::assertStringEqualsFile($path, $content);
    }

    /**
     * @test
     */
    public function newFileWithDirectoryInPathDoesNotCreateTheGivenDirectory(): void
    {
        vfsStream::newFile('universe/everything.txt')->at($this->root);

        self::assertDirectoryDoesNotExist(vfsStream::url('home/universe'));
    }

    /**
     * @test
     */
    public function canCreateDirectory(): void
    {
        $path = vfsStream::newDirectory('universe')->at($this->root)->url();

        self::assertDirectoryExists($path);
    }

    /**
     * @test
     */
    public function newFileCanCreateFileInNewDirectory(): void
    {
        $directory = vfsStream::newDirectory('universe')->at($this->root);
        $path = vfsStream::newFile('everything.txt')->at($directory)->url();

        self::assertFileExists($path);
    }

    /**
     * @test
     */
    public function globDoesNotFindVirtualFiles(): void
    {
        vfsStream::newFile('everything.txt')->at($this->root);

        self::assertSame([], \glob($this->root->url()));
    }

    /**
     * @test
     */
    public function createCanCreateComplexStructureInRoot(): void
    {
        $fileContent = "runner\nclicker\nbloater";
        $structure = ['examples' => ['zombies.txt' => $fileContent]];
        vfsStream::create($structure, $this->root);

        $path = 'vfs://home/examples/zombies.txt';
        self::assertFileExists($path);
        self::assertStringEqualsFile($path, $fileContent);
    }

    /**
     * @test
     */
    public function createByDefaultUsesRootForStructure(): void
    {
        $fileContent = "runner\nclicker\nbloater";
        $structure = ['examples' => ['zombies.txt' => $fileContent]];
        vfsStream::create($structure);

        $path = 'vfs://home/examples/zombies.txt';
        self::assertFileExists($path);
        self::assertStringEqualsFile($path, $fileContent);
    }
}
