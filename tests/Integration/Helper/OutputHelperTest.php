<?php

namespace Tests\Todolo\Integration;

use Test\Todolo\StringOutput;
use Test\Todolo\TestCase;
use Todolo\Helper\OutputHelper;

class OutputHelperTest extends TestCase
{
    /**
     * @var StringOutput
     */
    protected $output;

    public function setUp(): void
    {
        parent::setUp();

        $this->output = new StringOutput();

        $this->fixture = new OutputHelper();
    }

    public function testPrintTodos(): void
    {
        $todos = [
            'dir1' => [
                '/foo.php' => [
                    [
                        'message' => 'Foo TODO',
                    ]
                ]
            ]
        ];

        $this->fixture->printTodos($this->output, $todos);

        self::assertEquals(
            '
Dir: dir1
     /foo.php
     - Foo TODO

',
            $this->output->getMessages()
        );
    }
}
