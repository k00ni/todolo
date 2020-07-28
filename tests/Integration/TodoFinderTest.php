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

    public function testGetAllTodosForPHPFilesIn(): void
    {
        $dir = $this->testFilesDir.'/standard_project';

        $list = $this->fixture->getAllTodosForPHPFilesIn($dir);

        self::assertEquals(
            [
                '/File1.php' => [
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
