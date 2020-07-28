<?php

declare(strict_types=1);

namespace Todolo\Helper;

use Exception;

class ConfigHelper
{
    /**
     * @param array<string, array<int, string>> $config
     *
     * @throws Exception if a required field is not set.
     */
    public function validateConfig(array $config): void
    {
        if (!isset($config['dirs_to_check'])) {
            throw new Exception('Field "dirs_to_check" not set in config.');
        }
    }
}
