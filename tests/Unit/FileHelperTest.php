<?php

namespace Tests\Todolo\Unit;

use Test\Todolo\TestCase;
use Todolo\FileHelper;

class TodoFinderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->fixture = new FileHelper();
    }

    public function testGetListOfAllPHPFiles(): void
    {
        $dir = $this->testFilesDir.'/standard_project';

        $list = $this->fixture->getListOfAllPHPFiles($dir);

        self::assertEquals(
            [
                '/File1.php',
            ],
            $list
        );
    }
}
