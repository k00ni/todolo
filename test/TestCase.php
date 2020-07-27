<?php

namespace Test\Todolo;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    /**
     * @mixed
     */
    protected $fixture;

    /**
     * @string
     */
    protected $rootDir;

    /**
     * @string
     */
    protected $testDir;

    /**
     * @string
     */
    protected $testFilesDir;

    public function setUp(): void
    {
        parent::setUp();

        $this->rootDir = __DIR__.'/..';

        $this->testDir = $this->rootDir.'/test';
        $this->testFilesDir = $this->testDir.'/files';
    }
}
