<?php

namespace Tests\Todolo\Integration;

use Test\Todolo\TestCase;
use Todolo\Helper\FileHelper;
use Todolo\TodoFinder;

class TodoFinderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->fixture = new TodoFinder(new FileHelper());
    }

    public function testExtractSingleLineAtTODOs(): void
    {
        $content = '
/*
 * @todo 1
 */
';

        self::assertEquals(
            [
                [
                    'message' => '1',
                ],
            ],
            $this->fixture->extractSingleLineAtTODOs($content)
        );
    }

    public function testExtractSingleLineFIXMEs(): void
    {
        $content = '
// FIXME 2
';

        self::assertEquals(
            [
                [
                    'message' => '2',
                ],
            ],
            $this->fixture->extractSingleLineFIXMEs($content)
        );
    }

    public function testExtractSingleLineTODOs(): void
    {
        $content = '
// TODO 3
';

        self::assertEquals(
            [
                [
                    'message' => '3',
                ],
            ],
            $this->fixture->extractSingleLineTODOs($content)
        );
    }

    public function testGetAllTodosForPHPFilesIn(): void
    {
        $dir = $this->testFilesDir.'/standard_project';

        $list = $this->fixture->getAllTodosForPHPFilesIn($dir);

        self::assertEquals(
            [
                '/File1.php' => [
                    [
                        'message' => '4',
                    ],
                    [
                        'message' => '3',
                    ],
                    [
                        'message' => '1',
                    ],
                    [
                        'message' => '2',
                    ],
                ],
            ],
            $list
        );
    }
}
