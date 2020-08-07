<?php

namespace Tests\Todolo\Integration;

use Test\Todolo\StringOutput;
use Test\Todolo\TestCase;
use Todolo\Helper\ConfigHelper;
use Todolo\Helper\OutputHelper;

class OutputHelperTest extends TestCase
{
    /**
     * @var ConfigHelper
     */
    protected $configHelper;

    /**
     * @var StringOutput
     */
    protected $output;

    public function setUp(): void
    {
        parent::setUp();

        $this->output = new StringOutput();

        $this->configHelper = new ConfigHelper();

        $this->fixture = new OutputHelper();
    }

    public function testPrintTodos(): void
    {
        $config = $this->configHelper->getStandardConfig();
        $config['show_empty_dir'] = true;

        $todos = [
            'dir1' => [
                '/foo.php' => [
                    [
                        'message' => 'Foo TODO',
                    ],
                ],
            ],
        ];

        $this->fixture->printTodos($this->output, $todos, $config);

        self::assertEquals(
            '
-----------------------------------------------------
<info>dir1</info>/foo.php
-----------------------------------------------------
- Foo TODO

',
            $this->output->getMessages()
        );
    }
}
