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

    /*
     * Tests for getStandardConfig
     */

    /**
     * Check standard values.
     */
    public function testGetStandardConfig(): void
    {
        self::assertEquals(
            [
                'dirs_to_check' => [
                    'src',
                ],
                'show_empty_dir' => false,
                'show_files_with_no_todos' => false,
                'show_no_files_info' => true,
            ],
            $this->fixture->getStandardConfig()
        );
    }

    /*
     * Tests for validateConfig
     */

    public function testValidateConfigCheck_dirs_to_check(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Field "dirs_to_check" not set in config.');

        $this->fixture->validateConfig([]);
    }

    public function testValidateConfigCheck_show_empty_dir(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Field "show_empty_dir" not set in config.');

        $this->fixture->validateConfig([
            'dirs_to_check' => [],
        ]);
    }

    public function testValidateConfigCheck_show_files_with_no_todos(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Field "show_files_with_no_todos" not set in config.');

        $this->fixture->validateConfig([
            'dirs_to_check' => [],
            'show_empty_dir' => false,
        ]);
    }

    public function testValidateConfigCheck_show_no_files_info(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Field "show_no_files_info" not set in config.');

        $this->fixture->validateConfig([
            'dirs_to_check' => [],
            'show_empty_dir' => false,
            'show_files_with_no_todos' => false,
        ]);
    }
}
