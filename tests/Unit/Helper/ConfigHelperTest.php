<?php

namespace Tests\Todolo\Unit;

use Exception;
use Test\Todolo\TestCase;
use Todolo\Helper\ConfigHelper;

class ConfigHelperTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->fixture = new ConfigHelper();
    }

    public function testValidateConfig(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Field "dirs_to_check" not set in config.');

        $this->fixture->validateConfig([]);
    }
}
